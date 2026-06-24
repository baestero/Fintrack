<?php

declare(strict_types=1);

namespace App\Controller;


class LancamentosController extends AppController
{

    public function index()
    {
        $this->loadModel('Lancamentos');

        $mesId = $this->request->getSession()->read('Mes.ativo');

        $lancamentos = $this->Lancamentos->find()
            ->where(['mes_id' => $mesId])
            ->order(['id' => 'ASC']);

        $this->set(compact('lancamentos'));
    }

    public function add()
    {
        $this->loadModel('Lancamentos');

        $lancamento = $this->Lancamentos->newEmptyEntity();

        if ($this->request->is('post')) {

            $data = $this->request->getData();

            $data['mes_id'] = $this->request->getSession()->read('Mes.ativo');
            $mesAtivo = $this->request->getSession()->read('Mes.ativo');

            if (!$mesAtivo) {
                $this->Flash->error('Selecione um mês antes de criar lançamentos');
                return $this->redirect(['controller' => 'Meses', 'action' => 'index']);
            }

            $data['mes_id'] = $mesAtivo;
            $data['recorrente'] = !empty($data['recorrente']) ? 1 : 0;
            $data['valor'] = (float) $data['valor'];
            $data['concluido'] = false;


            $lancamento = $this->Lancamentos->patchEntity($lancamento, $data);

            if ($this->Lancamentos->save($lancamento)) {
                $this->Flash->success('Lançamento criado');
                return $this->redirect(['controller' => 'Home']);
            }

            $this->Flash->error('Erro ao salvar');
            debug($lancamento->getErrors());
        }

        $this->set(compact('lancamento'));
    }

    public function edit($id)
    {
        $this->loadModel('Lancamentos');

        $lancamento = $this->Lancamentos->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $lancamento = $this->Lancamentos->patchEntity(
                $lancamento,
                $this->request->getData()
            );

            if ($this->Lancamentos->save($lancamento)) {
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

        $this->loadModel('Lancamentos');

        $lancamento = $this->Lancamentos->get($id);

        if ($this->Lancamentos->delete($lancamento)) {
            $this->Flash->success('Lançamento removido');
        } else {
            $this->Flash->error('Erro ao remover');
        }

        return $this->redirect(['controller' => 'Home']);
    }

    public function concluir($id)
    {
        $this->loadModel('Lancamentos');

        $lancamento = $this->Lancamentos->get($id);

        $lancamento->concluido = true;
        $lancamento->data_pagamento = date('Y-m-d');

        $this->Lancamentos->save($lancamento);

        return $this->redirect(['controller' => 'Home']);
    }

    public function reabrir($id)
    {
        $this->loadModel('Lancamentos');

        $lancamento = $this->Lancamentos->get($id);

        $lancamento->concluido = false;
        $lancamento->data_pagamento = null;

        $this->Lancamentos->save($lancamento);

        return $this->redirect(['controller' => 'Home']);
    }
}
