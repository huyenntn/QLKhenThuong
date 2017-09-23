<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Model\UserTable;

include "vendor/autoload.php";

class UserController extends AbstractActionController {

    public $userTable;
    public $authenticate;

    public function getAuthenticate() {
        return $this->authenticate;
    }

    function __construct(UserTable $userTable) {
        $this->userTable = $userTable;
    }

    public function indexAction() {
        return new ViewModel([
            'users' => $this->userTable->fetchAllUser(),
        ]);
    }

    public function addAction() {
        $form = new \User\Form\AddUserForm();
        $form->get('submit')->setAttribute('class', 'btn btn-danger');
        $request = $this->getRequest();
        if (!$request->isPost()) {
            $viewModel = new ViewModel([
                'form' => $form
            ]);
            $viewModel->setTerminal(true);
            return $viewModel;
        }

        $user = new \User\Model\User();
        $form->setData($request->getPost());

        if (!$form->isValid()) {
            exit('not valid');
        }
        $user->exchangeArray($form->getData());
        $this->userTable->saveUser($user);
        return $this->redirect()->toRoute('user', [
                    'controller' => 'index',
                    'action' => 'list'
        ]);
    }

    public function editAction() {
        $acc = (string) $this->params()->fromRoute('acc', null);
        if ($acc == null) {
            exit('invalid acc');
        }
        try {
            $user = $this->userTable->getUser($acc);
        } catch (\Exception $e) {
            exit('Error with User table');
        }
        $form = new \User\Form\AddUserForm();
        $form->get('submit')->setAttribute('class', 'btn btn-danger');
        $form->get('acc')->setAttribute('type', 'hidden');
        $form->bind($user);
        $request = $this->getRequest();
        //if not post request
        if (!$request->isPost()) {
            return new ViewModel([
                'form' => $form,
                'acc' => $acc
            ]);
        }
        $form->setData($request->getPost());
        if (!$form->isValid()) {
            exit('not valid');
        }
        $this->userTable->saveUser($user);
        return $this->redirect()->toRoute('user', [
                    'controller' => 'index',
                    'action' => 'list'
        ]);
    }

    public function deleteAction() {
        $acc = (string) $this->params()->fromRoute('acc', null);
        if ($acc == null) {
            exit('invalid acc');
        }
        try {
            $user = $this->userTable->getUser($acc);
        } catch (\Exception $e) {
            exit('Error with User table');
        }

        $this->userTable->deleteUser($acc);
        return $this->redirect()->toRoute('user', [
                    'controller' => 'index',
                    'action' => 'list'
        ]);
    }

    public function loginAction() {

        $form = new \User\Form\LoginFrom();

        $request = $this->getRequest();
        if (!$request->isPost()) {
            $viewModel = new ViewModel([
                'form' => $form
            ]);
            $viewModel->setTerminal(TRUE);
            return  $viewModel ;
        }

        $user = new \User\Model\User();
        $form->setData($request->getPost());

        if (!$form->isValid()) {
            exit('not valid');
        }
        $user->exchangeArray($form->getData());
        $acc = $user->acc;
        $pass = $user->pass;

        $check = $this->userTable->selectByAccAndPass($acc,$pass);
        if ($check) {
            return $this->redirect()->toRoute('user', [
                        'controller' => 'index',
                        'action' => 'list'
            ]);
        } else {
            return $this->redirect()->toRoute('user', [
                        'controller' => 'index',
                        'action' => 'login'
            ]);
        }
    }

    public function listAction() {
        return new ViewModel([
            'users' => $this->userTable->fetchAllUser()
        ]);
    }

}
