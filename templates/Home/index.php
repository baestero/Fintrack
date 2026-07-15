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

 <div class="lancamentos-mes">

   <h3>Lançamentos do mês</h3>


   <div class="lancamentos-grupo">
     <h4>A Pagar</h4>

     <div class="lancamentos-cards">
       <?php foreach ($lancamentosPagar as $l): ?>
         <div class="lancamento-card">
           <div class="lancamento-card-topo">
             <span class="lancamento-descricao"><?= h($l->descricao) ?></span>
             <span class="lancamento-status <?= $l->concluido ? 'status-pago' : 'status-pendente' ?>">
               <?= h($l->concluido ? 'Pago' : 'Pendente') ?>
             </span>
           </div>
           <p class="lancamento-valor">R$ <?= number_format($l->valor, 2, ',', '.') ?></p>
           <div class="lancamento-card-acoes">
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
           </div>
         </div>
       <?php endforeach; ?>
       <?php if (empty($lancamentosPagar)): ?>
         <p class="lancamentos-vazio">Nenhum lançamento a pagar neste mês.</p>
       <?php endif; ?>
     </div>
   </div>


   <div class="lancamentos-grupo">
     <h4>A Receber</h4>

     <div class="lancamentos-cards">
       <?php foreach ($lancamentosReceber as $l): ?>
         <div class="lancamento-card">
           <div class="lancamento-card-topo">
             <span class="lancamento-descricao"><?= h($l->descricao) ?></span>
             <span class="lancamento-status <?= $l->concluido ? 'status-pago' : 'status-pendente' ?>">
               <?= h($l->concluido ? 'Pago' : 'Pendente') ?>
             </span>
           </div>
           <p class="lancamento-valor">R$ <?= number_format($l->valor, 2, ',', '.') ?></p>
           <div class="lancamento-card-acoes">
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
           </div>
         </div>
       <?php endforeach; ?>
       <?php if (empty($lancamentosReceber)): ?>
         <p class="lancamentos-vazio">Nenhum lançamento a receber neste mês.</p>
       <?php endif; ?>
     </div>
   </div>


 </div>