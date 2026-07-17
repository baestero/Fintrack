<?php
$showLogout = $showLogout ?? true;
?>
<nav class="top-nav">
  <div class="top-nav-inner">
    <div class="top-nav-title">
      <a href="/"><span>Fin</span>Track</a>
    </div>
    <?php if ($showLogout): ?>
      <div class="top-nav-links">
        <div>
          <?= $this->Html->link(
            'Sair',
            ['controller' => 'Users', 'action' => 'logout']
          ) ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
</nav>
