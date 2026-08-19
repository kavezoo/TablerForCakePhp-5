<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * StaffsFixture
 */
class StaffsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'user_id' => '8049a07f-a971-48e8-8e42-5a092c767f30',
                'competition_id' => 'f7c2e6ed-d002-4692-88b1-674e7296e844',
                'role' => 'Lorem ipsum dolor ',
                'visible' => 1,
                'pos' => 1,
                'created' => '2026-08-19 16:52:30',
                'modified' => '2026-08-19 16:52:30',
            ],
        ];
        parent::init();
    }
}
