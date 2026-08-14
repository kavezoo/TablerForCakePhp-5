<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Country Entity
 *
 * @property int $id
 * @property int $continent_id
 * @property string $iso2
 * @property string $name
 * @property string $endonim_name
 * @property string $locale
 * @property string $timezone
 * @property string $phone_prefix
 * @property string|null $logo
 * @property string $currency
 * @property bool $visible
 * @property int $pos
 * @property int $club_count
 * @property int $setup_count
 * @property int $user_count
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Continent $continent
 * @property \App\Model\Entity\City[] $cities
 * @property \App\Model\Entity\Club[] $clubs
 * @property \App\Model\Entity\CompetitionTextTemplate[] $competition_text_templates
 * @property \App\Model\Entity\Competition[] $competitions
 * @property \App\Model\Entity\County[] $counties
 * @property \App\Model\Entity\CountryVisibility[] $country_visibilities
 * @property \App\Model\Entity\EmailTemplate[] $email_templates
 * @property \App\Model\Entity\EventLog[] $event_logs
 * @property \App\Model\Entity\Setup[] $setups
 * @property \App\Model\Entity\User[] $users
 */
class Country extends Entity
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
        'continent_id' => true,
        'iso2' => true,
        'name' => true,
        'endonim_name' => true,
        'locale' => true,
        'timezone' => true,
        'phone_prefix' => true,
        'logo' => true,
        'currency' => true,
        'visible' => true,
        'pos' => true,
        'club_count' => true,
        'setup_count' => true,
        'user_count' => true,
        'created' => true,
        'modified' => true,
        'continent' => true,
        'cities' => true,
        'clubs' => true,
        'competition_text_templates' => true,
        'competitions' => true,
        'counties' => true,
        'country_visibilities' => true,
        'email_templates' => true,
        'event_logs' => true,
        'setups' => true,
        'users' => true,
    ];
}
