<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Event Entity
 *
 * @property int $id
 * @property string $title
 * @property \Cake\I18n\FrozenTime $start_event
 * @property \Cake\I18n\FrozenTime $end_event
 * @property string $description
 * @property string $status
 */
class Event extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'title' => true,
        'start_event' => true,
        'end_event' => true,
        'description' => true,
        'status' => true,
    ];
}
