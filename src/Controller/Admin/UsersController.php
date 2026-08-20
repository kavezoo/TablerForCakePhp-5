<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
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
            $this->session->delete('Paging.Users.params');

            return $this->redirect(['action' => 'index']);
        }

        // =========================================================================
        // ⚙️ KERESÉSI BEÁLLÍTÁSOK (Itt kapcsold be/ki a kívánt keresési mezőket)
        // =========================================================================
        $searchableFields = [
            // --- 1. Saját tábla (Users) mezői ---
            // 'Users.id',
			'Users.name',	// . $this->Users->getDisplayField(),	// name általában
            // --- 2. Kapcsolt (BelongsTo) táblák mezői ---
            // 'Cities.name',
            // 'Clubs.name',
        ];

        // =========================================================================
        // ⚙️ LAPOZÓ BEÁLLÍTÁSA
        // =========================================================================
        $this->paginate = [
            'limit' => 20,
            'maxLimit' => 100,
        ];

        // Ha üres az URL, de a Sessionben van érvényes mentett állapot, oda irányítunk vissza
        if (empty($queryParams) && $this->session->check('Paging.Users.params')) {
            $savedParams = (array)$this->session->read('Paging.Users.params');
            if (!empty($savedParams)) {
                return $this->redirect([
                    'action' => 'index',
                    '?' => $savedParams,
                ]);
            }
        }

        $query = $this->fetchTable('Users')->find()
            ->contain(['Cities', 'Clubs']);

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
            $users = $this->paginate($query);

            if (!empty($queryParams)) {
                $this->session->write('Paging.Users.params', $queryParams);
            }
        } catch (\Cake\Http\Exception\NotFoundException $e) {
            $this->Flash->warning(__('Page not found. Redirecting to the first page.'), ['plugin' => 'KvAdmin']);

            $fallbackParams = $queryParams;
            unset($fallbackParams['page']);

            $this->session->write('Paging.Users.params', $fallbackParams);

            return $this->redirect([
                'action' => 'index',
                '?' => $fallbackParams,
            ]);
        }

        // Utoljára megtekintett / szerkesztett rekord visszagörgetésének támogatása
        $lastViewedId = $this->session->read('LastViewed._id');
        $scrollToId = $this->session->read('ScrollTo._id') ?? $lastViewedId;

        $this->set(compact('users', 'lastViewedId', 'scrollToId', 'search'));
    }
    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, contain: ['Cities', 'Clubs', 'Competitions', 'FailedPasswordAttempts', 'SocialAccounts', 'Staffs']);
		$this->session->write('LastViewed.Admin.user_id', (int)$id ?? 0);
		$this->session->write('ScrollTo.Admin.user_id', (int)$id ?? 0);
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->fetchTable('Users')->newEmptyEntity();
        if ($this->getRequest()->is('post')) {
            $data = $this->getRequest()->getData();
            $user = $this->fetchTable('Users')->patchEntity($user, $data);
            if ($this->fetchTable('Users')->save($user)) {
                $this->Flash->success(__('The {0} has been saved.'), __('user'), ['plugin' => 'KvAdmin']);

                // Frissen létrehozott rekord megjelölése visszagörgetéshez az index nézetben
                $this->session->write('ScrollTo.Admin.user.id', $user->id ?? 0);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Could not save data. Please review the errors and try again.'), ['plugin' => 'KvAdmin']);
        }
        $cities = $this->fetchTable('Users')->Cities->find('list', limit: 200)->all();
        $clubs = $this->fetchTable('Users')->Clubs->find('list', limit: 200)->all();
        $competitions = $this->fetchTable('Users')->Competitions->find('list', limit: 200)->all();
        $this->set(compact('user', 'cities', 'clubs', 'competitions'));
    }
    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->fetchTable('Users')->get($id, contain: ['Competitions']);
		$this->session->write('LastViewed.Admin.user_id', (int)$id ?? 0);
		$this->session->write('ScrollTo.Admin.user_id', (int)$id ?? 0);

        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $data = $this->getRequest()->getData();
            $user = $this->fetchTable('Users')->patchEntity($user, $data);
            if ($this->fetchTable('Users')->save($user)) {
                $this->Flash->success(__('The {0} has been saved.', __('user')), ['plugin' => 'KvAdmin']);

                $redirectParams = (array)$this->session->read('Paging.Admin.Users.params');
                return $this->redirect([
                    'action' => 'index',
                    '?' => $redirectParams,
                ]);
            }
            $this->Flash->error(__('Could not save data. Please review the errors and try again.'), ['plugin' => 'KvAdmin']);
        }
        $cities = $this->fetchTable('Users')->Cities->find('list', limit: 200)->all();
        $clubs = $this->fetchTable('Users')->Clubs->find('list', limit: 200)->all();
        $competitions = $this->fetchTable('Users')->Competitions->find('list', limit: 200)->all();
        $this->set(compact('user', 'cities', 'clubs', 'competitions'));
    }
    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);
        
        $table = $this->fetchTable('Users');
        $user = $table->get($id);
		$userName = $user->name;

        $this->session->delete('LastViewed.user_id');

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
            $this->session->write('ScrollTo.user_id', (int)$neighbor->id);
        } else {
            $this->session->delete('ScrollTo.user_id');
        }

        if ($table->delete($user)) {
            $this->Flash->success(__('The {0} has been successfully deleted.', __('user')), ['plugin' => 'KvAdmin']);
        } else {
            $this->Flash->error(__('Could not delete the record. Please try again.'), ['plugin' => 'KvAdmin']);
        }

        $redirectParams = (array)$this->session->read('Paging.Users.params');
        return $this->redirect([
            'action' => 'index',
            '?' => $redirectParams,
        ]);
    }}
