<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lancamento Entity
 *
 * @property int $id
 * @property int $mes_id
 * @property string $tipo
 * @property string $descricao
 * @property bool $concluido
 * @property string $valor
 * @property string $observacao
 * @property bool $recorrente
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime|null $updated_at
 *
 * @property \App\Model\Entity\Mese $mese
 */
class Lancamento extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'mes_id' => true,
        'tipo' => true,
        'descricao' => true,
        'concluido' => true,
        'valor' => true,
        'observacao' => true,
        'recorrente' => true,
        'created_at' => true,
        'updated_at' => true,
        'mese' => true,
    ];
}
