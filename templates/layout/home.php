<?php

$cakeDescription = 'Fintrack';
?>
<!DOCTYPE html>
<html>

<head>
  <?= $this->Html->charset() ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?= $cakeDescription ?>:
    <?= $this->fetch('title') ?>
  </title>
  <?= $this->Html->meta('icon') ?>

  <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>

  <?= $this->fetch('meta') ?>
  <?= $this->fetch('css') ?>
  <?= $this->fetch('script') ?>
</head>

<body>
  <nav class="top-nav">
    <div class="top-nav-inner">
      <div class="top-nav-title">
        <a href="/"><span>Fin</span>Track</a>
      </div>

      <div class="top-nav-links">

        <div class="mes-select">

          <?= $this->Html->image('calendar.svg') ?>


          <?= $this->Form->create(null, [
            'url' => ['controller' => 'Meses', 'action' => 'setAtivo']
          ]) ?>
          <?= $this->Form->control('mes_id', [
            'type' => 'select',
            'options' => $meses,
            'value' => $mes ? $mes->id : null,
            'label' => '',
            'empty' => 'Nenhum mês selecionado — crie um mês para começar',
            'onchange' => 'this.form.submit()'
          ]) ?>
          <?= $this->Form->end() ?>

        </div>

        <div class="button-nav">
          <a href="<?= $this->Url->build(['controller' => 'Lancamentos', 'action' => 'add']) ?>">
            Novo lançamento
          </a>
        </div>
        <div class="button-nav">
          <a href="<?= $this->Url->build(['controller' => 'Meses', 'action' => 'index']) ?>">
            Gerenciar Meses
          </a>
        </div>
        <div class="button-nav">
          <?= $this->Html->link(
            'Sair',
            ['controller' => 'Users', 'action' => 'logout']
          ) ?>
        </div>


      </div>
  </nav>
  <main class="main">
    <div class="container">
      <?= $this->Flash->render() ?>
      <?= $this->fetch('content') ?>
    </div>
  </main>
  <footer>
  </footer>
</body>

</html>