<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime|null $updated_at
 */
class User extends Entity
{

    protected $_accessible = [
        'username' => true,
        'password' => true,
        'created_at' => true,
        'updated_at' => true,
    ];


    protected $_hidden = [
        'password',
    ];


    protected function _setPassword(?string $password): ?string
    {
        if (empty($password)) {
            return $password;
        }

        return (new DefaultPasswordHasher())->hash($password);
    }
}
