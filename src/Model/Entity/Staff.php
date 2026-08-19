<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Staff Entity
 *
 * @property int $id
 * @property string $user_id
 * @property string $competition_id
 * @property string $role
 * @property bool $visible
 * @property int $pos
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Competition $competition
 */
class Staff extends Entity
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
        'user_id' => true,
        'competition_id' => true,
        'role' => true,
        'visible' => true,
        'pos' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'competition' => true,
    ];
}
