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

  <?= $this->Html->meta(
    'icon',
    '/img/finance.svg',
    ['type' => 'image/svg+xml']
  ) ?>

  <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>

  <?= $this->fetch('meta') ?>
  <?= $this->fetch('css') ?>
  <?= $this->fetch('script') ?>
</head>

<body>
  <nav class="top-nav">
    <div class="top-nav-inner">
      <div class="top-nav-title">
        <a href='/'><span>Fin</span>Track</a>
      </div>
      <div>
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

</body>

</html>