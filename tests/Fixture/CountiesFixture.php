<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CountiesFixture
 */
class CountiesFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'shortname' => 'Lorem ipsum dolor sit amet',
                'capitalcity' => 'Lorem ipsum dolor sit amet',
                'region' => 'Lorem ipsum dolor sit amet',
                'pos' => 1,
                'visible' => 1,
                'city_count' => 1,
                'created' => '2026-08-12 08:05:34',
                'modified' => '2026-08-12 08:05:34',
            ],
        ];
        parent::init();
    }
}
