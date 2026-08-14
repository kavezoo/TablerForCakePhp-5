<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Cities Controller
 *
 * @property \App\Model\Table\CitiesTable $Cities
 */
class CitiesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
		$this->paginate['limit'] = 100;
		
        $query = $this->Cities->find()
            ->contain(['Countries', 'Counties']);
        $cities = $this->paginate($query);

		//$this->Flash->Default(__('The city has been DEFAULT.'));
		//$this->Flash->ImportantDefault(__('The city has been DEFAULT.'));
		//
		//$this->Flash->Success(__('The city has been SUCCESS.'));
		//$this->Flash->ImportantSuccess(__('The city has been SUCCESS.'));
		//
		//$this->Flash->Warning(__('The city has been WARNING.'));
		//$this->Flash->ImportantWarning(__('The city has been WARNING.'));
		//
		//$this->Flash->Error(__('The city has been ERROR.'));
		//$this->Flash->ImportantError(__('The city has been ERROR.'));
		//
		//$this->Flash->Danger(__('The city has been DANGER.'));
		//$this->Flash->ImportantDanger(__('The city has been DANGER.'));
		//
		//$this->Flash->Info(__('The city has been INFO.'));
		//$this->Flash->ImportantInfo(__('The city has been INFO.'));

        $this->set(compact('cities'));
    }

    /**
     * View method
     *
     * @param string|null $id City id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $city = $this->Cities->get($id, contain: ['Countries', 'Counties', 'Clubs', 'Competitions']);
        $this->set(compact('city'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $city = $this->Cities->newEmptyEntity();
        if ($this->request->is('post')) {
            $city = $this->Cities->patchEntity($city, $this->request->getData());
            if ($this->Cities->save($city)) {
                $this->Flash->success(__('The city has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The city could not be saved. Please, try again.'));
        }
        $countries = $this->Cities->Countries->find('list', limit: 200)->all();
        $counties = $this->Cities->Counties->find('list', limit: 200)->all();
        $this->set(compact('city', 'countries', 'counties'));
    }

    /**
     * Edit method
     *
     * @param string|null $id City id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		// Elmentjük a legutóbb megtekintett ID-t a Session-be
		$this->getRequest()->getSession()->write('LastViewed.city_id', $id);

        $city = $this->Cities->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $city = $this->Cities->patchEntity($city, $this->request->getData());
            if ($this->Cities->save($city)) {
                $this->Flash->success(__('The city has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The city could not be saved. Please, try again.'));
        }
        $countries = $this->Cities->Countries->find('list', limit: 200)->all();
        $counties = $this->Cities->Counties->find('list', limit: 200)->all();
        $this->set(compact('city', 'countries', 'counties'));
    }

    /**
     * Delete method
     *
     * @param string|null $id City id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $city = $this->Cities->get($id);
        if ($this->Cities->delete($city)) {
            $this->Flash->success(__('The city has been deleted.'));
        } else {
            $this->Flash->error(__('The city could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
