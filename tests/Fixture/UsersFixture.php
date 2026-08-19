<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
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
                'id' => '2eb1ecde-9080-4618-826e-91a9e0c48778',
                'city_id' => 1,
                'club_id' => 1,
                'username' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'first_name' => 'Lorem ipsum dolor sit amet',
                'last_name' => 'Lorem ipsum dolor sit amet',
                'phone' => 'Lorem ipsum dolor sit amet',
                'avatar' => 'Lorem ipsum dolor sit amet',
                'token' => 'Lorem ipsum dolor sit amet',
                'token_expires' => '2026-08-19 12:59:21',
                'api_token' => 'Lorem ipsum dolor sit amet',
                'activation_date' => '2026-08-19 12:59:21',
                'secret' => 'Lorem ipsum dolor sit amet',
                'secret_verified' => 1,
                'tos_date' => '2026-08-19 12:59:21',
                'active' => 1,
                'enabled' => 1,
                'is_superuser' => 1,
                'role' => 'Lorem ipsum dolor sit amet',
                'membership_status' => 'Lorem ipsum dolor ',
                'membership_joined_date' => '2026-08-19',
                'club_membership_fee_date' => '2026-08-19',
                'national_membership_fee_date' => '2026-08-19',
                'application_notified' => 1,
                'created' => '2026-08-19 12:59:21',
                'modified' => '2026-08-19 12:59:21',
                'additional_data' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'last_login' => '2026-08-19 12:59:21',
                'lockout_time' => '2026-08-19 12:59:21',
                'login_token' => 'Lorem ipsum dolor sit amet',
                'login_token_date' => '2026-08-19 12:59:21',
                'token_send_requested' => 1,
            ],
        ];
        parent::init();
    }
}
