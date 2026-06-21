<h1>Novo Lançamento</h1>

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

<?= $this->Form->control('observacao') ?>

<?= $this->Form->control('recorrente', [
  'type' => 'checkbox'
]) ?>

<br>

<button type="submit">Salvar</button>

<?= $this->Form->end() ?>