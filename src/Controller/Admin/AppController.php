<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController as BaseController;

class AppController extends BaseController
{
    public function initialize(): void
    {
        parent::initialize();

        // Beállítja a templates/layout/admin.php fájlt alapértelmezettnek
        $this->viewBuilder()->setLayout('admin');
		
    }
}