<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class Removeobs extends AbstractMigration
{

    public function change()
    {
        $table = $this->table('lancamentos');

        $table->removeColumn('observacao')
            ->update();
    }
}
