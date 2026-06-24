<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class User extends AbstractMigration
{

    public function change(): void
    {
        $table = $this->table('users');

        $table->addColumn('username', 'string', [
            'null' => false,
            'limit' => 100
        ]);
        $table->addColumn('password', 'string', [
            'null' => false,
            'limit' => 255
        ]);

        $table->addIndex('username', ['unique' => true]);
        $table->addTimestamps();
        $table->create();
    }
}
