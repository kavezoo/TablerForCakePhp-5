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
                'user_id' => '55eaece6-fafb-42aa-9383-0db531859289',
                'competition_id' => 'b61e6c89-73a1-45f4-b4b8-fb837498aee4',
                'role' => 'Lorem ipsum dolor ',
                'visible' => 1,
                'pos' => 1,
                'created' => '2026-08-19 12:59:20',
                'modified' => '2026-08-19 12:59:20',
            ],
        ];
        parent::init();
    }
}
