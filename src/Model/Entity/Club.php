<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Club Entity
 *
 * @property int $id
 * @property int $city_id
 * @property string $clubpresident_id
 * @property string $name
 * @property string $short_name
 * @property string|null $logo
 * @property string $email
 * @property bool $enabled
 * @property string $address
 * @property string $phone
 * @property string $web
 * @property string $facebook
 * @property string $insta
 * @property int $user_count
 * @property int $competition_count
 * @property string|null $club_president_id
 * @property \Cake\I18n\Date|null $national_membership_fee_date
 * @property bool $visible
 * @property int $pos
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\Subclub[] $subclubs
 * @property \App\Model\Entity\User[] $users
 */
class Club extends Entity
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
        'city_id' => true,
        'clubpresident_id' => true,
        'name' => true,
        'short_name' => true,
        'logo' => true,
        'email' => true,
        'enabled' => true,
        'address' => true,
        'phone' => true,
        'web' => true,
        'facebook' => true,
        'insta' => true,
        'user_count' => true,
        'competition_count' => true,
        'club_president_id' => true,
        'national_membership_fee_date' => true,
        'visible' => true,
        'pos' => true,
        'created' => true,
        'modified' => true,
        'city' => true,
        'subclubs' => true,
        'users' => true,
    ];
}
