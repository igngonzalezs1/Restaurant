<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Recipe Entity
 *
 * @property int $ID
 * @property string $NAME
 * @property int $PRICE
 * @property string $DESCRIPTION
 * @property int $PREPARATION_TIME
 * @property string $MOD_PREPARATION
 * @property string $IVA
 * @property string|null $IMAGE
 */
class Recipe extends Entity
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
        'NAME' => true,
        'PRICE' => true,
        'DESCRIPTION' => true,
        'PREPARATION_TIME' => true,
        'MOD_PREPARATION' => true,
        'IVA' => true,
        'IMAGE' => true,
    ];
}
