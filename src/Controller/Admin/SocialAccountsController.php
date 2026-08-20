<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * SocialAccounts Controller
 *
 * @property \App\Model\Table\SocialAccountsTable $SocialAccounts
 */
class SocialAccountsController extends AppController
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
            $this->session->delete('Paging.SocialAccounts.params');

            return $this->redirect(['action' => 'index']);
        }

        // =========================================================================
        // ⚙️ KERESÉSI BEÁLLÍTÁSOK (Itt kapcsold be/ki a kívánt keresési mezőket)
        // =========================================================================
        $searchableFields = [
            // --- 1. Saját tábla (SocialAccounts) mezői ---
            // 'SocialAccounts.id',
			'SocialAccounts.name',	// . $this->SocialAccounts->getDisplayField(),	// name általában
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
        if (empty($queryParams) && $this->session->check('Paging.SocialAccounts.params')) {
            $savedParams = (array)$this->session->read('Paging.SocialAccounts.params');
            if (!empty($savedParams)) {
                return $this->redirect([
                    'action' => 'index',
                    '?' => $savedParams,
                ]);
            }
        }

        $query = $this->fetchTable('SocialAccounts')->find()
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
            $socialAccounts = $this->paginate($query);

            if (!empty($queryParams)) {
                $this->session->write('Paging.SocialAccounts.params', $queryParams);
            }
        } catch (\Cake\Http\Exception\NotFoundException $e) {
            $this->Flash->warning(__('Page not found. Redirecting to the first page.'), ['plugin' => 'KvAdmin']);

            $fallbackParams = $queryParams;
            unset($fallbackParams['page']);

            $this->session->write('Paging.SocialAccounts.params', $fallbackParams);

            return $this->redirect([
                'action' => 'index',
                '?' => $fallbackParams,
            ]);
        }

        // Utoljára megtekintett / szerkesztett rekord visszagörgetésének támogatása
        $lastViewedId = $this->session->read('LastViewed._id');
        $scrollToId = $this->session->read('ScrollTo._id') ?? $lastViewedId;

        $this->set(compact('socialAccounts', 'lastViewedId', 'scrollToId', 'search'));
    }
    /**
     * View method
     *
     * @param string|null $id Social Account id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $socialAccount = $this->SocialAccounts->get($id, contain: ['Users']);
		$this->session->write('LastViewed.Admin.socialAccount_id', (int)$id ?? 0);
		$this->session->write('ScrollTo.Admin.socialAccount_id', (int)$id ?? 0);
        $this->set(compact('socialAccount'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $socialAccount = $this->fetchTable('SocialAccounts')->newEmptyEntity();
        if ($this->getRequest()->is('post')) {
            $data = $this->getRequest()->getData();
            $socialAccount = $this->fetchTable('SocialAccounts')->patchEntity($socialAccount, $data);
            if ($this->fetchTable('SocialAccounts')->save($socialAccount)) {
                $this->Flash->success(__('The {0} has been saved.'), __('social account'), ['plugin' => 'KvAdmin']);

                // Frissen létrehozott rekord megjelölése visszagörgetéshez az index nézetben
                $this->session->write('ScrollTo.Admin.socialAccount.id', $socialAccount->id ?? 0);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Could not save data. Please review the errors and try again.'), ['plugin' => 'KvAdmin']);
        }
        $users = $this->fetchTable('SocialAccounts')->Users->find('list', limit: 200)->all();
        $this->set(compact('socialAccount', 'users'));
    }
    /**
     * Edit method
     *
     * @param string|null $id Social Account id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $socialAccount = $this->fetchTable('SocialAccounts')->get($id, contain: []);
		$this->session->write('LastViewed.Admin.socialAccount_id', (int)$id ?? 0);
		$this->session->write('ScrollTo.Admin.socialAccount_id', (int)$id ?? 0);

        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $data = $this->getRequest()->getData();
            $socialAccount = $this->fetchTable('SocialAccounts')->patchEntity($socialAccount, $data);
            if ($this->fetchTable('SocialAccounts')->save($socialAccount)) {
                $this->Flash->success(__('The {0} has been saved.', __('social account')), ['plugin' => 'KvAdmin']);

                $redirectParams = (array)$this->session->read('Paging.Admin.SocialAccounts.params');
                return $this->redirect([
                    'action' => 'index',
                    '?' => $redirectParams,
                ]);
            }
            $this->Flash->error(__('Could not save data. Please review the errors and try again.'), ['plugin' => 'KvAdmin']);
        }
        $users = $this->fetchTable('SocialAccounts')->Users->find('list', limit: 200)->all();
        $this->set(compact('socialAccount', 'users'));
    }
    /**
     * Delete method
     *
     * @param string|null $id Social Account id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);
        
        $table = $this->fetchTable('SocialAccounts');
        $socialAccount = $table->get($id);
		$socialAccountName = $socialAccount->name;

        $this->session->delete('LastViewed.socialAccount_id');

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
            $this->session->write('ScrollTo.socialAccount_id', (int)$neighbor->id);
        } else {
            $this->session->delete('ScrollTo.socialAccount_id');
        }

        if ($table->delete($socialAccount)) {
            $this->Flash->success(__('The {0} has been successfully deleted.', __('social account')), ['plugin' => 'KvAdmin']);
        } else {
            $this->Flash->error(__('Could not delete the record. Please try again.'), ['plugin' => 'KvAdmin']);
        }

        $redirectParams = (array)$this->session->read('Paging.SocialAccounts.params');
        return $this->redirect([
            'action' => 'index',
            '?' => $redirectParams,
        ]);
    }}
