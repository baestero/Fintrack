<?= $this->Html->css('lancamentos', ['block' => true]); ?>

<h3>Novo Lançamento</h3>

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



<?= $this->Form->control('recorrente', [
  'type' => 'checkbox'
]) ?> -->

<br>

<button type="submit">Salvar</button>

<?= $this->Form->end() ?>