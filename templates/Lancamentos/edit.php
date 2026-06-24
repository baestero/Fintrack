<?= $this->Html->css('lancamentos', ['block' => true]); ?>

<h3>Editar Lançamento</h3>

<?= $this->Form->create($lancamento) ?>

<?= $this->Form->control('descricao') ?>

<?= $this->Form->control('tipo', [
  'type' => 'select',
  'options' => [
    'receber' => 'Receber',
    'pagar' => 'Pagar'
  ]
]) ?>

<?= $this->Form->control('valor') ?>


<!-- <?= $this->Form->control('recorrente') ?> -->

<br>

<button type="submit">Atualizar</button>

<?= $this->Form->end() ?>