<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Templates Controller
 *
 * @property \App\Model\Table\TemplatesTable $Templates
 */
class TemplatesController extends AppController
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
            $session->delete('Paging.Templates.params');

            return $this->redirect(['action' => 'index']);
        }

        // =========================================================================
        // ⚙️ KERESÉSI BEÁLLÍTÁSOK (Itt kapcsold be/ki a kívánt keresési mezőket)
        // =========================================================================
        $searchableFields = [
            // --- 1. Saját tábla (Templates) mezői ---
            // 'Templates.id',
			'Templates.' . $this->Templates->getDisplayField(),	// name általában
        ];

        // =========================================================================
        // ⚙️ LAPOZÓ BEÁLLÍTÁSA
        // =========================================================================
        $this->paginate = [
            'limit' => 20,
            'maxLimit' => 100,
        ];

        // Ha üres az URL, de a Sessionben van érvényes mentett állapot, oda irányítunk vissza
        if (empty($queryParams) && $session->check('Paging.Templates.params')) {
            $savedParams = (array)$session->read('Paging.Templates.params');
            if (!empty($savedParams)) {
                return $this->redirect([
                    'action' => 'index',
                    '?' => $savedParams,
                ]);
            }
        }

        $query = $this->fetchTable('Templates')->find();

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
            $templates = $this->paginate($query);

            if (!empty($queryParams)) {
                $session->write('Paging.Templates.params', $queryParams);
            }
        } catch (\Cake\Http\Exception\NotFoundException $e) {
            $this->Flash->warning(__('Page not found. Redirecting to the first page.'), ['plugin' => 'KvAdmin']);

            $fallbackParams = $queryParams;
            unset($fallbackParams['page']);

            $session->write('Paging.Templates.params', $fallbackParams);

            return $this->redirect([
                'action' => 'index',
                '?' => $fallbackParams,
            ]);
        }

        // Utoljára megtekintett / szerkesztett rekord visszagörgetésének támogatása
        $lastViewedId = $session->read('LastViewed._id');
        $scrollToId = $session->read('ScrollTo._id') ?? $lastViewedId;

        $this->set(compact('templates', 'lastViewedId', 'scrollToId', 'search'));
    }
    /**
     * View method
     *
     * @param string|null $id Template id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $template = $this->Templates->get($id, contain: []);
        $this->set(compact('template'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $template = $this->fetchTable('Templates')->newEmptyEntity();
        if ($this->getRequest()->is('post')) {
            $data = $this->getRequest()->getData();
            $template = $this->fetchTable('Templates')->patchEntity($template, $data);
            if ($this->fetchTable('Templates')->save($template)) {
                $this->Flash->success(__('The {0} has been saved.'), __('template'), ['plugin' => 'KvAdmin']);

                // Frissen létrehozott rekord megjelölése visszagörgetéshez az index nézetben
                $this->getRequest()->getSession()->write('ScrollTo.template_id', $template->template_id);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Could not save data. Please review the errors and try again.'), ['plugin' => 'KvAdmin']);
        }
        $this->set(compact('template'));
    }
    /**
     * Edit method
     *
     * @param string|null $id Template id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $template = $this->fetchTable('Templates')->get($id, contain: []);
        $session = $this->getRequest()->getSession();
        $session->write('LastViewed.template_id', (int)$id);
        $session->write('ScrollTo.template_id', (int)$id);

        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $data = $this->getRequest()->getData();
            $template = $this->fetchTable('Templates')->patchEntity($template, $data);
            if ($this->fetchTable('Templates')->save($template)) {
                $this->Flash->success(__('The {0} has been saved.', __('template')), ['plugin' => 'KvAdmin']);

                $redirectParams = (array)$session->read('Paging.Templates.params');

                return $this->redirect([
                    'action' => 'index',
                    '?' => $redirectParams,
                ]);
            }
            $this->Flash->error(__('Could not save data. Please review the errors and try again.'), ['plugin' => 'KvAdmin']);
        }
        $this->set(compact('template'));
    }
    /**
     * Delete method
     *
     * @param string|null $id Template id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);
        
        $table = $this->fetchTable('Templates');
        $template = $table->get($id);
		$templateName = $template->name;

        $session = $this->getRequest()->getSession();
        $session->delete('LastViewed.template_id');

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
            $session->write('ScrollTo.template_id', (int)$neighbor->id);
        } else {
            $session->delete('ScrollTo.template_id');
        }

        if ($table->delete($template)) {
            $this->Flash->success(__('The {0} has been successfully deleted.', __('template')), ['plugin' => 'KvAdmin']);
        } else {
            $this->Flash->error(__('Could not delete the record. Please try again.'), ['plugin' => 'KvAdmin']);
        }

        $redirectParams = (array)$session->read('Paging.Templates.params');

        return $this->redirect([
            'action' => 'index',
            '?' => $redirectParams,
        ]);
    }}
