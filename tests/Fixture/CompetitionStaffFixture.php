<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CompetitionStaffFixture
 */
class CompetitionStaffFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'competition_staff';
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
                'competition_id' => '5a4967b4-f6ad-4911-a58f-cadcf5a0b609',
                'user_id' => 'a91944a2-4300-4669-8c3a-df3fe2b7c63e',
                'staff_role' => 'Lorem ipsum dolor ',
                'visible' => 1,
                'pos' => 1,
                'created' => '2026-08-19 12:35:17',
                'modified' => '2026-08-19 12:35:17',
            ],
        ];
        parent::init();
    }
}
