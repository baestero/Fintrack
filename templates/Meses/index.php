<?= $this->Html->css('meses', ['block' => true]); ?>

<div class="meses-container">
  <h2>Meses</h2>
  <a href="/meses/add" class="meses-add-btn">+</a>
</div>

<div class="meses-cards">
  <?php foreach ($meses as $mes): ?>
    <div class="mes-card">
      <div class="mes-card-topo">
        <p class="mes-data"><?= $mes->data_referencia->i18nFormat('MM/yyyy') ?></p>
        <span class="mes-status <?= $mes->id == $mesAtivoId ? 'status-selecionado' : 'status-nao-selecionado' ?>">
          <?= $mes->id == $mesAtivoId ? 'Selecionado' : 'Não selecionado' ?>
        </span>
      </div>

      <div class="mes-card-acoes">
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
              'class' => 'button button-outline'
            ]
          ) ?>
      </div>
    </div>
  <?php endforeach; ?>
  <?php if (empty($meses)): ?>
    <p class="meses-vazio">Nenhum mês cadastrado ainda.</p>
  <?php endif; ?>
</div>