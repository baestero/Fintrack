<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MesesFixture
 */
class MesesFixture extends TestFixture
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
                'user_id' => 1,
                'data_referencia' => '2026-06-21',
                'created_at' => 1782055767,
                'updated_at' => 1782055767,
            ],
        ];
        parent::init();
    }
}
