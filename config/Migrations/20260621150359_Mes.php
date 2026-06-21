<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class Mes extends AbstractMigration
{

    public function change(): void
    {

        $table = $this->table('meses');

        $table->addColumn('user_id', 'integer', [
            'null' => false
        ]);
        $table->addColumn('data_referencia', 'date', [
            'null' => false
        ]);

        $table->addIndex(['user_id', 'data_referencia'], ['unique' => true]);
        $table->addForeignKey('user_id', 'users', 'id');
        $table->addTimestamps();
        $table->create();
    }
}