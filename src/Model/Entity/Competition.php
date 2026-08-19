<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Competition Entity
 *
 * @property string $id
 * @property int $organizing_club_id
 * @property int $city_id
 * @property string $venue_name
 * @property string $venue_address
 * @property string $google_maps_url
 * @property int|null $competition_text_template_id
 * @property string|null $modified_by
 * @property bool $national_competition
 * @property string $name
 * @property string $title
 * @property string $subtitle
 * @property string $subtitle2
 * @property \Cake\I18n\Date $first_date_of_application
 * @property \Cake\I18n\Date $application_deadline
 * @property \Cake\I18n\DateTime $competition_datetime
 * @property \Cake\I18n\DateTime|null $start_datetime
 * @property \Cake\I18n\DateTime|null $end_datetime
 * @property string $description
 * @property int $minimum_team_size
 * @property int $lunch_for_the_attendant
 * @property string $racing_pipe_1_title
 * @property string $racing_pipe_2_title
 * @property string $racing_pipe_3_title
 * @property string $pipe_type
 * @property string $pipe_parameters
 * @property string $tobacco_type
 * @property string $tobacco_weight
 * @property string $currency
 * @property string $entry_fee_member
 * @property string $entry_fee_non_member
 * @property string $lunch_description
 * @property string $lunch_price
 * @property string $racing_pipe_1_price_member
 * @property string $racing_pipe_1_price_non_member
 * @property string $racing_pipe_2_price_member
 * @property string $racing_pipe_2_price_non_member
 * @property string $racing_pipe_3_price_member
 * @property string $racing_pipe_3_price_non_member
 * @property string $racing_pipe_1_image
 * @property string $racing_pipe_2_image
 * @property string $racing_pipe_3_image
 * @property int|null $user_count
 * @property int|null $national_pipe_club_member_count
 * @property int|null $attendant_count
 * @property bool $visible
 * @property int $pos
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\Staff[] $staffs
 * @property \App\Model\Entity\Subclub[] $subclubs
 * @property \App\Model\Entity\Competition[] $competitions
 */
class Competition extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'organizing_club_id' => true,
        'city_id' => true,
        'venue_name' => true,
        'venue_address' => true,
        'google_maps_url' => true,
        'competition_text_template_id' => true,
        'modified_by' => true,
        'national_competition' => true,
        'name' => true,
        'title' => true,
        'subtitle' => true,
        'subtitle2' => true,
        'first_date_of_application' => true,
        'application_deadline' => true,
        'competition_datetime' => true,
        'start_datetime' => true,
        'end_datetime' => true,
        'description' => true,
        'minimum_team_size' => true,
        'lunch_for_the_attendant' => true,
        'racing_pipe_1_title' => true,
        'racing_pipe_2_title' => true,
        'racing_pipe_3_title' => true,
        'pipe_type' => true,
        'pipe_parameters' => true,
        'tobacco_type' => true,
        'tobacco_weight' => true,
        'currency' => true,
        'entry_fee_member' => true,
        'entry_fee_non_member' => true,
        'lunch_description' => true,
        'lunch_price' => true,
        'racing_pipe_1_price_member' => true,
        'racing_pipe_1_price_non_member' => true,
        'racing_pipe_2_price_member' => true,
        'racing_pipe_2_price_non_member' => true,
        'racing_pipe_3_price_member' => true,
        'racing_pipe_3_price_non_member' => true,
        'racing_pipe_1_image' => true,
        'racing_pipe_2_image' => true,
        'racing_pipe_3_image' => true,
        'user_count' => true,
        'national_pipe_club_member_count' => true,
        'attendant_count' => true,
        'visible' => true,
        'pos' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'city' => true,
        'staffs' => true,
        'subclubs' => true,
        'competitions' => true,
    ];
}
