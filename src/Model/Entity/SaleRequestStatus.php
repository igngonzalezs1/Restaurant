<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SaleRequestStatus Entity
 *
 * @property int $ID
 * @property string $CODE
 * @property string $NAME
 */
class SaleRequestStatus extends Entity
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
    const PR = 0; //Pedido REcibido
    const EP = 1; //En Preparacion
    const PP = 2; //Preparado
    const EC = 3; //En Camino
    const ET = 4; //Entregado
    const CL = 5; //Cancelado

    protected $_accessible = [
        'CODE' => true,
        'NAME' => true,
    ];
}
