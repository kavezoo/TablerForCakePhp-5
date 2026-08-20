<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * CompetitionsUsers Controller
 *
 * @property \App\Model\Table\CompetitionsUsersTable $CompetitionsUsers
 */
class CompetitionsUsersController extends AppController
{
    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $queryParams = $this->getRequest()->getQueryParams();

        // Keresés és szűrők törlése gomb kezelése (?clear=search)
        if (isset($queryParams['clear']) && $queryParams['clear'] === 'search') {
            $this->session->delete('Paging.CompetitionsUsers.params');

            return $this->redirect(['action' => 'index']);
        }

        // =========================================================================
        // ⚙️ KERESÉSI BEÁLLÍTÁSOK (Itt kapcsold be/ki a kívánt keresési mezőket)
        // =========================================================================
        $searchableFields = [
            // --- 1. Saját tábla (CompetitionsUsers) mezői ---
            // 'CompetitionsUsers.id',
			'CompetitionsUsers.name',	// . $this->CompetitionsUsers->getDisplayField(),	// name általában
            // --- 2. Kapcsolt (BelongsTo) táblák mezői ---
            // 'Users.name',
            // 'Competitions.name',
            // 'Subclubs.name',
        ];

        // =========================================================================
        // ⚙️ LAPOZÓ BEÁLLÍTÁSA
        // =========================================================================
        $this->paginate = [
            'limit' => 20,
            'maxLimit' => 100,
        ];

        // Ha üres az URL, de a Sessionben van érvényes mentett állapot, oda irányítunk vissza
        if (empty($queryParams) && $this->session->check('Paging.CompetitionsUsers.params')) {
            $savedParams = (array)$this->session->read('Paging.CompetitionsUsers.params');
            if (!empty($savedParams)) {
                return $this->redirect([
                    'action' => 'index',
                    '?' => $savedParams,
                ]);
            }
        }

        $query = $this->fetchTable('CompetitionsUsers')->find()
            ->contain(['Users', 'Competitions', 'Subclubs']);

        // =========================================================================
        // 🔍 KERESÉS VÉGREHAJTÁSA A KONFIGURÁLT MEZŐK ALAPJÁN
        // =========================================================================
        $search = trim((string)($queryParams['search'] ?? ''));
        if ($search !== '' && !empty($searchableFields)) {
            $searchLike = '%' . $search . '%';
            $conditions = [];

            foreach ($searchableFields as $field) {
                $conditions[$field . ' LIKE'] = $searchLike;
            }

            $query->where(['OR' => $conditions]);
        }

        // =========================================================================
        // 📄 LAPOZÁS VÉGREHAJTÁSA HIBAKEZELÉSSEL
        // =========================================================================
        try {
            $competitionsUsers = $this->paginate($query);

            if (!empty($queryParams)) {
                $this->session->write('Paging.CompetitionsUsers.params', $queryParams);
            }
        } catch (\Cake\Http\Exception\NotFoundException $e) {
            $this->Flash->warning(__('Page not found. Redirecting to the first page.'), ['plugin' => 'KvAdmin']);

            $fallbackParams = $queryParams;
            unset($fallbackParams['page']);

            $this->session->write('Paging.CompetitionsUsers.params', $fallbackParams);

            return $this->redirect([
                'action' => 'index',
                '?' => $fallbackParams,
            ]);
        }

        // Utoljára megtekintett / szerkesztett rekord visszagörgetésének támogatása
        $lastViewedId = $this->session->read('LastViewed._id');
        $scrollToId = $this->session->read('ScrollTo._id') ?? $lastViewedId;

        $this->set(compact('competitionsUsers', 'lastViewedId', 'scrollToId', 'search'));
    }
    /**
     * View method
     *
     * @param string|null $id Competitions User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $competitionsUser = $this->CompetitionsUsers->get($id, contain: ['Users', 'Competitions', 'Subclubs']);
		$this->session->write('LastViewed.' . $this->prefix . 'competitionsUser_id', (int)$id);
		$this->session->write('ScrollTo.' . $this->prefix . 'competitionsUser_id', (int)$id);
        $this->set(compact('competitionsUser'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $competitionsUser = $this->fetchTable('CompetitionsUsers')->newEmptyEntity();
        if ($this->getRequest()->is('post')) {
            $data = $this->getRequest()->getData();
            $competitionsUser = $this->fetchTable('CompetitionsUsers')->patchEntity($competitionsUser, $data);
            if ($this->fetchTable('CompetitionsUsers')->save($competitionsUser)) {
                $this->Flash->success(__('The {0} has been saved.'), __('competitions user'), ['plugin' => 'KvAdmin']);

                // Frissen létrehozott rekord megjelölése visszagörgetéshez az index nézetben
                $this->session->write('ScrollTo.' . $this->prefix . 'competitionsUser_id', $competitionsUser->id ?? 'id');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Could not save data. Please review the errors and try again.'), ['plugin' => 'KvAdmin']);
        }
        $users = $this->fetchTable('CompetitionsUsers')->Users->find('list', limit: 200)->all();
        $competitions = $this->fetchTable('CompetitionsUsers')->Competitions->find('list', limit: 200)->all();
        $subclubs = $this->fetchTable('CompetitionsUsers')->Subclubs->find('list', limit: 200)->all();
        $this->set(compact('competitionsUser', 'users', 'competitions', 'subclubs'));
    }
    /**
     * Edit method
     *
     * @param string|null $id Competitions User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $competitionsUser = $this->fetchTable('CompetitionsUsers')->get($id, contain: []);
		$this->session->write('LastViewed.' . $this->prefix . 'competitionsUser_id', (int)$id);
		$this->session->write('ScrollTo.' . $this->prefix . 'competitionsUser_id', (int)$id);

        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $data = $this->getRequest()->getData();
            $competitionsUser = $this->fetchTable('CompetitionsUsers')->patchEntity($competitionsUser, $data);
            if ($this->fetchTable('CompetitionsUsers')->save($competitionsUser)) {
                $this->Flash->success(__('The {0} has been saved.', __('competitions user')), ['plugin' => 'KvAdmin']);

                $redirectParams = (array)$this->session->read('Paging.' . $this->prefix . 'CompetitionsUsers.params');
                return $this->redirect([
                    'action' => 'index',
                    '?' => $redirectParams,
                ]);
            }
            $this->Flash->error(__('Could not save data. Please review the errors and try again.'), ['plugin' => 'KvAdmin']);
        }
        $users = $this->fetchTable('CompetitionsUsers')->Users->find('list', limit: 200)->all();
        $competitions = $this->fetchTable('CompetitionsUsers')->Competitions->find('list', limit: 200)->all();
        $subclubs = $this->fetchTable('CompetitionsUsers')->Subclubs->find('list', limit: 200)->all();
        $this->set(compact('competitionsUser', 'users', 'competitions', 'subclubs'));
    }
    /**
     * Delete method
     *
     * @param string|null $id Competitions User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);
        
        $table = $this->fetchTable('CompetitionsUsers');
        $competitionsUser = $table->get($id);
		$competitionsUserName = $competitionsUser->name;

        $this->session->delete('LastViewed.competitionsUser_id');

        // Törlés utáni visszagörgetés: megkeressük a közvetlenül előtte lévő rekordot
        $neighbor = $table->find()
            ->select(['id'])
            ->where(['id <' => (int)$id])
            ->orderByDesc('id')
            ->first();

        // Ha nincs előtte lévő rekord (első volt), megpróbáljuk a következőt keresni
        if (!$neighbor) {
            $neighbor = $table->find()
                ->select(['id'])
                ->where(['id >' => (int)$id])
                ->orderByAsc('id')
                ->first();
        }

        if ($neighbor) {
            $this->session->write('ScrollTo.competitionsUser_id', (int)$neighbor->id);
        } else {
            $this->session->delete('ScrollTo.competitionsUser_id');
        }

        if ($table->delete($competitionsUser)) {
            $this->Flash->success(__('The {0} has been successfully deleted.', __('competitions user')), ['plugin' => 'KvAdmin']);
        } else {
            $this->Flash->error(__('Could not delete the record. Please try again.'), ['plugin' => 'KvAdmin']);
        }

        $redirectParams = (array)$this->session->read('Paging.CompetitionsUsers.params');
        return $this->redirect([
            'action' => 'index',
            '?' => $redirectParams,
        ]);
    }}
