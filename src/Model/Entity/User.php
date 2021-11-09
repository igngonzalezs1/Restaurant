<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $ID
 * @property string $USERNAME
 * @property string $PASSWORD
 * @property string $NAME
 * @property string $RUT
 * @property string $EMAIL
 * @property int $GROUP_ID
 */
class User extends Entity
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
        'USERNAME' => true,
        'PASSWORD' => true,
        'NAME' => true,
        'RUT' => true,
        'EMAIL' => true,
        'GROUP_ID' => true,
    ];

    protected function _setPASSWORD($password)
    {
        if (strlen($password) > 0) {
          return (new DefaultPasswordHasher)->hash($password);
        }
    }
}