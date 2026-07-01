<?= $this->Html->css('meses', ['block' => true]); ?>

<div class="meses-container">
  <h2>Meses</h2>
  <a href="/meses/add" class="button">+</a>
</div>

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
        <?= $this->Form->postLink(
            'Selecionar',
            ['action' => 'setAtivo'],
            [
              'data' => ['mes_id' => $mes->id],
              'class' => 'button'
            ]
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