<h1>📅 Meus Meses</h1>

<p>
  <a href="<?= $this->Url->build(['action' => 'add']) ?>">➕ Criar mês</a>
</p>

<table border="1" cellpadding="8">
  <tr>
    <th>Mês</th>
    <th>Data referência</th>
    <th>Ações</th>
  </tr>

  <?php foreach ($meses as $m): ?>
  <tr>
    <td><?= date('F / Y', strtotime($m->data_referencia)) ?></td>

    <td><?= $m->data_referencia ?></td>

    <td>
      <a href="<?= $this->Url->build(['action' => 'setAtivo', $m->id]) ?>">
        ✔ Ativar
      </a>

      |

      <a href="<?= $this->Url->build(['action' => 'duplicar', $m->id]) ?>">
        📋 Duplicar
      </a>
    </td>
  </tr>
  <?php endforeach; ?>
</table>