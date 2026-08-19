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
                'competition_id' => '14415ecf-d7e8-49be-ad6e-e232b7654a7d',
                'user_id' => '74225d84-0485-46cd-bb62-a7446f61c7e2',
                'staff_role' => 'Lorem ipsum dolor ',
                'visible' => 1,
                'pos' => 1,
                'created' => '2026-08-19 10:05:11',
                'modified' => '2026-08-19 10:05:11',
            ],
        ];
        parent::init();
    }
}
