<h2>Resumo do mês</h2>

<h2>
  Mês ativo:
  <?= $mes ? h($mes->data_referencia) : 'Nenhum mês selecionado' ?>
</h2>

<div style="display:flex; gap:30px;">
  <div>
    <h3>💵 Receber</h3>
    <p>R$ <?= number_format($receber, 2, ',', '.') ?></p>
  </div>

  <div>
    <h3>💸 Pagar</h3>
    <p>R$ <?= number_format($pagar, 2, ',', '.') ?></p>
  </div>

  <div>
    <h3>🟢 Saldo</h3>
    <p><strong>R$ <?= number_format($saldo, 2, ',', '.') ?></strong></p>
  </div>
</div>

<hr>

<h2>📋 Lançamentos do mês</h2>

<p>
  <a href="<?= $this->Url->build(['controller' => 'Lancamentos', 'action' => 'add']) ?>">
    ➕ Novo lançamento
  </a>
</p>

<table border="1" cellpadding="8">
  <tr>
    <th>Descrição</th>
    <th>Tipo</th>
    <th>Valor</th>
    <th>Status</th>
    <th>Ações</th>
  </tr>

  <?php foreach ($lancamentos as $l): ?>
  <tr>
    <td><?= h($l->descricao) ?></td>
    <td><?= h($l->tipo) ?></td>
    <td>R$ <?= number_format($l->valor, 2, ',', '.') ?></td>
    <td><?= $l->status ?></td>
    <td>
      <?php if ($l->status !== 'concluido'): ?>
      <a href="<?= $this->Url->build(['controller' => 'Lancamentos', 'action' => 'concluir', $l->id]) ?>">
        ✔ Pagar/Receber
      </a>
      <?php else: ?>
      <a href="<?= $this->Url->build(['controller' => 'Lancamentos', 'action' => 'reabrir', $l->id]) ?>">
        ↩ Reabrir
      </a>
      <?php endif; ?>

      |
      <a href="<?= $this->Url->build(['controller' => 'Lancamentos', 'action' => 'edit', $l->id]) ?>">✏ Editar</a>
      |
      <a href="<?= $this->Url->build(['controller' => 'Lancamentos', 'action' => 'delete', $l->id]) ?>">🗑</a>
    </td>
  </tr>
  <?php endforeach; ?>
</table>