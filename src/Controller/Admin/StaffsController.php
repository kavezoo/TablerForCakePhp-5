<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Staffs Controller
 *
 * @property \App\Model\Table\StaffsTable $Staffs
 */
class StaffsController extends AppController
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
            $session->delete('Paging.Staffs.params');

            return $this->redirect(['action' => 'index']);
        }

        // =========================================================================
        // ⚙️ KERESÉSI BEÁLLÍTÁSOK (Itt kapcsold be/ki a kívánt keresési mezőket)
        // =========================================================================
        $searchableFields = [
            // --- 1. Saját tábla (Staffs) mezői ---
            // 'Staffs.id',
            'Staffs.',
            // --- 2. Kapcsolt (BelongsTo) táblák mezői ---
            // 'Users.name',
            // 'Competitions.name',
        ];

        // =========================================================================
        // ⚙️ LAPOZÓ BEÁLLÍTÁSA
        // =========================================================================
        $this->paginate = [
            'limit' => 20,
            'maxLimit' => 100,
        ];

        // Ha üres az URL, de a Sessionben van érvényes mentett állapot, oda irányítunk vissza
        if (empty($queryParams) && $session->check('Paging.Staffs.params')) {
            $savedParams = (array)$session->read('Paging.Staffs.params');
            if (!empty($savedParams)) {
                return $this->redirect([
                    'action' => 'index',
                    '?' => $savedParams,
                ]);
            }
        }

        $query = $this->fetchTable('Staffs')->find()
            ->contain(['Users', 'Competitions']);

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
            $staffs = $this->paginate($query);

            if (!empty($queryParams)) {
                $session->write('Paging.Staffs.params', $queryParams);
            }
        } catch (\Cake\Http\Exception\NotFoundException $e) {
            $this->Flash->warning(__('A kért oldal nem található, ezért átirányítottuk az első oldalra.'));

            $fallbackParams = $queryParams;
            unset($fallbackParams['page']);

            $session->write('Paging.Staffs.params', $fallbackParams);

            return $this->redirect([
                'action' => 'index',
                '?' => $fallbackParams,
            ]);
        }

        // Utoljára megtekintett / szerkesztett rekord visszagörgetésének támogatása
        $lastViewedId = $session->read('LastViewed._id');
        $scrollToId = $session->read('ScrollTo._id') ?? $lastViewedId;

        $this->set(compact('staffs', 'lastViewedId', 'scrollToId', 'search'));
    }
    /**
     * View method
     *
     * @param string|null $id Staff id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $staff = $this->Staffs->get($id, contain: ['Users', 'Competitions']);
        $this->set(compact('staff'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $staff = $this->fetchTable('Staffs')->newEmptyEntity();
        if ($this->getRequest()->is('post')) {
            $data = $this->getRequest()->getData();
            $staff = $this->fetchTable('Staffs')->patchEntity($staff, $data);
            if ($this->fetchTable('Staffs')->save($staff)) {
                $this->Flash->success(__('The staff has been saved.'));

                // Frissen létrehozott rekord megjelölése visszagörgetéshez az index nézetben
                $this->getRequest()->getSession()->write('ScrollTo.staff_id', $staff->staff_id);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Nem sikerült az adatok mentése. Kérem ellenőrizze és javítsa az adatokat majd mentsen újra.'));
        }
        $users = $this->fetchTable('Staffs')->Users->find('list', limit: 200)->all();
        $competitions = $this->fetchTable('Staffs')->Competitions->find('list', limit: 200)->all();
        $this->set(compact('staff', 'users', 'competitions'));
    }
    /**
     * Edit method
     *
     * @param string|null $id Staff id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $staff = $this->fetchTable('Staffs')->get($id, contain: []);
        $session = $this->getRequest()->getSession();
        $session->write('LastViewed.staff_id', (int)$id);
        $session->write('ScrollTo.staff_id', (int)$id);

        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $data = $this->getRequest()->getData();
            $staff = $this->fetchTable('Staffs')->patchEntity($staff, $data);
            if ($this->fetchTable('Staffs')->save($staff)) {
                $this->Flash->success(__('A(z) staff adatai sikeresen mentésre kerültek.'));

                $redirectParams = (array)$session->read('Paging.Staffs.params');

                return $this->redirect([
                    'action' => 'index',
                    '?' => $redirectParams,
                ]);
            }
            $this->Flash->error(__('A(z) staff mentése nem sikerült. Kérem, nézze át és javítsa az adatokat, majd mentsen újra.'));
        }
        $users = $this->fetchTable('Staffs')->Users->find('list', limit: 200)->all();
        $competitions = $this->fetchTable('Staffs')->Competitions->find('list', limit: 200)->all();
        $this->set(compact('staff', 'users', 'competitions'));
    }
    /**
     * Delete method
     *
     * @param string|null $id Staff id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);
        
        $table = $this->fetchTable('Staffs');
        $staff = $table->get($id);

        $session = $this->getRequest()->getSession();
        $session->delete('LastViewed.staff_id');

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
            $session->write('ScrollTo.staff_id', (int)$neighbor->id);
        } else {
            $session->delete('ScrollTo.staff_id');
        }

        if ($table->delete($staff)) {
            $this->Flash->success(__('A(z) staff sikeresen törölve lett.'));
        } else {
            $this->Flash->error(__('A törlés sikertelen. Kérjük, próbálja újra.'));
        }

        $redirectParams = (array)$session->read('Paging.Staffs.params');

        return $this->redirect([
            'action' => 'index',
            '?' => $redirectParams,
        ]);
    }}
