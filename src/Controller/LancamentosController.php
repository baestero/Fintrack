<?php

declare(strict_types=1);

namespace App\Controller;

class LancamentosController extends AppController
{
    public function index()
    {
        $lancamentosTable = $this->fetchTable('Lancamentos');

        $mesId = $this->request->getSession()->read('Mes.ativo');

        $lancamentos = $lancamentosTable->find()
            ->where(['mes_id' => $mesId])
            ->order(['id' => 'ASC']);

        $this->set(compact('lancamentos'));
    }

    public function add()
    {
        $lancamentosTable = $this->fetchTable('Lancamentos');

        $lancamento = $lancamentosTable->newEmptyEntity();

        if ($this->request->is('post')) {

            $data = $this->request->getData();

            $mesAtivo = $this->request->getSession()->read('Mes.ativo');

            if (!$mesAtivo) {
                $this->Flash->error('Selecione um mês antes de criar lançamentos');

                return $this->redirect([
                    'controller' => 'Meses',
                    'action' => 'index'
                ]);
            }

            $data['mes_id'] = $mesAtivo;
            $data['recorrente'] = !empty($data['recorrente']) ? 1 : 0;
            $data['valor'] = (float)$data['valor'];
            $data['concluido'] = false;

            $lancamento = $lancamentosTable->patchEntity(
                $lancamento,
                $data
            );


            if ($lancamentosTable->save($lancamento)) {


                $this->Flash->success('Lançamento criado');

                return $this->redirect([
                    'controller' => 'Home'
                ]);
            }

            $this->Flash->error('Erro ao salvar');
        }

        $this->set(compact('lancamento'));
    }

    public function edit($id)
    {
        $lancamentosTable = $this->fetchTable('Lancamentos');

        $lancamento = $lancamentosTable->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $lancamento = $lancamentosTable->patchEntity(
                $lancamento,
                $this->request->getData()
            );

            if ($lancamentosTable->save($lancamento)) {
                $this->Flash->success('Lançamento atualizado');

                return $this->redirect([
                    'controller' => 'Home'
                ]);
            }

            $this->Flash->error('Erro ao atualizar');
        }

        $this->set(compact('lancamento'));
    }

    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);

        $lancamentosTable = $this->fetchTable('Lancamentos');

        $lancamento = $lancamentosTable->get($id);

        if ($lancamentosTable->delete($lancamento)) {
            $this->Flash->success('Lançamento removido');
        } else {
            $this->Flash->error('Erro ao remover');
        }

        return $this->redirect([
            'controller' => 'Home'
        ]);
    }

    public function concluir($id)
    {
        $lancamentosTable = $this->fetchTable('Lancamentos');

        $lancamento = $lancamentosTable->get($id);

        $lancamento->concluido = true;
        $lancamento->data_pagamento = date('Y-m-d');

        $lancamentosTable->save($lancamento);

        return $this->redirect([
            'controller' => 'Home'
        ]);
    }

    public function reabrir($id)
    {
        $lancamentosTable = $this->fetchTable('Lancamentos');

        $lancamento = $lancamentosTable->get($id);

        $lancamento->concluido = false;
        $lancamento->data_pagamento = null;

        $lancamentosTable->save($lancamento);

        return $this->redirect([
            'controller' => 'Home'
        ]);
    }
}
