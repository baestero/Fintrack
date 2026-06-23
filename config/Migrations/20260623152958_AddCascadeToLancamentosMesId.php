<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class AddCascadeToLancamentosMesId extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('lancamentos');


        $table->dropForeignKey('mes_id');


        $table->addForeignKey(
            'mes_id',
            'meses',
            'id',
            [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ]
        );

        $table->update();
    }
}
