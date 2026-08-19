<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property string $id
 * @property int $city_id
 * @property int|null $club_id
 * @property string $username
 * @property string|null $email
 * @property string $password
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $phone
 * @property string|null $avatar
 * @property string|null $token
 * @property \Cake\I18n\DateTime|null $token_expires
 * @property string|null $api_token
 * @property \Cake\I18n\DateTime|null $activation_date
 * @property string|null $secret
 * @property bool|null $secret_verified
 * @property \Cake\I18n\DateTime|null $tos_date
 * @property bool $active
 * @property bool $enabled
 * @property bool $is_superuser
 * @property string|null $role
 * @property string $membership_status
 * @property \Cake\I18n\Date|null $membership_joined_date
 * @property \Cake\I18n\Date|null $club_membership_fee_date
 * @property \Cake\I18n\Date|null $national_membership_fee_date
 * @property bool $application_notified
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 * @property string|null $additional_data
 * @property \Cake\I18n\DateTime|null $last_login
 * @property \Cake\I18n\DateTime|null $lockout_time
 * @property string|null $login_token
 * @property \Cake\I18n\DateTime|null $login_token_date
 * @property bool $token_send_requested
 *
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\Club $club
 * @property \App\Model\Entity\FailedPasswordAttempt[] $failed_password_attempts
 * @property \App\Model\Entity\SocialAccount[] $social_accounts
 * @property \App\Model\Entity\Staff[] $staffs
 * @property \App\Model\Entity\Competition[] $competitions
 */
class User extends Entity
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
        'club_id' => true,
        'username' => true,
        'email' => true,
        'password' => true,
        'first_name' => true,
        'last_name' => true,
        'phone' => true,
        'avatar' => true,
        'token' => true,
        'token_expires' => true,
        'api_token' => true,
        'activation_date' => true,
        'secret' => true,
        'secret_verified' => true,
        'tos_date' => true,
        'active' => true,
        'enabled' => true,
        'is_superuser' => true,
        'role' => true,
        'membership_status' => true,
        'membership_joined_date' => true,
        'club_membership_fee_date' => true,
        'national_membership_fee_date' => true,
        'application_notified' => true,
        'created' => true,
        'modified' => true,
        'additional_data' => true,
        'last_login' => true,
        'lockout_time' => true,
        'login_token' => true,
        'login_token_date' => true,
        'token_send_requested' => true,
        'city' => true,
        'club' => true,
        'failed_password_attempts' => true,
        'social_accounts' => true,
        'staffs' => true,
        'competitions' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected array $_hidden = [
        'password',
        'token',
    ];
	
	// Virtuális getter mező definiálása
    protected function _getFullName(): string
    {
        return trim(($this->last_name ?? '') . ' ' . ($this->first_name ?? ''));
    }	

}
