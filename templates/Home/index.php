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


  <div>
    <h4>A Pagar</h4>

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


  </div>


  <div>
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
  </div>


</div>