<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Setups Controller
 *
 * @property \App\Model\Table\SetupsTable $Setups
 */
class SetupsController extends AppController
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
            $this->session->delete('Paging.Setups.params');

            return $this->redirect(['action' => 'index']);
        }

        // =========================================================================
        // ⚙️ KERESÉSI BEÁLLÍTÁSOK (Itt kapcsold be/ki a kívánt keresési mezőket)
        // =========================================================================
        $searchableFields = [
            // --- 1. Saját tábla (Setups) mezői ---
            // 'Setups.id',
			'Setups.name',	// . $this->Setups->getDisplayField(),	// name általában
        ];

        // =========================================================================
        // ⚙️ LAPOZÓ BEÁLLÍTÁSA
        // =========================================================================
        $this->paginate = [
            'limit' => 20,
            'maxLimit' => 100,
        ];

        // Ha üres az URL, de a Sessionben van érvényes mentett állapot, oda irányítunk vissza
        if (empty($queryParams) && $this->session->check('Paging.Setups.params')) {
            $savedParams = (array)$this->session->read('Paging.Setups.params');
            if (!empty($savedParams)) {
                return $this->redirect([
                    'action' => 'index',
                    '?' => $savedParams,
                ]);
            }
        }

        $query = $this->fetchTable('Setups')->find();

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
            $setups = $this->paginate($query);

            if (!empty($queryParams)) {
                $this->session->write('Paging.Setups.params', $queryParams);
            }
        } catch (\Cake\Http\Exception\NotFoundException $e) {
            $this->Flash->warning(__('Page not found. Redirecting to the first page.'), ['plugin' => 'KvAdmin']);

            $fallbackParams = $queryParams;
            unset($fallbackParams['page']);

            $this->session->write('Paging.Setups.params', $fallbackParams);

            return $this->redirect([
                'action' => 'index',
                '?' => $fallbackParams,
            ]);
        }

        // Utoljára megtekintett / szerkesztett rekord visszagörgetésének támogatása
        $lastViewedId = $this->session->read('LastViewed._id');
        $scrollToId = $this->session->read('ScrollTo._id') ?? $lastViewedId;

        $this->set(compact('setups', 'lastViewedId', 'scrollToId', 'search'));
    }
    /**
     * View method
     *
     * @param string|null $id Setup id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $setup = $this->Setups->get($id, contain: []);
		$this->session->write('LastViewed.Admin.setup_id', (int)$id ?? 0);
		$this->session->write('ScrollTo.Admin.setup_id', (int)$id ?? 0);
        $this->set(compact('setup'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $setup = $this->fetchTable('Setups')->newEmptyEntity();
        if ($this->getRequest()->is('post')) {
            $data = $this->getRequest()->getData();
            $setup = $this->fetchTable('Setups')->patchEntity($setup, $data);
            if ($this->fetchTable('Setups')->save($setup)) {
                $this->Flash->success(__('The {0} has been saved.'), __('setup'), ['plugin' => 'KvAdmin']);

                // Frissen létrehozott rekord megjelölése visszagörgetéshez az index nézetben
                $this->session->write('ScrollTo.Admin.setup.id', $setup->id ?? 0);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Could not save data. Please review the errors and try again.'), ['plugin' => 'KvAdmin']);
        }
        $this->set(compact('setup'));
    }
    /**
     * Edit method
     *
     * @param string|null $id Setup id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $setup = $this->fetchTable('Setups')->get($id, contain: []);
		$this->session->write('LastViewed.Admin.setup_id', (int)$id ?? 0);
		$this->session->write('ScrollTo.Admin.setup_id', (int)$id ?? 0);

        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $data = $this->getRequest()->getData();
            $setup = $this->fetchTable('Setups')->patchEntity($setup, $data);
            if ($this->fetchTable('Setups')->save($setup)) {
                $this->Flash->success(__('The {0} has been saved.', __('setup')), ['plugin' => 'KvAdmin']);

                $redirectParams = (array)$this->session->read('Paging.Admin.Setups.params');
                return $this->redirect([
                    'action' => 'index',
                    '?' => $redirectParams,
                ]);
            }
            $this->Flash->error(__('Could not save data. Please review the errors and try again.'), ['plugin' => 'KvAdmin']);
        }
        $this->set(compact('setup'));
    }
    /**
     * Delete method
     *
     * @param string|null $id Setup id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);
        
        $table = $this->fetchTable('Setups');
        $setup = $table->get($id);
		$setupName = $setup->name;

        $this->session->delete('LastViewed.setup_id');

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
            $this->session->write('ScrollTo.setup_id', (int)$neighbor->id);
        } else {
            $this->session->delete('ScrollTo.setup_id');
        }

        if ($table->delete($setup)) {
            $this->Flash->success(__('The {0} has been successfully deleted.', __('setup')), ['plugin' => 'KvAdmin']);
        } else {
            $this->Flash->error(__('Could not delete the record. Please try again.'), ['plugin' => 'KvAdmin']);
        }

        $redirectParams = (array)$this->session->read('Paging.Setups.params');
        return $this->redirect([
            'action' => 'index',
            '?' => $redirectParams,
        ]);
    }}
