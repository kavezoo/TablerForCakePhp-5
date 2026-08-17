<?php
declare(strict_types=1);

namespace KvAdmin\Controller;

use App\Controller\AppController as BaseController;

class AppController extends BaseController
{
    public function initialize(): void
    {
        parent::initialize();

        // Beállítjuk a plugin saját AppView osztályát:
        $this->viewBuilder()->setClassName('KvAdmin.App');
    }
}