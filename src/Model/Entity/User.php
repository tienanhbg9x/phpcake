<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Table;

/**
 * User Entity
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $password
 * @property string|null $role
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class User extends Entity
{
    protected $_accessible = [
        'username' => true,
        'password' => true,
        'role' => true,
        'created' => true,
        'modified' => true,
        'id' => false,
    ];

    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }


}
