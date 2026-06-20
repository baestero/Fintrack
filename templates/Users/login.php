<?= $this->Form->create() ?>
<div class="login-container">
  <h2>Sua vida financeira sob controle.</h2>
  <h4>Acesse sua conta</h4>
</div>
<?= $this->Form->control('username', ['label' => 'Usuário']) ?>

<?= $this->Form->control('password', ['label' => 'Senha']) ?>

<?= $this->Form->button('Entrar') ?>

<?= $this->Form->end() ?>