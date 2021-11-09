<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Group Entity
 *
 * @property int $ID
 * @property string $NAME
 */
class Group extends Entity
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
    const ADMINISTRATOR = 0;
    const CELLAR = 1;
    const CLIENT = 2;
    const RECEPTION = 3;
    const FINANCE = 4;
    protected $_accessible = [
        'NAME' => true,
    ];
}
