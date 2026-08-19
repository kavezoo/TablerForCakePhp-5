<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CompetitionsFixture
 */
class CompetitionsFixture extends TestFixture
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
                'id' => '1249692e-0cde-4ec2-b601-0598bec3e89f',
                'organizing_club_id' => 1,
                'city_id' => 1,
                'venue_name' => 'Lorem ipsum dolor sit amet',
                'venue_address' => 'Lorem ipsum dolor sit amet',
                'google_maps_url' => 'Lorem ipsum dolor sit amet',
                'competition_text_template_id' => 1,
                'modified_by' => 'f002be28-1ff9-4cdd-9edf-3f2e1869932a',
                'national_competition' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'title' => 'Lorem ipsum dolor sit amet',
                'subtitle' => 'Lorem ipsum dolor sit amet',
                'subtitle2' => 'Lorem ipsum dolor sit amet',
                'first_date_of_application' => '2026-08-19',
                'application_deadline' => '2026-08-19',
                'competition_datetime' => '2026-08-19 12:59:19',
                'start_datetime' => '2026-08-19 12:59:19',
                'end_datetime' => '2026-08-19 12:59:19',
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'minimum_team_size' => 1,
                'lunch_for_the_attendant' => 1,
                'racing_pipe_1_title' => 'Lorem ipsum dolor sit amet',
                'racing_pipe_2_title' => 'Lorem ipsum dolor sit amet',
                'racing_pipe_3_title' => 'Lorem ipsum dolor sit amet',
                'pipe_type' => 'Lorem ipsum dolor sit amet',
                'pipe_parameters' => 'Lorem ipsum dolor sit amet',
                'tobacco_type' => 'Lorem ipsum dolor sit amet',
                'tobacco_weight' => 1.5,
                'currency' => 'L',
                'entry_fee_member' => 1.5,
                'entry_fee_non_member' => 1.5,
                'lunch_description' => 'Lorem ipsum dolor sit amet',
                'lunch_price' => 1.5,
                'racing_pipe_1_price_member' => 1.5,
                'racing_pipe_1_price_non_member' => 1.5,
                'racing_pipe_2_price_member' => 1.5,
                'racing_pipe_2_price_non_member' => 1.5,
                'racing_pipe_3_price_member' => 1.5,
                'racing_pipe_3_price_non_member' => 1.5,
                'racing_pipe_1_image' => 'Lorem ipsum dolor sit amet',
                'racing_pipe_2_image' => 'Lorem ipsum dolor sit amet',
                'racing_pipe_3_image' => 'Lorem ipsum dolor sit amet',
                'user_count' => 1,
                'national_pipe_club_member_count' => 1,
                'attendant_count' => 1,
                'visible' => 1,
                'pos' => 1,
                'created' => '2026-08-19 12:59:19',
                'modified' => '2026-08-19 12:59:19',
            ],
        ];
        parent::init();
    }
}
