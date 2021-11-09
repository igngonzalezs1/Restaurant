<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SaleRequest Entity
 *
 * @property int $ID
 * @property int $PRICE_TOTAL
 * @property string|null $OBSERVATIONS
 * @property string|null $CANCELATIONS
 * @property \Cake\I18n\FrozenTime $CREATED
 * @property \Cake\I18n\FrozenTime $MODIFICATE
 * @property int $RESER_ID
 * @property int $RECIPE_ID
 * @property int $STATUS_ID
 * @property int|null $QUANTITY
 */
class SaleRequest extends Entity
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
        'PRICE_TOTAL' => true,
        'OBSERVATIONS' => true,
        'CANCELATIONS' => true,
        'CREATED' => true,
        'MODIFICATE' => true,
        'RESER_ID' => true,
        'RECIPE_ID' => true,
        'STATUS_ID' => true,
        'QUANTITY' => true,
    ];
}
