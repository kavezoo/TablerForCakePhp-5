<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Http\Exception\NotFoundException;

class CitiesController extends AppController
{
	/**
	 * Index metódus - Rugalmasan konfigurálható keresési mezőkkel
	 */
	public function index()
	{
		$session = $this->getRequest()->getSession();
		$queryParams = $this->getRequest()->getQueryParams();

		// =========================================================================
		// ⚙️ KERESÉSI BEÁLLÍTÁSOK (Itt kapcsold be/ki a kívánt keresési mezőket)
		// =========================================================================
		$searchableFields = [
			// --- 1. Saját tábla (Cities) mezői ---
			'Cities.name',              // Település neve
			'Cities.shortname',         // Rövid név
			'Cities.zip',               // Irányítószám
			// 'Cities.id',             // ID alapján keresés
			// 'Cities.address',        // Cím mező (ha van)

			// --- 2. Szülő: Megyék (Counties) mezői ---
			'Counties.name',            // Megye neve
			// 'Counties.shortname',    // Megye rövid neve (ha van)

			// --- 3. Szülő: Országok (Countries) mezői ---
			'Countries.name',           // Ország neve
			// 'Countries.iso_code',    // Ország ISO kódja (pl. HU, DE)
			// 'Countries.phone_code',  // Országhívó (ha van)
		];

		// =========================================================================
		// ⚙️ LAPOZÓ ÉS RELÁCIÓK BEÁLLÍTÁSA
		// =========================================================================
		$this->paginate = [
			'limit' => 100,
			'maxLimit' => 100,
		];

		// Ha üres az URL, de a Sessionben van mentett állapot, oda irányítunk vissza
		if (empty($queryParams) && $session->check('Paging.Cities.params')) {
			$savedParams = $session->read('Paging.Cities.params');
			if (!empty($savedParams)) {
				return $this->redirect([
					'action' => 'index',
					'?' => $savedParams,
				]);
			}
		}

		$query = $this->Cities->find()->contain(['Countries', 'Counties']);

		// =========================================================================
		// 🔍 KERESÉS VÉGREHAJTÁSA A KONFIGURÁLT MEZŐK ALAPJÁN
		// =========================================================================
		// Ha kifejezetten törölni szeretné a keresést (vagy nincs search a kérésben de volt sessionben):
		if (isset($queryParams['search']) && trim($queryParams['search']) === '') {
			$session->delete('Paging.Cities.params.search');
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
			$cities = $this->paginate($query);

			if (!empty($queryParams)) {
				$session->write('Paging.Cities.params', $queryParams);
			}
		} catch (NotFoundException $e) {
			$this->Flash->warning(__('A kért oldal nem található, ezért átirányítottuk az első oldalra.'));

			$fallbackParams = $queryParams;
			unset($fallbackParams['page']);

			$session->write('Paging.Cities.params', $fallbackParams);

			return $this->redirect([
				'action' => 'index',
				'?' => $fallbackParams,
			]);
		}

		// Kiemelés és görgetés ID-k
		$lastViewedId = $session->read('LastViewed.city_id');
		$scrollToId = $session->read('ScrollTo.city_id') ?? $lastViewedId;

		$this->set(compact('cities', 'lastViewedId', 'scrollToId', 'search'));
	}

    /**
     * View metódus - Szülő adatok betöltésével
     */
    public function view($id = null)
    {
        $this->getRequest()->getSession()->write('LastViewed.city_id', (int)$id);
        $this->getRequest()->getSession()->write('ScrollTo.city_id', (int)$id);

        $city = $this->Cities->get($id, contain: ['Countries', 'Counties']);

        $this->set(compact('city'));
    }

    /**
     * Add metódus - Lenyíló listák (Countries, Counties) lekérése
     */
    public function add()
    {
        $city = $this->Cities->newEmptyEntity();

        if ($this->getRequest()->is('post')) {
            $city = $this->Cities->patchEntity($city, $this->getRequest()->getData());
            if ($this->Cities->save($city)) {
                $this->Flash->success(__('A település sikeresen hozzáadva.'));

                $this->getRequest()->getSession()->write('LastViewed.city_id', (int)$city->id);
                $this->getRequest()->getSession()->write('ScrollTo.city_id', (int)$city->id);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('A mentés sikertelen. Kérjük, próbálja újra.'));
        }

        $countries = $this->Cities->Countries->find('list', limit: 200)->all();
        $counties = $this->Cities->Counties->find('list', limit: 200)->all();

        $this->set(compact('city', 'countries', 'counties'));
    }

    /**
     * Edit metódus - Lenyíló listák (Countries, Counties) lekérése
     */
    public function edit($id = null)
    {
        $session = $this->getRequest()->getSession();
        $session->write('LastViewed.city_id', (int)$id);
        $session->write('ScrollTo.city_id', (int)$id);

        $city = $this->Cities->get($id, contain: ['Countries', 'Counties']);

        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
			$data = $this->getRequest()->getData();
			//dd($data);
            $city = $this->Cities->patchEntity($city, $data);
			//dd($city->toArray());
			//dd($city->getErrors());
            if ($this->Cities->save($city)) {
                $this->Flash->success(__('A település adatai sikeresen mentve.'));

                $redirectParams = $session->read('Paging.Cities.params') ?? [];

                return $this->redirect([
                    'action' => 'index',
                    '?' => $redirectParams,
                ]);
            }
            $this->Flash->error(__('A mentés sikertelen. Kérjük, próbálja újra.'));
        }

        $countries = $this->Cities->Countries->find('list', limit: 200)->all();
        $counties = $this->Cities->Counties->find('list', limit: 200)->all();

        $this->set(compact('city', 'countries', 'counties'));
    }

    /**
     * Delete metódus
     */
    public function delete($id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);
        $session = $this->getRequest()->getSession();

        $session->delete('LastViewed.city_id');

        $neighbor = $this->Cities->find()
            ->select(['id'])
            ->where(['id !=' => (int)$id])
            ->orderByDesc('id')
            ->first();

        if ($neighbor) {
            $session->write('ScrollTo.city_id', (int)$neighbor->id);
        }

        $city = $this->Cities->get($id);
        if ($this->Cities->delete($city)) {
            $this->Flash->success(__('A település sikeresen törölve lett.'));
        } else {
            $this->Flash->error(__('A törlés sikertelen. Kérjük, próbálja újra.'));
        }

        $redirectParams = $session->read('Paging.Cities.params') ?? [];

        return $this->redirect([
            'action' => 'index',
            '?' => $redirectParams,
        ]);
    }
}