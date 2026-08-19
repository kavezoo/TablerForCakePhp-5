<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ClubsFixture
 */
class ClubsFixture extends TestFixture
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
                'country_id' => 1,
                'city_id' => 1,
                'clubpresident_id' => 'Lorem ipsum dolor sit amet',
                'name' => 'Lorem ipsum dolor sit amet',
                'short_name' => 'Lorem ipsum dolor sit amet',
                'logo' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'enabled' => 1,
                'address' => 'Lorem ipsum dolor sit amet',
                'phone' => 'Lorem ipsum dolor sit amet',
                'web' => 'Lorem ipsum dolor sit amet',
                'facebook' => 'Lorem ipsum dolor sit amet',
                'insta' => 'Lorem ipsum dolor sit amet',
                'visible' => 1,
                'pos' => 1,
                'user_count' => 1,
                'competition_count' => 1,
                'club_president_id' => 'd406077b-6b1b-4a56-8880-acf3dc49f976',
                'national_membership_fee_date' => '2026-08-19',
                'created' => '2026-08-19 10:05:11',
                'modified' => '2026-08-19 10:05:11',
            ],
        ];
        parent::init();
    }
}
