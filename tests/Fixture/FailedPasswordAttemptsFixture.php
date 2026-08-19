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
                'id' => 'ce49bde4-8a41-40e3-ad85-677fdcd6641f',
                'user_id' => '1e97d097-3c01-4b44-82a3-849a51df6ca9',
                'created' => '2026-08-19 12:59:20',
            ],
        ];
        parent::init();
    }
}
