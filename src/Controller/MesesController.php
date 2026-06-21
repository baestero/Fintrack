<?php

declare(strict_types=1);

namespace App\Controller;


class MesesController extends AppController
{

    public function index()
    {
        $this->loadModel('Meses');

        $meses = $this->Meses->find()
            ->order(['data_referencia' => 'DESC']);

        $this->set(compact('meses'));
    }
    public function add()
    {
        $mes = $this->Meses->newEmptyEntity();

        if ($this->request->is('post')) {

            $data = $this->request->getData();

            $dataReferencia = sprintf(
                '%04d-%02d-01',
                $data['ano'],
                $data['mes']
            );

            $mes = $this->Meses->patchEntity($mes, [
                'user_id' => $this->Authentication->getIdentity()->get('id'),
                'data_referencia' => $dataReferencia
            ]);

            if ($this->Meses->save($mes)) {
                $this->Flash->success('Mês criado com sucesso');
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Erro ao criar mês');
        }

        $this->set(compact('mes'));
    }


    public function setAtivo($id)
    {
        $this->request->getSession()->write('Mes.ativo', $id);

        $this->Flash->success('Mes selecionado com sucesso');

        return $this->redirect([
            'controller' => 'Home',
            'action' => 'index'
        ]);
    }


    public function duplicar($id)
    {
        $this->loadModel('Lancamentos');

        $mesAtual = $this->Meses->get($id, [
            'contain' => ['Lancamentos']
        ]);

        // cria novo mês (+1 mês)
        $novaData = (new \DateTime($mesAtual->data_referencia))
            ->modify('+1 month')
            ->format('Y-m-01');

        $novoMes = $this->Meses->newEntity([
            'user_id' => $mesAtual->user_id,
            'data_referencia' => $novaData
        ]);

        $this->Meses->save($novoMes);

        // copia lançamentos
        foreach ($mesAtual->lancamentos as $l) {

            $novoLancamento = $this->Lancamentos->newEntity([
                'mes_id' => $novoMes->id,
                'tipo' => $l->tipo,
                'descricao' => $l->descricao,
                'valor' => $l->valor,
                'observacao' => $l->observacao,
                'recorrente' => $l->recorrente,
                'status' => 'pendente'
            ]);

            $this->Lancamentos->save($novoLancamento);
        }

        $this->Flash->success('Mês duplicado com sucesso');

        return $this->redirect(['action' => 'index']);
    }

    public function view($id)
    {
        $mes = $this->Meses->get($id, [
            'contain' => ['Lancamentos']
        ]);

        $this->set(compact('mes'));
    }
}