<h1>Meses</h1>
<a href="/meses/add" class="button">+</a>

<table>
  <thead>
    <tr>
      <th>Data Referência</th>
      <th>Ações</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach ($meses as $mes): ?>
      <tr>

        <td>
          <?= $mes->data_referencia->i18nFormat('MM/yyyy') ?>
        </td>


        <td>
          <?= $this->Html->link(
            'Selecionar',
            ['action' => 'setAtivo', $mes->id],
            ['class' => 'button']
          ) ?>

          <?= $this->Form->postLink(
            'Deletar',
            ['action' => 'delete', $mes->id],
            [
              'confirm' => 'Tem certeza que deseja excluir este mês?',
              'class' => 'button'
            ]
          ) ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>