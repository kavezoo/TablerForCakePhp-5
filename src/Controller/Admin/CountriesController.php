<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Countries Controller
 *
 * @property \App\Model\Table\CountriesTable $Countries
 */
class CountriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
		$session = $this->getRequest()->getSession();
		$queryParams = $this->getRequest()->getQueryParams();

		// =========================================================================
		// ⚙️ KERESÉSI BEÁLLÍTÁSOK (Itt kapcsold be/ki a kívánt keresési mezőket)
		// =========================================================================
		$searchableFields = [
			// --- 1. Saját tábla (Countries) mezői ---
			// 'Countries.id',             // ID alapján keresés
			'Countries.name',              // Település neve

			// --- 2. Szülő mezői ---
			// 'Parents.name',

			// --- 3. Szülő mezői ---
			// 'Parents.name',
		];

		// =========================================================================
		// ⚙️ LAPOZÓ ÉS RELÁCIÓK BEÁLLÍTÁSA
		// =========================================================================
		$this->paginate = [
			'limit' => 20,
			'maxLimit' => 100,
		];

		// Ha üres az URL, de a Sessionben van mentett állapot, oda irányítunk vissza
		if (empty($queryParams) && $session->check('Paging.Countries.params')) {
			$savedParams = $session->read('Paging.Countries.params');
			if (!empty($savedParams)) {
				return $this->redirect([
					'action' => 'index',
					'?' => $savedParams,
				]);
			}
		}
		
        $query = $this->Countries->find()
            ->contain(['Continents']);

		// =========================================================================
		// 🔍 KERESÉS VÉGREHAJTÁSA A KONFIGURÁLT MEZŐK ALAPJÁN
		// =========================================================================
		// Ha kifejezetten törölni szeretné a keresést (vagy nincs search a kérésben de volt sessionben):
		if (isset($queryParams['search']) && trim($queryParams['search']) === '') {
			$session->delete('Paging.Countries.params.search');
		}

		$search = trim((string)($queryParams['search'] ?? ''));
		if ($search !== '' && !empty($searchableFields)) {
			$searchLike = '%' . $search . '%';
			$conditions = [];

			foreach ($searchableFields as $field) {
				$conditions[$field . ' LIKE'] = $searchLike;
			}

			// Egyetlen közös OR blokkba tesszük az aktív feltételeket
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
		} catch (NotFoundException $e) {
			$this->Flash->warning(__('A kért oldal nem található, ezért átirányítottuk az első oldalra.'));

			$fallbackParams = $queryParams;
			unset($fallbackParams['page']);

			$session->write('Paging.Countries.params', $fallbackParams);

			return $this->redirect([
				'action' => 'index',
				'?' => $fallbackParams,
			]);
		}

		// Kiemelés és görgetés ID-k
		$lastViewedId = $session->read('LastViewed.city_id');
		$scrollToId = $session->read('ScrollTo.city_id') ?? $lastViewedId;

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
        $country = $this->Countries->newEmptyEntity();
        if ($this->request->is('post')) {
			$data = $this->request->getData();
			// dd($data);
            $country = $this->Countries->patchEntity($country, $data);
			// dd($country->toArray());
			// dd($country->getErrors());
            if ($this->Countries->save($country)) {
				// dd($country->toArray());
                $this->Flash->success(__('The country has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The country could not be saved. Please, try again.'));
            //$this->Flash->error(__('A(z) country adatait nem sikerült menteni. Kérem ellenőrizze és javítsa az adatokat majd mentsen újra.'));
			$this->Flash->error('Nem sikerült az adatok mentése. Kérem ellenőrizze és javítsa az adatokat majd mentsen újra.');
        }
		$continents = $this->Countries->Continents->find('list', limit: 200, order: ['pos' => 'asc', 'name' => 'asc'], conditions: ['visible' => true])->all();
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
        $country = $this->Countries->get($id, contain: []);
		$session = $this->getRequest()->getSession();
		$session->write('LastViewed.$country_id', (int) $id);
		$session->write('ScrollTo.$country_id', (int) $id);

		$country = $this->Countries->get($id, contain: []);
		//dd($country->toArray());

		if ($this->getRequest()->is(['patch', 'post', 'put'])) {
			$data = $this->getRequest()->getData();
			//debug($data);
			$country = $this->Countries->patchEntity($country, $data);
			//dd($country->toArray());
			//dd($country->getErrors());
			if ($this->Countries->save($country)) {
				//dd($country->toArray());
				//$this->Flash->success(__('The country has been saved.'));
				$this->Flash->success(__('A(z) country adatai sikeresen mentésre kerültek.'));

                $redirectParams = $session->read('Paging.Countries.params') ?? [];

                return $this->redirect([
                    'action' => 'index',
                    '?' => $redirectParams,
                ]);
            }
			//$this->Flash->error(__('The country could not be saved. Please, try again.'));
			$this->Flash->error(__('A(z) country mentése nem sikerült. Kérem, nézze át és javítsa az azadatokat majd mentsen újra.'));
            //$this->Flash->error(__('A mentés sikertelen. Kérjük, próbálja újra.'));
        }
        $continents = $this->Countries->Continents->find('list', limit: 200, order: ['pos' => 'asc', 'name' => 'asc'], conditions: ['visible' => true])->all();
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
        $session = $this->getRequest()->getSession();

        $session->delete('LastViewed.$country_id');

        $neighbor = $this->Countries->find()
            ->select(['id'])
            ->where(['id !=' => (int) $id])
            ->orderByDesc('id')
            ->first();

        if ($neighbor) {
            $session->write('ScrollTo.$country_id', (int) $neighbor->id);
        }

		$country = $this->Countries->get($id);
        if ($this->Countries->delete($country)) {
            //$this->Flash->success(__('The country has been deleted.'));
            $this->Flash->success(__('A település sikeresen törölve lett.'));
        } else {
            //$this->Flash->error(__('The country could not be deleted. Please, try again.'));
            $this->Flash->error(__('A törlés sikertelen. Kérjük, próbálja újra.'));
        }

        $redirectParams = $session->read('Paging.Countries.params') ?? [];

        return $this->redirect([
            'action' => 'index',
            '?' => $redirectParams,
        ]);
	}
}
