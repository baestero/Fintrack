<?php

/**
 * @var \App\View\AppView 
 * @var \App\Model\Entity\User
 */

?>

<?= $this->Form->create($user) ?>
<fieldset>
  <legend><?= __('Cadastrar Usuário') ?></legend>
  <?php
  echo $this->Form->control('username', ['label' => 'Usuário:']);
  echo $this->Form->control('password', [
    'label' => 'Senha'
  ]);
  ?>
</fieldset>
<?= $this->Form->button(__('Cadastrar')) ?>
<?= $this->Form->end() ?>