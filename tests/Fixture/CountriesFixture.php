<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CountriesFixture
 */
class CountriesFixture extends TestFixture
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
                'continent_id' => 1,
                'iso2' => '',
                'name' => 'Lorem ipsum dolor sit amet',
                'endonim_name' => 'Lorem ipsum dolor sit amet',
                'locale' => 'Lorem ip',
                'timezone' => 'Lorem ipsum dolor sit amet',
                'phone_prefix' => 'Lorem ipsum do',
                'logo' => 'Lorem ipsum dolor sit amet',
                'currency' => 'L',
                'visible' => 1,
                'pos' => 1,
                'club_count' => 1,
                'setup_count' => 1,
                'user_count' => 1,
                'created' => '2026-08-12 08:05:25',
                'modified' => '2026-08-12 08:05:25',
            ],
        ];
        parent::init();
    }
}
