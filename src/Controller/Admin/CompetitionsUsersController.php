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
        $session = $this->getRequest()->getSession();
        $queryParams = $this->getRequest()->getQueryParams();

        // Keresés és szűrők törlése gomb kezelése (?clear=search)
        if (isset($queryParams['clear']) && $queryParams['clear'] === 'search') {
            $session->delete('Paging.CompetitionsUsers.params');

            return $this->redirect(['action' => 'index']);
        }

        // =========================================================================
        // ⚙️ KERESÉSI BEÁLLÍTÁSOK (Itt kapcsold be/ki a kívánt keresési mezőket)
        // =========================================================================
        $searchableFields = [
            // --- 1. Saját tábla (CompetitionsUsers) mezői ---
            // 'CompetitionsUsers.id',
            'CompetitionsUsers.',
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
        if (empty($queryParams) && $session->check('Paging.CompetitionsUsers.params')) {
            $savedParams = (array)$session->read('Paging.CompetitionsUsers.params');
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
                $session->write('Paging.CompetitionsUsers.params', $queryParams);
            }
        } catch (\Cake\Http\Exception\NotFoundException $e) {
            $this->Flash->warning(__('A kért oldal nem található, ezért átirányítottuk az első oldalra.'));

            $fallbackParams = $queryParams;
            unset($fallbackParams['page']);

            $session->write('Paging.CompetitionsUsers.params', $fallbackParams);

            return $this->redirect([
                'action' => 'index',
                '?' => $fallbackParams,
            ]);
        }

        // Utoljára megtekintett / szerkesztett rekord visszagörgetésének támogatása
        $lastViewedId = $session->read('LastViewed._id');
        $scrollToId = $session->read('ScrollTo._id') ?? $lastViewedId;

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
                $this->Flash->success(__('The competitions user has been saved.'));

                // Frissen létrehozott rekord megjelölése visszagörgetéshez az index nézetben
                $this->getRequest()->getSession()->write('ScrollTo.competitionsUser_id', $competitionsUser->competitionsUser_id);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Nem sikerült az adatok mentése. Kérem ellenőrizze és javítsa az adatokat majd mentsen újra.'));
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
        $session = $this->getRequest()->getSession();
        $session->write('LastViewed.competitionsUser_id', (int)$id);
        $session->write('ScrollTo.competitionsUser_id', (int)$id);

        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $data = $this->getRequest()->getData();
            $competitionsUser = $this->fetchTable('CompetitionsUsers')->patchEntity($competitionsUser, $data);
            if ($this->fetchTable('CompetitionsUsers')->save($competitionsUser)) {
                $this->Flash->success(__('A(z) competitions user adatai sikeresen mentésre kerültek.'));

                $redirectParams = (array)$session->read('Paging.CompetitionsUsers.params');

                return $this->redirect([
                    'action' => 'index',
                    '?' => $redirectParams,
                ]);
            }
            $this->Flash->error(__('A(z) competitions user mentése nem sikerült. Kérem, nézze át és javítsa az adatokat, majd mentsen újra.'));
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

        $session = $this->getRequest()->getSession();
        $session->delete('LastViewed.competitionsUser_id');

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
            $session->write('ScrollTo.competitionsUser_id', (int)$neighbor->id);
        } else {
            $session->delete('ScrollTo.competitionsUser_id');
        }

        if ($table->delete($competitionsUser)) {
            $this->Flash->success(__('A(z) competitions user sikeresen törölve lett.'));
        } else {
            $this->Flash->error(__('A törlés sikertelen. Kérjük, próbálja újra.'));
        }

        $redirectParams = (array)$session->read('Paging.CompetitionsUsers.params');

        return $this->redirect([
            'action' => 'index',
            '?' => $redirectParams,
        ]);
    }}
