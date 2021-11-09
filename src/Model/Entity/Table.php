<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Table Entity
 *
 * @property int $ID
 * @property int $PERSON_QUANTITY
 * @property string $NAME
 * @property string $DESCRIPTION
 * @property int $TABLE_STATUS_ID
 */
class Table extends Entity
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
        'PERSON_QUANTITY' => true,
        'NAME' => true,
        'DESCRIPTION' => true,
        'TABLE_STATUS_ID' => true,
    ];
}
