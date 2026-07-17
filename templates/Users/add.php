<?php

/**
 * @var \App\View\AppView 
 * @var \App\Model\Entity\User
 */

?>

<?= $this->Html->css('login', ['block' => true]); ?>


<div class="login-container">
  <h2>Sua vida financeira sob controle.</h2>
  <h4>Cadastre-se</h4>
</div>

<?= $this->Form->create($user) ?>

<?php
echo $this->Form->control('username', ['label' => 'Usuário', 'error' => false]);
echo $this->Form->control('password', [
  'label' => 'Senha'
]);
?>
</fieldset>
<?= $this->Form->button(__('Cadastrar')) ?>
<?= $this->Form->end() ?>