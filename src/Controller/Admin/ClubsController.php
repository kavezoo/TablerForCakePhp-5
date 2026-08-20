<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Clubs Controller
 *
 * @property \App\Model\Table\ClubsTable $Clubs
 */
class ClubsController extends AppController
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
            $this->session->delete('Paging.Clubs.params');

            return $this->redirect(['action' => 'index']);
        }

        // =========================================================================
        // ⚙️ KERESÉSI BEÁLLÍTÁSOK (Itt kapcsold be/ki a kívánt keresési mezőket)
        // =========================================================================
        $searchableFields = [
            // --- 1. Saját tábla (Clubs) mezői ---
            // 'Clubs.id',
			'Clubs.name',	// . $this->Clubs->getDisplayField(),	// name általában
            // --- 2. Kapcsolt (BelongsTo) táblák mezői ---
            // 'Cities.name',
        ];

        // =========================================================================
        // ⚙️ LAPOZÓ BEÁLLÍTÁSA
        // =========================================================================
        $this->paginate = [
            'limit' => 20,
            'maxLimit' => 100,
        ];

        // Ha üres az URL, de a Sessionben van érvényes mentett állapot, oda irányítunk vissza
        if (empty($queryParams) && $this->session->check('Paging.Clubs.params')) {
            $savedParams = (array)$this->session->read('Paging.Clubs.params');
            if (!empty($savedParams)) {
                return $this->redirect([
                    'action' => 'index',
                    '?' => $savedParams,
                ]);
            }
        }

        $query = $this->fetchTable('Clubs')->find()
            ->contain(['Cities']);

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
            $clubs = $this->paginate($query);

            if (!empty($queryParams)) {
                $this->session->write('Paging.Clubs.params', $queryParams);
            }
        } catch (\Cake\Http\Exception\NotFoundException $e) {
            $this->Flash->warning(__('Page not found. Redirecting to the first page.'), ['plugin' => 'KvAdmin']);

            $fallbackParams = $queryParams;
            unset($fallbackParams['page']);

            $this->session->write('Paging.Clubs.params', $fallbackParams);

            return $this->redirect([
                'action' => 'index',
                '?' => $fallbackParams,
            ]);
        }

        // Utoljára megtekintett / szerkesztett rekord visszagörgetésének támogatása
        $lastViewedId = $this->session->read('LastViewed._id');
        $scrollToId = $this->session->read('ScrollTo._id') ?? $lastViewedId;

        $this->set(compact('clubs', 'lastViewedId', 'scrollToId', 'search'));
    }
    /**
     * View method
     *
     * @param string|null $id Club id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $club = $this->Clubs->get($id, contain: ['Cities', 'Subclubs', 'Users']);
		$this->session->write('LastViewed.Admin.club_id', (int)$id ?? 0);
		$this->session->write('ScrollTo.Admin.club_id', (int)$id ?? 0);
        $this->set(compact('club'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $club = $this->fetchTable('Clubs')->newEmptyEntity();
        if ($this->getRequest()->is('post')) {
            $data = $this->getRequest()->getData();
            $club = $this->fetchTable('Clubs')->patchEntity($club, $data);
            if ($this->fetchTable('Clubs')->save($club)) {
                $this->Flash->success(__('The {0} has been saved.'), __('club'), ['plugin' => 'KvAdmin']);

                // Frissen létrehozott rekord megjelölése visszagörgetéshez az index nézetben
                $this->session->write('ScrollTo.Admin.club.id', $club->id ?? 0);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Could not save data. Please review the errors and try again.'), ['plugin' => 'KvAdmin']);
        }
        $cities = $this->fetchTable('Clubs')->Cities->find('list', limit: 200)->all();
        $this->set(compact('club', 'cities'));
    }
    /**
     * Edit method
     *
     * @param string|null $id Club id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $club = $this->fetchTable('Clubs')->get($id, contain: []);
		$this->session->write('LastViewed.Admin.club_id', (int)$id ?? 0);
		$this->session->write('ScrollTo.Admin.club_id', (int)$id ?? 0);

        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $data = $this->getRequest()->getData();
            $club = $this->fetchTable('Clubs')->patchEntity($club, $data);
            if ($this->fetchTable('Clubs')->save($club)) {
                $this->Flash->success(__('The {0} has been saved.', __('club')), ['plugin' => 'KvAdmin']);

                $redirectParams = (array)$this->session->read('Paging.Admin.Clubs.params');
                return $this->redirect([
                    'action' => 'index',
                    '?' => $redirectParams,
                ]);
            }
            $this->Flash->error(__('Could not save data. Please review the errors and try again.'), ['plugin' => 'KvAdmin']);
        }
        $cities = $this->fetchTable('Clubs')->Cities->find('list', limit: 200)->all();
        $this->set(compact('club', 'cities'));
    }
    /**
     * Delete method
     *
     * @param string|null $id Club id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);
        
        $table = $this->fetchTable('Clubs');
        $club = $table->get($id);
		$clubName = $club->name;

        $this->session->delete('LastViewed.club_id');

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
            $this->session->write('ScrollTo.club_id', (int)$neighbor->id);
        } else {
            $this->session->delete('ScrollTo.club_id');
        }

        if ($table->delete($club)) {
            $this->Flash->success(__('The {0} has been successfully deleted.', __('club')), ['plugin' => 'KvAdmin']);
        } else {
            $this->Flash->error(__('Could not delete the record. Please try again.'), ['plugin' => 'KvAdmin']);
        }

        $redirectParams = (array)$this->session->read('Paging.Clubs.params');
        return $this->redirect([
            'action' => 'index',
            '?' => $redirectParams,
        ]);
    }}
