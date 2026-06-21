<?php

declare(strict_types=1);

namespace App\Controller;


class HomeController extends AppController
{

    public function index()
    {
        $this->loadModel('Lancamentos');
        $this->loadModel('Meses');

        $mesId = $this->request->getSession()->read('Mes.ativo');

        $mes = null;
        $receber = 0;
        $pagar = 0;
        $saldo = 0;
        $lancamentos = [];

        if ($mesId) {
            $mes = $this->Meses->get($mesId);

            $receber = $this->Lancamentos->find()
                ->where(['mes_id' => $mesId, 'tipo' => 'receber'])
                ->sumOf('valor');

            $pagar = $this->Lancamentos->find()
                ->where(['mes_id' => $mesId, 'tipo' => 'pagar'])
                ->sumOf('valor');

            $saldo = $receber - $pagar;

            $lancamentos = $this->Lancamentos->find()
                ->where(['mes_id' => $mesId])
                ->order(['id' => 'ASC'])
                ->toArray();
        }

        $this->set(compact(
            'receber',
            'pagar',
            'saldo',
            'lancamentos',
            'mes'
        ));
    }
}