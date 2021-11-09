<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RecipeProduct Entity
 *
 * @property int $ID
 * @property int $RECIPE_ID
 * @property int $PROD_ID
 * @property int|null $QUANTITE
 * @property int|null $UNIT_ID
 *
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\UnitsOfWeight $units_of_weight
 */
class RecipeProduct extends Entity
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
        'RECIPE_ID' => true,
        'PROD_ID' => true,
        'QUANTITE' => true,
        'UNIT_ID' => true
    ];
}
