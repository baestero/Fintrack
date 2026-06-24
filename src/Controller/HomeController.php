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

        // Lista de meses (select)
        $meses = $mesesTable->find('list', [
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

        // Valida se o mês existe
        if ($mesId) {
            $mes = $mesesTable->find()
                ->where(['id' => $mesId])
                ->first();

            if (!$mes) {
                $session->delete('Mes.ativo');
                $mesId = null;
            }
        }

        // Se não tem mês válido, pega o mais recente
        if (!$mes) {
            $mes = $mesesTable->find()
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
                ->sumOf('valor');

            $pagar = $lancamentosTable->find()
                ->where([
                    'mes_id' => $mesId,
                    'tipo' => 'pagar',
                    'concluido' => false
                ])
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
