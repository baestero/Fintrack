<?= $this->Html->css('lancamentos', ['block' => true]); ?>

<div class="form-page">
  <div class="form-card">
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

    <button type="submit">Salvar</button>

    <?= $this->Form->end() ?>
  </div>
</div>