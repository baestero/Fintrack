<?= $this->Form->create(null, [
  'url' => ['controller' => 'Meses', 'action' => 'setAtivo']
]) ?>

<h3>
  Mês ativo:
  <?= $mes ? h($mes->data_referencia) : 'Nenhum mês selecionado' ?>
</h3>

<?= $this->Form->control('mes_id', [
  'type' => 'select',
  'options' => $meses,
  'value' => $mes ? $mes->id : null,
  'label' => '',
  'empty' => 'Nenhum mês selecionado — crie um mês para começar',
  'onchange' => 'this.form.submit()'
]) ?>

<?= $this->Form->end() ?>


<div style="display:flex; gap:30px;">
  <div>
    <h3>Receber</h3>
    <p>R$ <?= number_format($receber, 2, ',', '.') ?></p>
  </div>

  <div>
    <h3>Pagar</h3>
    <p>R$ <?= number_format($pagar, 2, ',', '.') ?></p>
  </div>

  <div>
    <h3>🟢 Saldo</h3>
    <p><strong>R$ <?= number_format($saldo, 2, ',', '.') ?></strong></p>
  </div>
</div>

<hr>


<h3>Lançamentos do mês</h3>

<p>
  <a href="<?= $this->Url->build(['controller' => 'Lancamentos', 'action' => 'add']) ?>">
    ➕ Novo lançamento
  </a>
</p>

<hr>

<h4>💸 A Pagar</h4>

<table border="1" cellpadding="8">
  <tr>
    <th>Descrição</th>
    <th>Valor</th>
    <th>Status</th>
    <th>Ações</th>
  </tr>

  <?php foreach ($lancamentosPagar as $l): ?>
    <tr>
      <td><?= h($l->descricao) ?></td>
      <td>R$ <?= number_format($l->valor, 2, ',', '.') ?></td>
      <td><?= h($l->status) ?></td>
      <td>
        <?php if ($l->status !== 'concluido'): ?>
          <a href="<?= $this->Url->build(['controller' => 'Lancamentos', 'action' => 'concluir', $l->id]) ?>">
            ✔ Pagar
          </a>
        <?php else: ?>
          <a href="<?= $this->Url->build(['controller' => 'Lancamentos', 'action' => 'reabrir', $l->id]) ?>">
            ↩ Reabrir
          </a>
        <?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<hr>

<h4>💰 A Receber</h4>

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
      <td><?= h($l->status) ?></td>
      <td>
        <?php if ($l->status !== 'concluido'): ?>
          <a href="<?= $this->Url->build(['controller' => 'Lancamentos', 'action' => 'concluir', $l->id]) ?>">
            ✔ Receber
          </a>
        <?php else: ?>
          <a href="<?= $this->Url->build(['controller' => 'Lancamentos', 'action' => 'reabrir', $l->id]) ?>">
            ↩ Reabrir
          </a>
        <?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>
</table>