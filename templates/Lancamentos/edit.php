<h1>✏️ Editar Lançamento</h1>

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

<?= $this->Form->control('recorrente') ?>

<br>

<button type="submit">Atualizar</button>

<?= $this->Form->end() ?>