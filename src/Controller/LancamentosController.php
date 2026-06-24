<?php

declare(strict_types=1);

namespace App\Controller;

class LancamentosController extends AppController
{
    private function getLancamentoDoUsuario($id)
    {
        $lancamentosTable = $this->fetchTable('Lancamentos');
        $mesesTable = $this->fetchTable('Meses');

        $userId = $this->request->getAttribute('identity')->get('id');

        $lancamento = $lancamentosTable->get($id);

        $mes = $mesesTable->find()
            ->where(['id' => $lancamento->mes_id, 'user_id' => $userId])
            ->firstOrFail();

        return $lancamento;
    }

    public function index()
    {
        $lancamentosTable = $this->fetchTable('Lancamentos');
        $mesesTable = $this->fetchTable('Meses');

        $userId = $this->request->getAttribute('identity')->get('id');
        $mesId = $this->request->getSession()->read('Mes.ativo');

        $mes = $mesesTable->find()
            ->where(['id' => $mesId, 'user_id' => $userId])
            ->first();

        if (!$mes) {
            $this->Flash->error('Mês inválido');
            return $this->redirect(['controller' => 'Meses', 'action' => 'index']);
        }

        $lancamentos = $lancamentosTable->find()
            ->where(['mes_id' => $mesId])
            ->order(['id' => 'ASC']);

        $this->set(compact('lancamentos'));
    }

    public function add()
    {
        $lancamentosTable = $this->fetchTable('Lancamentos');
        $mesesTable = $this->fetchTable('Meses');

        $lancamento = $lancamentosTable->newEmptyEntity();

        if ($this->request->is('post')) {

            $data = $this->request->getData();
            $mesAtivo = $this->request->getSession()->read('Mes.ativo');

            if (!$mesAtivo) {
                $this->Flash->error('Selecione um mês antes de criar lançamentos');
                return $this->redirect(['controller' => 'Meses', 'action' => 'index']);
            }

            $userId = $this->request->getAttribute('identity')->get('id');

            $mes = $mesesTable->find()
                ->where(['id' => $mesAtivo, 'user_id' => $userId])
                ->first();

            if (!$mes) {
                $this->Flash->error('Mês inválido');
                return $this->redirect(['controller' => 'Meses', 'action' => 'index']);
            }

            $data['mes_id'] = $mesAtivo;
            $data['recorrente'] = !empty($data['recorrente']) ? 1 : 0;
            $data['valor'] = (float)$data['valor'];
            $data['concluido'] = false;

            $lancamento = $lancamentosTable->patchEntity($lancamento, $data);

            if ($lancamentosTable->save($lancamento)) {
                $this->Flash->success('Lançamento criado');
                return $this->redirect(['controller' => 'Home']);
            }

            $this->Flash->error('Erro ao salvar');
        }

        $this->set(compact('lancamento'));
    }

    public function edit($id)
    {
        $lancamento = $this->getLancamentoDoUsuario($id);
        $lancamentosTable = $this->fetchTable('Lancamentos');

        if ($this->request->is(['patch', 'post', 'put'])) {

            $lancamento = $lancamentosTable->patchEntity(
                $lancamento,
                $this->request->getData()
            );

            if ($lancamentosTable->save($lancamento)) {
                $this->Flash->success('Lançamento atualizado');
                return $this->redirect(['controller' => 'Home']);
            }

            $this->Flash->error('Erro ao atualizar');
        }

        $this->set(compact('lancamento'));
    }

    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);

        $lancamento = $this->getLancamentoDoUsuario($id);
        $lancamentosTable = $this->fetchTable('Lancamentos');

        if ($lancamentosTable->delete($lancamento)) {
            $this->Flash->success('Lançamento removido');
        } else {
            $this->Flash->error('Erro ao remover');
        }

        return $this->redirect(['controller' => 'Home']);
    }

    public function concluir($id)
    {
        $lancamento = $this->getLancamentoDoUsuario($id);
        $lancamentosTable = $this->fetchTable('Lancamentos');

        $lancamento->concluido = true;
        $lancamento->data_pagamento = date('Y-m-d');

        $lancamentosTable->save($lancamento);

        return $this->redirect(['controller' => 'Home']);
    }

    public function reabrir($id)
    {
        $lancamento = $this->getLancamentoDoUsuario($id);
        $lancamentosTable = $this->fetchTable('Lancamentos');

        $lancamento->concluido = false;
        $lancamento->data_pagamento = null;

        $lancamentosTable->save($lancamento);

        return $this->redirect(['controller' => 'Home']);
    }
}
