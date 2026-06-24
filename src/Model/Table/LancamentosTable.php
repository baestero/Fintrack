<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lancamentos Model
 *
 * @property \App\Model\Table\MesesTable&\Cake\ORM\Association\BelongsTo $Meses
 *
 * @method \App\Model\Entity\Lancamento newEmptyEntity()
 * @method \App\Model\Entity\Lancamento newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lancamento[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lancamento get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lancamento findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lancamento patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lancamento[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lancamento|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lancamento saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lancamento[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lancamento[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lancamento[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lancamento[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LancamentosTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('lancamentos');
        $this->setDisplayField('tipo');
        $this->setPrimaryKey('id');

        $this->belongsTo('Meses', [
            'foreignKey' => 'mes_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('mes_id')
            ->notEmptyString('mes_id');

        $validator
            ->scalar('tipo')
            ->maxLength('tipo', 20)
            ->requirePresence('tipo', 'create')
            ->notEmptyString('tipo');

        $validator
            ->scalar('descricao')
            ->maxLength('descricao', 200)
            ->requirePresence('descricao', 'create')
            ->notEmptyString('descricao');

        $validator
            ->boolean('concluido')
            ->notEmptyString('concluido');

        $validator
            ->decimal('valor')
            ->requirePresence('valor', 'create')
            ->notEmptyString('valor');

        $validator
            ->boolean('recorrente')
            ->notEmptyString('recorrente');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('mes_id', 'Meses'), ['errorField' => 'mes_id']);

        return $rules;
    }
}
