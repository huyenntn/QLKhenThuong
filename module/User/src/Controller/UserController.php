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
        $form->get('submit')->setAttribute('value', 'Lưu');
        $request = $this->getRequest();
        if (!$request->isPost()) {
            $viewModel = new ViewModel([
                'form' => $form
            ]);
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
        $id = (int) $this->params()->fromRoute('acc', 0);
        if ($id == 0) {
            exit('invalid acc');
        }
        try {
            $user = $this->userTable->getUser($id);
        } catch (\Exception $e) {
            exit('Error with User table');
        }
        $form = new \User\Form\AddUserForm();
        $form->get('acc')->setAttribute('type', 'hidden');
        $form->get('id')->setAttribute('type', 'hidden');
        $form->get('submit')->setAttribute('value', 'Lưu');
        $form->bind($user);
        $request = $this->getRequest();
        //if not post request
        if (!$request->isPost()) {
            return new ViewModel([
                'form' => $form,
                'id' => $id
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
        $id = (int) $this->params()->fromRoute('acc', 0);
        if ($id == 0) {
            exit('invalid acc');
        }
        try {
            $user = $this->userTable->getUser($id);
        } catch (\Exception $e) {
            exit('Error with User table');
        }

        $this->userTable->deleteUser($id);
        return $this->redirect()->toRoute('user', [
                    'controller' => 'index',
                    'action' => 'list'
        ]);
    }

    public function loginAction() {

        
    }

    public function listAction() {
        return new ViewModel([
            'users' => $this->userTable->fetchAllUser()
        ]);
    }

}
