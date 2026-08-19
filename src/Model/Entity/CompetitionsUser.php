<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CompetitionsUser Entity
 *
 * @property int $id
 * @property string $user_id
 * @property string $competition_id
 * @property int|null $subclub_id
 * @property string $status
 * @property int|null $lunch_for_the_attendant
 * @property int $companion_count
 * @property string|null $special_lunch
 * @property int|null $racing_pipe_1_qty
 * @property int|null $racing_pipe_2_qty
 * @property int|null $racing_pipe_3_qty
 * @property string|null $comment
 * @property \Cake\I18n\DateTime|null $fee_paid_at
 * @property string|null $fee_paid_by
 * @property string $entry_fee_amount
 * @property string $racing_pipe_1_fee
 * @property string $racing_pipe_2_fee
 * @property string $racing_pipe_3_fee
 * @property string $lunch_fee
 * @property string $fee_total
 * @property string|null $result_time
 * @property string|null $result_recorded_by_email
 * @property int|null $result_rank
 * @property string|null $result_score
 * @property string|null $result_note
 * @property bool $visible
 * @property int $pos
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Competition $competition
 * @property \App\Model\Entity\Subclub $subclub
 */
class CompetitionsUser extends Entity
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
        'subclub_id' => true,
        'status' => true,
        'lunch_for_the_attendant' => true,
        'companion_count' => true,
        'special_lunch' => true,
        'racing_pipe_1_qty' => true,
        'racing_pipe_2_qty' => true,
        'racing_pipe_3_qty' => true,
        'comment' => true,
        'fee_paid_at' => true,
        'fee_paid_by' => true,
        'entry_fee_amount' => true,
        'racing_pipe_1_fee' => true,
        'racing_pipe_2_fee' => true,
        'racing_pipe_3_fee' => true,
        'lunch_fee' => true,
        'fee_total' => true,
        'result_time' => true,
        'result_recorded_by_email' => true,
        'result_rank' => true,
        'result_score' => true,
        'result_note' => true,
        'visible' => true,
        'pos' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'competition' => true,
        'subclub' => true,
    ];
}
