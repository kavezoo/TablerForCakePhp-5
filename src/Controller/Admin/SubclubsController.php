<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Subclubs Controller
 *
 * @property \App\Model\Table\SubclubsTable $Subclubs
 */
class SubclubsController extends AppController
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
            $session->delete('Paging.Subclubs.params');

            return $this->redirect(['action' => 'index']);
        }

        // =========================================================================
        // ⚙️ KERESÉSI BEÁLLÍTÁSOK (Itt kapcsold be/ki a kívánt keresési mezőket)
        // =========================================================================
        $searchableFields = [
            // --- 1. Saját tábla (Subclubs) mezői ---
            // 'Subclubs.id',
            'Subclubs.',
            // --- 2. Kapcsolt (BelongsTo) táblák mezői ---
            // 'Clubs.name',
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
        if (empty($queryParams) && $session->check('Paging.Subclubs.params')) {
            $savedParams = (array)$session->read('Paging.Subclubs.params');
            if (!empty($savedParams)) {
                return $this->redirect([
                    'action' => 'index',
                    '?' => $savedParams,
                ]);
            }
        }

        $query = $this->fetchTable('Subclubs')->find()
            ->contain(['Clubs', 'Competitions']);

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
            $subclubs = $this->paginate($query);

            if (!empty($queryParams)) {
                $session->write('Paging.Subclubs.params', $queryParams);
            }
        } catch (\Cake\Http\Exception\NotFoundException $e) {
            $this->Flash->warning(__('A kért oldal nem található, ezért átirányítottuk az első oldalra.'));

            $fallbackParams = $queryParams;
            unset($fallbackParams['page']);

            $session->write('Paging.Subclubs.params', $fallbackParams);

            return $this->redirect([
                'action' => 'index',
                '?' => $fallbackParams,
            ]);
        }

        // Utoljára megtekintett / szerkesztett rekord visszagörgetésének támogatása
        $lastViewedId = $session->read('LastViewed._id');
        $scrollToId = $session->read('ScrollTo._id') ?? $lastViewedId;

        $this->set(compact('subclubs', 'lastViewedId', 'scrollToId', 'search'));
    }
    /**
     * View method
     *
     * @param string|null $id Subclub id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $subclub = $this->Subclubs->get($id, contain: ['Clubs', 'Competitions', 'CompetitionsUsers']);
        $this->set(compact('subclub'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $subclub = $this->fetchTable('Subclubs')->newEmptyEntity();
        if ($this->getRequest()->is('post')) {
            $data = $this->getRequest()->getData();
            $subclub = $this->fetchTable('Subclubs')->patchEntity($subclub, $data);
            if ($this->fetchTable('Subclubs')->save($subclub)) {
                $this->Flash->success(__('The subclub has been saved.'));

                // Frissen létrehozott rekord megjelölése visszagörgetéshez az index nézetben
                $this->getRequest()->getSession()->write('ScrollTo.subclub_id', $subclub->subclub_id);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Nem sikerült az adatok mentése. Kérem ellenőrizze és javítsa az adatokat majd mentsen újra.'));
        }
        $clubs = $this->fetchTable('Subclubs')->Clubs->find('list', limit: 200)->all();
        $competitions = $this->fetchTable('Subclubs')->Competitions->find('list', limit: 200)->all();
        $this->set(compact('subclub', 'clubs', 'competitions'));
    }
    /**
     * Edit method
     *
     * @param string|null $id Subclub id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subclub = $this->fetchTable('Subclubs')->get($id, contain: []);
        $session = $this->getRequest()->getSession();
        $session->write('LastViewed.subclub_id', (int)$id);
        $session->write('ScrollTo.subclub_id', (int)$id);

        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $data = $this->getRequest()->getData();
            $subclub = $this->fetchTable('Subclubs')->patchEntity($subclub, $data);
            if ($this->fetchTable('Subclubs')->save($subclub)) {
                $this->Flash->success(__('A(z) subclub adatai sikeresen mentésre kerültek.'));

                $redirectParams = (array)$session->read('Paging.Subclubs.params');

                return $this->redirect([
                    'action' => 'index',
                    '?' => $redirectParams,
                ]);
            }
            $this->Flash->error(__('A(z) subclub mentése nem sikerült. Kérem, nézze át és javítsa az adatokat, majd mentsen újra.'));
        }
        $clubs = $this->fetchTable('Subclubs')->Clubs->find('list', limit: 200)->all();
        $competitions = $this->fetchTable('Subclubs')->Competitions->find('list', limit: 200)->all();
        $this->set(compact('subclub', 'clubs', 'competitions'));
    }
    /**
     * Delete method
     *
     * @param string|null $id Subclub id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);
        
        $table = $this->fetchTable('Subclubs');
        $subclub = $table->get($id);

        $session = $this->getRequest()->getSession();
        $session->delete('LastViewed.subclub_id');

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
            $session->write('ScrollTo.subclub_id', (int)$neighbor->id);
        } else {
            $session->delete('ScrollTo.subclub_id');
        }

        if ($table->delete($subclub)) {
            $this->Flash->success(__('A(z) subclub sikeresen törölve lett.'));
        } else {
            $this->Flash->error(__('A törlés sikertelen. Kérjük, próbálja újra.'));
        }

        $redirectParams = (array)$session->read('Paging.Subclubs.params');

        return $this->redirect([
            'action' => 'index',
            '?' => $redirectParams,
        ]);
    }}
