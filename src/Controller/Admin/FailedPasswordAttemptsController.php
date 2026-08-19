<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * FailedPasswordAttempts Controller
 *
 * @property \App\Model\Table\FailedPasswordAttemptsTable $FailedPasswordAttempts
 */
class FailedPasswordAttemptsController extends AppController
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
            $session->delete('Paging.FailedPasswordAttempts.params');

            return $this->redirect(['action' => 'index']);
        }

        // =========================================================================
        // ⚙️ KERESÉSI BEÁLLÍTÁSOK (Itt kapcsold be/ki a kívánt keresési mezőket)
        // =========================================================================
        $searchableFields = [
            // --- 1. Saját tábla (FailedPasswordAttempts) mezői ---
            // 'FailedPasswordAttempts.id',
			'FailedPasswordAttempts.' . $this->FailedPasswordAttempts->getDisplayField(),	// name általában
            // --- 2. Kapcsolt (BelongsTo) táblák mezői ---
            // 'Users.name',
        ];

        // =========================================================================
        // ⚙️ LAPOZÓ BEÁLLÍTÁSA
        // =========================================================================
        $this->paginate = [
            'limit' => 20,
            'maxLimit' => 100,
        ];

        // Ha üres az URL, de a Sessionben van érvényes mentett állapot, oda irányítunk vissza
        if (empty($queryParams) && $session->check('Paging.FailedPasswordAttempts.params')) {
            $savedParams = (array)$session->read('Paging.FailedPasswordAttempts.params');
            if (!empty($savedParams)) {
                return $this->redirect([
                    'action' => 'index',
                    '?' => $savedParams,
                ]);
            }
        }

        $query = $this->fetchTable('FailedPasswordAttempts')->find()
            ->contain(['Users']);

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
            $failedPasswordAttempts = $this->paginate($query);

            if (!empty($queryParams)) {
                $session->write('Paging.FailedPasswordAttempts.params', $queryParams);
            }
        } catch (\Cake\Http\Exception\NotFoundException $e) {
            $this->Flash->warning(__('Page not found. Redirecting to the first page.'), ['plugin' => 'KvAdmin']);

            $fallbackParams = $queryParams;
            unset($fallbackParams['page']);

            $session->write('Paging.FailedPasswordAttempts.params', $fallbackParams);

            return $this->redirect([
                'action' => 'index',
                '?' => $fallbackParams,
            ]);
        }

        // Utoljára megtekintett / szerkesztett rekord visszagörgetésének támogatása
        $lastViewedId = $session->read('LastViewed._id');
        $scrollToId = $session->read('ScrollTo._id') ?? $lastViewedId;

        $this->set(compact('failedPasswordAttempts', 'lastViewedId', 'scrollToId', 'search'));
    }
    /**
     * View method
     *
     * @param string|null $id Failed Password Attempt id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $failedPasswordAttempt = $this->FailedPasswordAttempts->get($id, contain: ['Users']);
        $this->set(compact('failedPasswordAttempt'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $failedPasswordAttempt = $this->fetchTable('FailedPasswordAttempts')->newEmptyEntity();
        if ($this->getRequest()->is('post')) {
            $data = $this->getRequest()->getData();
            $failedPasswordAttempt = $this->fetchTable('FailedPasswordAttempts')->patchEntity($failedPasswordAttempt, $data);
            if ($this->fetchTable('FailedPasswordAttempts')->save($failedPasswordAttempt)) {
                $this->Flash->success(__('The {0} has been saved.'), __('failed password attempt'), ['plugin' => 'KvAdmin']);

                // Frissen létrehozott rekord megjelölése visszagörgetéshez az index nézetben
                $this->getRequest()->getSession()->write('ScrollTo.failedPasswordAttempt_id', $failedPasswordAttempt->failedPasswordAttempt_id);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Could not save data. Please review the errors and try again.'), ['plugin' => 'KvAdmin']);
        }
        $users = $this->fetchTable('FailedPasswordAttempts')->Users->find('list', limit: 200)->all();
        $this->set(compact('failedPasswordAttempt', 'users'));
    }
    /**
     * Edit method
     *
     * @param string|null $id Failed Password Attempt id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $failedPasswordAttempt = $this->fetchTable('FailedPasswordAttempts')->get($id, contain: []);
        $session = $this->getRequest()->getSession();
        $session->write('LastViewed.failedPasswordAttempt_id', (int)$id);
        $session->write('ScrollTo.failedPasswordAttempt_id', (int)$id);

        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $data = $this->getRequest()->getData();
            $failedPasswordAttempt = $this->fetchTable('FailedPasswordAttempts')->patchEntity($failedPasswordAttempt, $data);
            if ($this->fetchTable('FailedPasswordAttempts')->save($failedPasswordAttempt)) {
                $this->Flash->success(__('The {0} has been saved.', __('failed password attempt')), ['plugin' => 'KvAdmin']);

                $redirectParams = (array)$session->read('Paging.FailedPasswordAttempts.params');

                return $this->redirect([
                    'action' => 'index',
                    '?' => $redirectParams,
                ]);
            }
            $this->Flash->error(__('Could not save data. Please review the errors and try again.'), ['plugin' => 'KvAdmin']);
        }
        $users = $this->fetchTable('FailedPasswordAttempts')->Users->find('list', limit: 200)->all();
        $this->set(compact('failedPasswordAttempt', 'users'));
    }
    /**
     * Delete method
     *
     * @param string|null $id Failed Password Attempt id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);
        
        $table = $this->fetchTable('FailedPasswordAttempts');
        $failedPasswordAttempt = $table->get($id);
		$failedPasswordAttemptName = $failedPasswordAttempt->name;

        $session = $this->getRequest()->getSession();
        $session->delete('LastViewed.failedPasswordAttempt_id');

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
            $session->write('ScrollTo.failedPasswordAttempt_id', (int)$neighbor->id);
        } else {
            $session->delete('ScrollTo.failedPasswordAttempt_id');
        }

        if ($table->delete($failedPasswordAttempt)) {
            $this->Flash->success(__('The {0} has been successfully deleted.', __('failed password attempt')), ['plugin' => 'KvAdmin']);
        } else {
            $this->Flash->error(__('Could not delete the record. Please try again.'), ['plugin' => 'KvAdmin']);
        }

        $redirectParams = (array)$session->read('Paging.FailedPasswordAttempts.params');

        return $this->redirect([
            'action' => 'index',
            '?' => $redirectParams,
        ]);
    }}
