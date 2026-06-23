<?php

declare(strict_types=1);

namespace App\Controller;

class HomeController extends AppController
{
    public function index()
    {
        $this->loadModel('Lancamentos');
        $this->loadModel('Meses');

        // Lista de meses (select)
        $meses = $this->Meses->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return ucfirst(
                    $row->data_referencia->i18nFormat('MMMM / yyyy')
                );
            }
        ])->toArray();

        $session = $this->request->getSession();
        $mesId = $session->read('Mes.ativo');

        $mes = null;
        $receber = 0;
        $pagar = 0;
        $saldo = 0;
        $lancamentosReceber = [];
        $lancamentosPagar = [];

        // 🔥 VALIDA SE O MÊS EXISTE
        if ($mesId) {
            $mes = $this->Meses->find()
                ->where(['id' => $mesId])
                ->first();

            // se não existir mais (foi deletado)
            if (!$mes) {
                $session->delete('Mes.ativo');
                $mesId = null;
            }
        }

        // 🔥 SE NÃO TEM MÊS VÁLIDO, PEGA O MAIS RECENTE
        if (!$mes) {
            $mes = $this->Meses->find()
                ->orderDesc('id')
                ->first();

            if ($mes) {
                $mesId = $mes->id;
                $session->write('Mes.ativo', $mesId);
            }
        }


        if ($mesId && $mes) {

            $receber = $this->Lancamentos->find()
                ->where(['mes_id' => $mesId, 'tipo' => 'receber'])
                ->sumOf('valor');

            $pagar = $this->Lancamentos->find()
                ->where(['mes_id' => $mesId, 'tipo' => 'pagar'])
                ->sumOf('valor');

            $saldo = $receber - $pagar;

            $lancamentosReceber = $this->Lancamentos->find()
                ->where([
                    'mes_id' => $mesId,
                    'tipo' => 'receber'
                ])
                ->order(['id' => 'ASC'])
                ->toArray();

            $lancamentosPagar = $this->Lancamentos->find()
                ->where([
                    'mes_id' => $mesId,
                    'tipo' => 'pagar'
                ])
                ->order(['id' => 'ASC'])
                ->toArray();
        }

        $this->set(compact(
            'receber',
            'pagar',
            'saldo',
            'mes',
            'meses',
            'lancamentosReceber',
            'lancamentosPagar'
        ));
    }
}
