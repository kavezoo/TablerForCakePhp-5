<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Countries Controller
 *
 * @property \App\Model\Table\CountriesTable $Countries
 */
class CountriesController extends AppController
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
            $session->delete('Paging.Countries.params');

            return $this->redirect(['action' => 'index']);
        }

        // =========================================================================
        // ⚙️ KERESÉSI BEÁLLÍTÁSOK (Itt kapcsold be/ki a kívánt keresési mezőket)
        // =========================================================================
        $searchableFields = [
            // --- 1. Saját tábla (Countries) mezői ---
            // 'Countries.id',
            'Countries.name',
            // --- 2. Kapcsolt (BelongsTo) táblák mezői ---
            // 'Continents.name',
        ];

        // =========================================================================
        // ⚙️ LAPOZÓ BEÁLLÍTÁSA
        // =========================================================================
        $this->paginate = [
            'limit' => 20,
            'maxLimit' => 100,
        ];

        // Ha üres az URL, de a Sessionben van érvényes mentett állapot, oda irányítunk vissza
        if (empty($queryParams) && $session->check('Paging.Countries.params')) {
            $savedParams = (array)$session->read('Paging.Countries.params');
            if (!empty($savedParams)) {
                return $this->redirect([
                    'action' => 'index',
                    '?' => $savedParams,
                ]);
            }
        }

        $query = $this->fetchTable('Countries')->find()
            ->contain(['Continents']);

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
            $countries = $this->paginate($query);

            if (!empty($queryParams)) {
                $session->write('Paging.Countries.params', $queryParams);
            }
        } catch (\Cake\Http\Exception\NotFoundException $e) {
            $this->Flash->warning(__('A kért oldal nem található, ezért átirányítottuk az első oldalra.'));

            $fallbackParams = $queryParams;
            unset($fallbackParams['page']);

            $session->write('Paging.Countries.params', $fallbackParams);

            return $this->redirect([
                'action' => 'index',
                '?' => $fallbackParams,
            ]);
        }

        // Utoljára megtekintett / szerkesztett rekord visszagörgetésének támogatása
        $lastViewedId = $session->read('LastViewed._id');
        $scrollToId = $session->read('ScrollTo._id') ?? $lastViewedId;

        $this->set(compact('countries', 'lastViewedId', 'scrollToId', 'search'));
    }
    /**
     * View method
     *
     * @param string|null $id Country id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $country = $this->Countries->get($id, contain: ['Continents', 'Cities', 'Clubs', 'CompetitionTextTemplates', 'Competitions', 'Counties', 'CountryVisibilities', 'EmailTemplates', 'EventLogs', 'Setups', 'Users']);
        $this->set(compact('country'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $country = $this->fetchTable('Countries')->newEmptyEntity();
        if ($this->getRequest()->is('post')) {
            $data = $this->getRequest()->getData();
            $country = $this->fetchTable('Countries')->patchEntity($country, $data);
            if ($this->fetchTable('Countries')->save($country)) {
                $this->Flash->success(__('The country has been saved.'));

                // Frissen létrehozott rekord megjelölése visszagörgetéshez az index nézetben
                $this->getRequest()->getSession()->write('ScrollTo.country_id', $country->country_id);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Nem sikerült az adatok mentése. Kérem ellenőrizze és javítsa az adatokat majd mentsen újra.'));
        }
        $continents = $this->fetchTable('Countries')->Continents->find('list', limit: 200)->all();
        $this->set(compact('country', 'continents'));
    }
    /**
     * Edit method
     *
     * @param string|null $id Country id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $country = $this->fetchTable('Countries')->get($id, contain: []);
        $session = $this->getRequest()->getSession();
        $session->write('LastViewed.country_id', (int)$id);
        $session->write('ScrollTo.country_id', (int)$id);

        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $data = $this->getRequest()->getData();
            $country = $this->fetchTable('Countries')->patchEntity($country, $data);
            if ($this->fetchTable('Countries')->save($country)) {
                $this->Flash->success(__('A(z) country adatai sikeresen mentésre kerültek.'));

                $redirectParams = (array)$session->read('Paging.Countries.params');

                return $this->redirect([
                    'action' => 'index',
                    '?' => $redirectParams,
                ]);
            }
            $this->Flash->error(__('A(z) country mentése nem sikerült. Kérem, nézze át és javítsa az adatokat, majd mentsen újra.'));
        }
        $continents = $this->fetchTable('Countries')->Continents->find('list', limit: 200)->all();
        $this->set(compact('country', 'continents'));
    }
    /**
     * Delete method
     *
     * @param string|null $id Country id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);
        
        $table = $this->fetchTable('Countries');
        $country = $table->get($id);

        $session = $this->getRequest()->getSession();
        $session->delete('LastViewed.country_id');

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
            $session->write('ScrollTo.country_id', (int)$neighbor->id);
        } else {
            $session->delete('ScrollTo.country_id');
        }

        if ($table->delete($country)) {
            $this->Flash->success(__('A(z) country sikeresen törölve lett.'));
        } else {
            $this->Flash->error(__('A törlés sikertelen. Kérjük, próbálja újra.'));
        }

        $redirectParams = (array)$session->read('Paging.Countries.params');

        return $this->redirect([
            'action' => 'index',
            '?' => $redirectParams,
        ]);
    }}
