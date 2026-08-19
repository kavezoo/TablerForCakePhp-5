<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SubclubsFixture
 */
class SubclubsFixture extends TestFixture
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
                'club_id' => 1,
                'competition_id' => 'Lorem ipsum dolor sit amet',
                'name' => 'Lorem ipsum dolor sit amet',
                'visible' => 1,
                'pos' => 1,
                'created' => '2026-08-19 16:52:30',
                'modified' => '2026-08-19 16:52:30',
            ],
        ];
        parent::init();
    }
}
