 <?= $this->Html->css('home', ['block' => true]); ?>

 <div class="home-buttons">

   <div class="mes-select">


     <?= $this->Html->image('calendar.svg') ?>

     <?= $this->Form->create(null, [
        'url' => ['controller' => 'Meses', 'action' => 'setAtivo']
      ]) ?>
     <?= $this->Form->control('mes_id', [
        'type' => 'select',
        'options' => $meses,
        'value' => $mes ? $mes->id : null,
        'label' => '',
        'empty' => 'Nenhum mês selecionado — crie um mês para começar',
        'onchange' => 'this.form.submit()'
      ]) ?>
     <?= $this->Form->end() ?>


   </div>

   <div class="home-button-nav">
     <div>
       <a href="<?= $this->Url->build(['controller' => 'Lancamentos', 'action' => 'add']) ?>">
         Novo lançamento
       </a>
     </div>

     <div>
       <a href="<?= $this->Url->build(['controller' => 'Meses', 'action' => 'index']) ?>">
         Gerenciar Meses
       </a>
     </div>
   </div>
 </div>


 <div class="status-financas-container">
   <div class="status-financas">
     <div>
       <?= $this->Html->image('arrow.svg') ?>
     </div>
     <div>
       <h4>A Receber</h4>
       <p>R$ <?= number_format($receber, 2, ',', '.') ?></p>
     </div>
   </div>

   <div class="status-financas">
     <div>
       <?= $this->Html->image('upload.svg') ?>
     </div>
     <div>
       <h4>A Pagar</h4>
       <p>R$ <?= number_format($pagar, 2, ',', '.') ?></p>
     </div>

   </div>

   <div class="status-financas">
     <div>
       <?= $this->Html->image('wallet.svg') ?>
     </div>
     <div>
       <h4>Saldo</h4>
       <p><strong>R$ <?= number_format($saldo, 2, ',', '.') ?></strong></p>
     </div>
   </div>
 </div>

 <hr>

 <h3 class="title-h3">Lançamentos do mês</h3>

 <div class="lancamentos-mes-container">


   <div>
     <h4>A Pagar</h4>

     <?php foreach ($lancamentosPagar as $l): ?>

       <p><?= h($l->descricao) ?></p>

       <p>R$ <?= number_format($l->valor, 2, ',', '.') ?></p>

       <p><?= h($l->concluido ? 'Pago' : 'Pendente') ?></p>


       <?php if (!$l->concluido): ?>
         <a href="<?= $this->Url->build(['controller' => 'Lancamentos', 'action' => 'concluir', $l->id]) ?>">
           💰 Pagar
         </a>
       <?php else: ?>
         <a href="<?= $this->Url->build(['controller' => 'Lancamentos', 'action' => 'reabrir', $l->id]) ?>">
           ↩️ Reabrir
         </a>
       <?php endif; ?>

       <a href="<?= $this->Url->build(['controller' => 'Lancamentos', 'action' => 'edit', $l->id]) ?>">
         🔧 Editar
       </a>

       <?= $this->Form->postLink(
          '🗑 Apagar',
          ['controller' => 'Lancamentos', 'action' => 'delete', $l->id],
          [
            'confirm' => 'Tem certeza?',
            'class' => 'btn-delete'
          ]
        ) ?>

     <?php endforeach; ?>
   </div>
 </div>


 <div class="lancamento">
   <h4>A Receber</h4>

   <table border="1" cellpadding="8">
     <tr>
       <th>Descrição</th>
       <th>Valor</th>
       <th>Status</th>
       <th>Ações</th>
     </tr>

     <?php foreach ($lancamentosReceber as $l): ?>
       <tr>
         <td><?= h($l->descricao) ?></td>
         <td>R$ <?= number_format($l->valor, 2, ',', '.') ?></td>
         <td><?= h($l->concluido ? 'Pago' : 'Pendente') ?></td>
         <td>
           <?php if (!$l->concluido): ?>
             <a href="<?= $this->Url->build(['controller' => 'Lancamentos', 'action' => 'concluir', $l->id]) ?>">
               📥 Receber
             </a>
           <?php else: ?>
             <a href="<?= $this->Url->build(['controller' => 'Lancamentos', 'action' => 'reabrir', $l->id]) ?>">
               ↩️ Reabrir
             </a>
           <?php endif; ?>

           <a href="<?= $this->Url->build(['controller' => 'Lancamentos', 'action' => 'edit', $l->id]) ?>">
             🔧 Editar
           </a>
           <?= $this->Form->postLink(
              '🗑️ Apagar',
              ['controller' => 'Lancamentos', 'action' => 'delete', $l->id],
              [
                'confirm' => 'Tem certeza?',
                'class' => 'btn-delete'
              ]
            ) ?>
         </td>
       </tr>
     <?php endforeach; ?>
   </table>
 </div>


 </div>