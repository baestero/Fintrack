<?= $this->Html->css('meses', ['block' => true]); ?>

<div class="form-page">
  <div class="form-card">
    <h2>Adicionar Mês</h2>

    <?= $this->Form->create($mes) ?>

    <?= $this->Form->control('mes', [
      'type' => 'select',
      'options' => [
        1 => 'Janeiro',
        2 => 'Fevereiro',
        3 => 'Março',
        4 => 'Abril',
        5 => 'Maio',
        6 => 'Junho',
        7 => 'Julho',
        8 => 'Agosto',
        9 => 'Setembro',
        10 => 'Outubro',
        11 => 'Novembro',
        12 => 'Dezembro'
      ]
    ]) ?>

    <?= $this->Form->control('ano', [
      'type' => 'number',
      'value' => date('Y')
    ]) ?>

    <button type="submit">Criar</button>

    <?= $this->Form->end() ?>
  </div>
</div>