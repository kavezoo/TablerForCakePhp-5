<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LanguagesFixture
 */
class LanguagesFixture extends TestFixture
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
                'code' => 'Lorem ip',
                'name' => 'Lorem ipsum dolor sit amet',
                'endonim_name' => 'Lorem ipsum dolor sit amet',
                'visible' => 1,
                'pos' => 1,
                'created' => '2026-08-19 16:52:30',
                'modified' => '2026-08-19 16:52:30',
            ],
        ];
        parent::init();
    }
}
