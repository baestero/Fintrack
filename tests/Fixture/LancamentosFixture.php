<?php

declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LancamentosFixture
 */
class LancamentosFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'mes_id' => 1,
                'tipo' => 'Lorem ipsum dolor ',
                'descricao' => 'Lorem ipsum dolor sit amet',
                'concluido' => 1,
                'valor' => 1.5,
                'recorrente' => 1,
                'created_at' => 1782055772,
                'updated_at' => 1782055772,
            ],
        ];
        parent::init();
    }
}
