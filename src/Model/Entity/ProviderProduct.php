<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProviderProduct Entity
 *
 * @property int $ID
 * @property int $QUANTITE
 * @property string $ACTIVE
 * @property int $PRICE
 * @property int $PROVIDER_ID
 * @property int $PRODUCT_ID
 * @property int $UNIT_ID
 *
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\Provider $provider
 * @property \App\Model\Entity\UnitsOfWeight $units_of_weight
 */
class ProviderProduct extends Entity
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
        'QUANTITE' => true,
        'ACTIVE' => true,
        'PRICE' => true,
        'PROVIDER_ID' => true,
        'PRODUCT_ID' => true,
        'UNIT_ID' => true
    ];
}
