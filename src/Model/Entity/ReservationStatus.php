<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ReservationStatus Entity
 *
 * @property int $ID
 * @property string $NAME
 * @property string $CODE
 */
class ReservationStatus extends Entity
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
    const CLOSE = 0;
    const OPEN = 1;
    protected $_accessible = [
        'NAME' => true,
        'CODE' => true,
    ];
    
}
