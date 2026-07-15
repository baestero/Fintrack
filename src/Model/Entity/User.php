<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Entity;


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


    protected function _setUsername($value)
    {
        return trim($value);
    }

    protected function _setPassword(?string $password): ?string
    {
        if (empty($password)) {
            return null;
        }

        return (new DefaultPasswordHasher())->hash($password);
    }
}
