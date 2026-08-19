<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Subclub Entity
 *
 * @property int $id
 * @property int $club_id
 * @property string $competition_id
 * @property string $name
 * @property bool $visible
 * @property int $pos
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Club $club
 * @property \App\Model\Entity\Competition $competition
 * @property \App\Model\Entity\CompetitionsUser[] $competitions_users
 */
class Subclub extends Entity
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
        'club_id' => true,
        'competition_id' => true,
        'name' => true,
        'visible' => true,
        'pos' => true,
        'created' => true,
        'modified' => true,
        'club' => true,
        'competition' => true,
        'competitions_users' => true,
    ];
}
