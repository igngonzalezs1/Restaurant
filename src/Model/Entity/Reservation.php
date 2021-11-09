<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Reservation Entity
 *
 * @property int $ID
 * @property \Cake\I18n\FrozenTime $CREATED
 * @property \Cake\I18n\FrozenTime $MODIFICATE
 * @property int $USER_ID
 * @property int $TABLE_ID
 * @property int $STATUS_ID
 *
 * @property \App\Model\Entity\ReservationStatus $reservation_status
 */
class Reservation extends Entity
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
        'CREATED' => true,
        'MODIFICATE' => true,
        'USER_ID' => true,
        'TABLE_ID' => true,
        'STATUS_ID' => true,
        'reservation_status' => true,
    ];
}
