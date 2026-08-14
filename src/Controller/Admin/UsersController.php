<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use Cake\Event\EventInterface;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    /**
     * Kontroller előszűrés és jogosultság-kivételek
     *
     * @param \Cake\Event\EventInterface $event
     * @return \Cake\Http\Response|null|void
     */
		public function beforeFilter(EventInterface $event)
		{
			parent::beforeFilter($event);

			if ($this->components()->has('Authentication')) {
				$this->Authentication->addUnauthenticatedActions([
					'login',
					'register',
					'forgotPassword',
					'resetPassword',
					'socialLogin',
					'socialCallback',
				]);
			}
		}

		/**
		 * Regisztráció
		 */
		public function register()
		{
			$this->viewBuilder()->setLayout('auth');

			$user = $this->Users->newEmptyEntity();
			if ($this->request->is('post')) {
				$user = $this->Users->patchEntity($user, $this->request->getData());
				if ($this->Users->save($user)) {
					$this->Flash->success(__('Registration successful. You can now log in.'));
					return $this->redirect(['action' => 'login']);
				}
				$this->Flash->error(__('Registration failed. Please correct the errors and try again.'));
			}
			$this->set(compact('user'));
		}

		/**
		 * Elfelejtett jelszó
		 */
		public function forgotPassword()
		{
			$this->viewBuilder()->setLayout('auth');

			if ($this->request->is('post')) {
				$email = $this->request->getData('email');
				$user = $this->Users->findByEmail($email)->first();

				if ($user) {
					// Token generálás és email küldés
					// $token = bin2hex(random_bytes(16));
					$this->Flash->success(__('A password reset link has been sent to your email address.'));
					return $this->redirect(['action' => 'login']);
				}
				$this->Flash->error(__('Email address not found.'));
			}
		}

		/**
		 * Jelszócsere (Reset password link feldolgozása)
		 *
		 * @param string|null $token
		 */
		public function resetPassword(?string $token = null)
		{
			$this->viewBuilder()->setLayout('auth');

			if ($this->request->is('post')) {
				$password = $this->request->getData('password');
				$confirm = $this->request->getData('password_confirm');

				if ($password !== $confirm) {
					$this->Flash->error(__('Passwords do not match.'));
					return;
				}

				// Token alapján megkeressük a felhasználót és mentjük az új jelszót
				$this->Flash->success(__('Your password has been reset successfully.'));
				return $this->redirect(['action' => 'login']);
			}
		}


    // =========================================================================
    // HITELESÍTÉS & AUTENTIKÁCIÓ (AUTH)
    // =========================================================================

    /**
     * Bejelentkezés
     *
     * @return \Cake\Http\Response|null|void
     */
    public function login()
    {
        $this->viewBuilder()->setLayout('auth');

        // Ha a hivatalos Authentication plugin aktív:
        if ($this->components()->has('Authentication')) {
            $result = $this->Authentication->getResult();
            if ($result && $result->isValid()) {
                $target = $this->Authentication->getLoginRedirect() ?? ['controller' => 'Pages', 'action' => 'display', 'home'];

                return $this->redirect($target);
            }
            if ($this->request->is('post') && !$result->isValid()) {
                $this->Flash->error(__('Invalid email or password.'));
            }
        }
    }

    /**
     * Kijelentkezés
     *
     * @return \Cake\Http\Response|null
     */
    public function logout()
    {
        if ($this->components()->has('Authentication')) {
            $result = $this->Authentication->getResult();
            if ($result && $result->isValid()) {
                $this->Authentication->logout();
            }
        }

        $this->Flash->success(__('You have been logged out.'));

        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }


    // =========================================================================
    // FELHASZNÁLÓI PROFIL & SAJÁT BEÁLLÍTÁSOK
    // =========================================================================

    /**
     * Saját profil megtekintése
     *
     * @return \Cake\Http\Response|null|void
     */
    public function profile()
    {
        $identity = $this->request->getAttribute('identity');
        $userId = $identity ? $identity->getIdentifier() : null;

        if (!$userId) {
            $this->Flash->error(__('Please log in first.'));

            return $this->redirect(['action' => 'login']);
        }

        $user = $this->Users->get($userId);
        $this->set(compact('user'));
    }

    /**
     * Fiókbeállítások szerkesztése
     *
     * @return \Cake\Http\Response|null|void
     */
    public function settings()
    {
        $identity = $this->request->getAttribute('identity');
        $userId = $identity ? $identity->getIdentifier() : null;

        if (!$userId) {
            $this->Flash->error(__('Please log in first.'));

            return $this->redirect(['action' => 'login']);
        }

        $user = $this->Users->get($userId);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData(), [
                // Nem engedjük a jelszó és szerepkör közvetlen felülírását az alap űrlapról
                'accessibleFields' => ['role' => false, 'password' => false],
            ]);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your settings have been saved.'));

                return $this->redirect(['action' => 'settings']);
            }
            $this->Flash->error(__('Failed to save settings. Please try again.'));
        }
        $this->set(compact('user'));
    }


	/**
	 * OAuth átirányítás Facebook / Google szolgáltatókhoz
	 *
	 * @param string $provider 'facebook' vagy 'google'
	 * @return \Cake\Http\Response|null
	 */
	public function socialLogin(string $provider)
	{
		// Itt történik az OAuth átirányítás a választott szolgáltatóhoz (pl. SocialConnect vagy League OAuth klienssel)
		// Példa: return $this->redirect($authUrl);
		
		$this->Flash->info(__('Redirecting to {0}...', ucfirst($provider)));
		return $this->redirect(['action' => 'login']);
	}

	/**
	 * OAuth visszatérési végpont (Callback)
	 *
	 * @param string $provider 'facebook' vagy 'google'
	 * @return \Cake\Http\Response|null
	 */
	public function socialCallback(string $provider)
	{
		// A tokent és profiladatokat feldolgozó logika
		return $this->redirect(['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'index']);
	}


    // =========================================================================
    // ADMINISZTRÁCIÓS CRUD FUNKCIÓK
    // =========================================================================

    /**
     * Felhasználók listája (Admin)
     *
     * @return \Cake\Http\Response|null|void
     */
    public function index()
    {
        $query = $this->Users->find();
        $users = $this->paginate($query);

        $this->set(compact('users'));
    }

    /**
     * Egy felhasználó részletei (Admin)
     *
     * @param string|null $id Felhasználó azonosítója.
     * @return \Cake\Http\Response|null|void
     */
    public function view(?string $id = null)
    {
        $user = $this->Users->get($id, contain: []);
        $this->set(compact('user'));
    }

    /**
     * Új felhasználó létrehozása (Admin)
     *
     * @return \Cake\Http\Response|null|void
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Felhasználó szerkesztése (Admin)
     *
     * @param string|null $id Felhasználó azonosítója.
     * @return \Cake\Http\Response|null|void
     */
    public function edit(?string $id = null)
    {
        $user = $this->Users->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Felhasználó törlése (Admin)
     *
     * @param string|null $id Felhasználó azonosítója.
     * @return \Cake\Http\Response|null
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}