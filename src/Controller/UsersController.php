<?php

declare(strict_types=1);

namespace App\Controller;

class UsersController extends AppController
{
  public function beforeFilter(\Cake\Event\EventInterface $event)
  {
    parent::beforeFilter($event);

    $this->Authentication->addUnauthenticatedActions([
      'login',
      'add'
    ]);
  }

  public function login()
  {
    $this->viewBuilder()->setLayout('login');

    $result = $this->Authentication->getResult();


    if ($this->request->is('post')) {

      if ($result->isValid()) {

        $this->Flash->success(__('Login realizado com sucesso'));
        return $this->redirect('/');
      }

      $this->Flash->error('Usuário ou senha inválidos.');
    }
  }

  public function logout()
  {

    $this->Authentication->logout();

    return $this->redirect([
      'action' => 'login'
    ]);
  }

  public function add()
  {
    $this->viewBuilder()->setLayout('login');

    $user = $this->Users->newEmptyEntity();

    if ($this->request->is('post')) {

      $user = $this->Users->patchEntity($user, $this->request->getData());

      if ($this->Users->save($user)) {

        $this->Flash->success(__('Usuário cadastrado com sucesso.'));

        return $this->redirect(['action' => 'login']);
      }
      $this->Flash->error(__('Não foi possível cadastrar usuário, verifique os erros abaixo.'));
    }
    $this->set(compact('user'));
  }
}
