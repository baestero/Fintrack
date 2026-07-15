<?php

declare(strict_types=1);

namespace App\Controller;

class MesesController extends AppController
{
    public function index()
    {
        $mesesTable = $this->fetchTable('Meses');

        $userId = $this->request->getAttribute('identity')->get('id');

        $meses = $mesesTable->find()
            ->where(['user_id' => $userId])
            ->order(['data_referencia' => 'DESC']);

        $mesesNavbar = $mesesTable->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return ucfirst(
                    $row->data_referencia->i18nFormat('MMMM / yyyy')
                );
            }
        ])
            ->where(['user_id' => $userId])
            ->toArray();

        $mesAtivoId = $this->request->getSession()->read('Mes.ativo');

        $this->set(compact('meses', 'mesesNavbar', 'mesAtivoId'));
    }

    public function add()
    {
        $mesesTable = $this->fetchTable('Meses');

        $mes = $mesesTable->newEmptyEntity();

        if ($this->request->is('post')) {

            $data = $this->request->getData();

            $dataReferencia = sprintf(
                '%04d-%02d-01',
                $data['ano'],
                $data['mes']
            );

            $mes = $mesesTable->patchEntity($mes, [
                'user_id' => $this->Authentication->getIdentity()->get('id'),
                'data_referencia' => $dataReferencia
            ]);

            if ($mesesTable->save($mes)) {
                $this->Flash->success('Mês criado com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            $erroReferencia = $mes->getError('data_referencia');

            if (!empty($erroReferencia)) {
                $this->Flash->error(reset($erroReferencia));
            } else {
                $this->Flash->error('Erro ao criar mês');
            }
        }

        $this->set(compact('mes'));
    }


    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $mesesTable = $this->fetchTable('Meses');

        $userId = $this->request->getAttribute('identity')->get('id');

        // ❌ era: $mesesTable->get($id) — qualquer usuário podia deletar qualquer mês
        $mes = $mesesTable->find()
            ->where(['id' => $id, 'user_id' => $userId])
            ->firstOrFail();

        if ($mesesTable->delete($mes)) {
            $this->Flash->success('Mês removido com sucesso.');
        } else {
            $this->Flash->error('Não foi possível remover o mês.');
        }

        return $this->redirect(['action' => 'index']);
    }

    public function setAtivo()
    {

        $mesId = $this->request->getData('mes_id');




        $mesesTable = $this->fetchTable('Meses');


        $userId = $this->request->getAttribute('identity')->get('id');


        $mes = $mesesTable->find()
            ->where(['id' => $mesId, 'user_id' => $userId])
            ->first();

        if (!$mes) {
            $this->Flash->error('Mês não encontrado.');
            return $this->redirect(['action' => 'index']);
        }

        $this->request->getSession()->write('Mes.ativo', $mesId);

        return $this->redirect([
            'controller' => 'Home',
            'action' => 'index'
        ]);
    }

    public function duplicar($id)
    {
        $mesesTable = $this->fetchTable('Meses');
        $lancamentosTable = $this->fetchTable('Lancamentos');

        $userId = $this->request->getAttribute('identity')->get('id');

        $mesAtual = $mesesTable->find()
            ->where(['id' => $id, 'user_id' => $userId])
            ->contain(['Lancamentos'])
            ->firstOrFail();

        $novaData = (new \DateTime($mesAtual->data_referencia->format('Y-m-d')))
            ->modify('+1 month')
            ->format('Y-m-01');

        $novoMes = $mesesTable->newEntity([
            'user_id' => $userId,
            'data_referencia' => $novaData
        ]);

        if (!$mesesTable->save($novoMes)) {
            $this->Flash->error('Erro ao criar o novo mês');
            return $this->redirect(['action' => 'index']);
        }

        foreach ($mesAtual->lancamentos as $l) {
            $novoLancamento = $lancamentosTable->newEntity([
                'mes_id' => $novoMes->id,
                'tipo' => $l->tipo,
                'descricao' => $l->descricao,
                'valor' => $l->valor,
                'recorrente' => $l->recorrente,
                'concluido' => false,
                'data_pagamento' => null
            ]);

            $lancamentosTable->save($novoLancamento);
        }

        $this->Flash->success('Mês duplicado com sucesso');

        return $this->redirect(['action' => 'index']);
    }

    public function view($id)
    {
        $mesesTable = $this->fetchTable('Meses');

        $userId = $this->request->getAttribute('identity')->get('id');

        $mes = $mesesTable->find()
            ->where(['id' => $id, 'user_id' => $userId])
            ->contain(['Lancamentos'])
            ->firstOrFail();

        $this->set(compact('mes'));
    }
}
