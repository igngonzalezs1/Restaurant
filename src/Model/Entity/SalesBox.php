<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SalesBox Entity
 *
 * @property int $ID
 * @property int $TOTAL_PRICE
 * @property string $COMMENTARY
 * @property string $ENTRY
 * @property int|null $RESERVATION_ID
 * @property \Cake\I18n\FrozenTime|null $CREATED
 */
class SalesBox extends Entity
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
        'TOTAL_PRICE' => true,
        'COMMENTARY' => true,
        'ENTRY' => true,
        'RESERVATION_ID' => true,
        'CREATED' => true,
    ];
}
