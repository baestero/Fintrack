<h1>Meses</h1>
<a href="/meses/add" class="button">+</a>

<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Data Referência</th>
      <th>Criado</th>
      <th>Ações</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach ($meses as $mes): ?>
    <tr>
      <td><?= h($mes->id) ?></td>

      <td>
        <?= date('m/Y', strtotime($mes->data_referencia)) ?>
      </td>

      <td><?= h($mes->created) ?></td>

      <td>
        <?= $this->Html->link(
            'Selecionar',
            ['action' => 'setAtivo', $mes->id],
            ['class' => 'button']
          ) ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>