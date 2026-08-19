<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CompetitionsUsersFixture
 */
class CompetitionsUsersFixture extends TestFixture
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
                'user_id' => 'Lorem ipsum dolor sit amet',
                'competition_id' => 'Lorem ipsum dolor sit amet',
                'subclub_id' => 1,
                'status' => 'Lorem ipsum dolor ',
                'lunch_for_the_attendant' => 1,
                'companion_count' => 1,
                'special_lunch' => 'Lorem ipsum dolor sit amet',
                'racing_pipe_1_qty' => 1,
                'racing_pipe_2_qty' => 1,
                'racing_pipe_3_qty' => 1,
                'comment' => 'Lorem ipsum dolor sit amet',
                'fee_paid_at' => '2026-08-19 16:52:29',
                'fee_paid_by' => '58f6c3b5-3405-4909-b997-c84717e3c499',
                'entry_fee_amount' => 1.5,
                'racing_pipe_1_fee' => 1.5,
                'racing_pipe_2_fee' => 1.5,
                'racing_pipe_3_fee' => 1.5,
                'lunch_fee' => 1.5,
                'fee_total' => 1.5,
                'result_time' => 1.5,
                'result_recorded_by_email' => 'Lorem ipsum dolor sit amet',
                'result_rank' => 1,
                'result_score' => 'Lorem ipsum dolor sit amet',
                'result_note' => 'Lorem ipsum dolor sit amet',
                'visible' => 1,
                'pos' => 1,
                'created' => '2026-08-19 16:52:29',
                'modified' => '2026-08-19 16:52:29',
            ],
        ];
        parent::init();
    }
}
