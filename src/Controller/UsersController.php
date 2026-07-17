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

      $data = $this->request->getData();

      $user = $this->Users->patchEntity($user, $data);

      if ($this->Users->save($user)) {
        $this->Flash->success(__('Usuário cadastrado com sucesso.'));
        return $this->redirect(['action' => 'login']);
      }

      $errors = $user->getError('username');
      if (!empty($errors)) {
        $this->Flash->error(current($errors));
      }
    }

    $this->set(compact('user'));
  }
}
