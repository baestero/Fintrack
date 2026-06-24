<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class Lancamento extends AbstractMigration
{

    public function change(): void
    {

        $table = $this->table('lancamentos');

        $table->addColumn('mes_id', 'integer', [
            'null' => false
        ]);
        $table->addColumn('tipo', 'string', [
            'null' => false,
            'limit' => 20
        ]);
        $table->addColumn('descricao', 'string', [
            'null' => false,
            'limit' => 200
        ]);

        $table->addColumn('concluido', 'boolean', [
            'default' => false
        ]);

        $table->addColumn('valor', 'decimal', [
            'precision' => 10,
            'scale' => 2,
            'null' => false

        ]);

        $table->addColumn('recorrente', 'boolean', [
            'default' => false
        ]);

        $table->addForeignKey('mes_id', 'meses', 'id');
        $table->addTimestamps();
        $table->create();
    }
}
