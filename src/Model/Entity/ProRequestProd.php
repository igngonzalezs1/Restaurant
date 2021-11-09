<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProRequestProd Entity
 *
 * @property int $ID
 * @property int $PROD_ID
 * @property int $QUANTITE
 * @property int|null $UNIT_ID
 * @property int|null $PRO_REQ_ID
 * @property int|null $STATUS_ID
 */
class ProRequestProd extends Entity
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
        'PROD_ID' => true,
        'QUANTITE' => true,
        'UNIT_ID' => true,
        'PRO_REQ_ID' => true,
    ];
}
