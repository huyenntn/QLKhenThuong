<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Auth\Model\UserRepository;
use Interop\Container\ContainerInterface;
use Zend\View\Model\ViewModel;
class AuthController extends AbstractActionController {
    public $containerinterface;
    public function __construct(ContainerInterface $containerinterface) {
        $this->containerinterface = $containerinterface;
    }
    public function indexAction() {
        $alluser = $this->containerinterface->get(UserRepository::class)->findAll();
        return new ViewModel(['alluser' => $alluser,]);
    }
    
    public function addAction() {
        $form = new \Auth\Form\AddUserForm();
        $form->get('submit')->setAttribute('class', 'btn btn-danger');
        $form->get('submit')->setAttribute('value', 'Lưu');
        $request = $this->getRequest();
        if (!$request->isPost()) {
            $viewModel = new ViewModel([
                'form' => $form
            ]);
            return $viewModel;
        }

        $user = new \Auth\Model\User();
        $form->setData($request->getPost());

        if (!$form->isValid()) {
            exit('not valid');
        }
        $user->exchangeArray($form->getData());
        $this->containerinterface->get(UserRepository::class)->saveUser($user);
        return $this->redirect()->toRoute('auth');
    }

    public function editAction() {
        $id = (int) $this->params()->fromRoute('acc', 0);
        if ($id == 0) {
            exit('invalid acc');
        }
        try {
            $user = $this->containerinterface->get(UserRepository::class)->getUser($id);
        } catch (\Exception $e) {
            exit('Error with User table');
        }
        $form = new \Auth\Form\AddUserForm();
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
        $this->containerinterface->get(UserRepository::class)->saveUser($user);
        return $this->redirect()->toRoute('auth');
    }

    public function deleteAction() {
        $id = (int) $this->params()->fromRoute('acc', 0);
        if ($id == 0) {
            exit('invalid acc');
        }
        $this->containerinterface->get(UserRepository::class)->deleteUser($id);
        return $this->redirect()->toRoute('auth');
    }
}
