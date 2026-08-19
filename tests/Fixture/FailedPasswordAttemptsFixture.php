<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FailedPasswordAttemptsFixture
 */
class FailedPasswordAttemptsFixture extends TestFixture
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
                'id' => '7634c282-4e74-4e75-ac8f-23fc2be5507f',
                'user_id' => '110ddbe6-788f-4d5b-a1c2-d1fb2c8125b0',
                'created' => '2026-08-19 16:52:30',
            ],
        ];
        parent::init();
    }
}
