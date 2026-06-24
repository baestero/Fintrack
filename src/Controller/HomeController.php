<?php

declare(strict_types=1);

namespace App\Controller;

class HomeController extends AppController
{
    public function index()
    {
        $lancamentosTable = $this->fetchTable('Lancamentos');
        $mesesTable = $this->fetchTable('Meses');

        $this->viewBuilder()->setLayout('home');

        $userId = $this->request->getAttribute('identity')->get('id');

        $meses = $mesesTable->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return ucfirst(
                    $row->data_referencia->i18nFormat('MMMM / yyyy')
                );
            }
        ])
            ->where(['user_id' => $userId])
            ->toArray();

        $session = $this->request->getSession();
        $mesId = $session->read('Mes.ativo');

        $mes = null;
        $receber = 0;
        $pagar = 0;
        $saldo = 0;
        $lancamentosReceber = [];
        $lancamentosPagar = [];

        if ($mesId) {
            $mes = $mesesTable->find()
                ->where(['id' => $mesId, 'user_id' => $userId])
                ->first();

            if (!$mes) {
                $session->delete('Mes.ativo');
                $mesId = null;
            }
        }

        if (!$mes) {
            $mes = $mesesTable->find()
                ->where(['user_id' => $userId])
                ->orderDesc('id')
                ->first();

            if ($mes) {
                $mesId = $mes->id;
                $session->write('Mes.ativo', $mesId);
            }
        }

        if ($mesId && $mes) {

            $receber = $lancamentosTable->find()
                ->where([
                    'mes_id' => $mesId,
                    'tipo' => 'receber',
                    'concluido' => false
                ])
                ->all()
                ->sumOf('valor');

            $pagar = $lancamentosTable->find()
                ->where([
                    'mes_id' => $mesId,
                    'tipo' => 'pagar',
                    'concluido' => false
                ])
                ->all()
                ->sumOf('valor');

            $saldo = $receber - $pagar;

            $lancamentosReceber = $lancamentosTable->find()
                ->where([
                    'mes_id' => $mesId,
                    'tipo' => 'receber'
                ])
                ->order(['id' => 'ASC'])
                ->toArray();

            $lancamentosPagar = $lancamentosTable->find()
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
