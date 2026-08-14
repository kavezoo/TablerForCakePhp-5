<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class AppTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        // Globálisan aktiválja az összes modellnél
        $this->addBehavior('LocalizedData');
    }
}