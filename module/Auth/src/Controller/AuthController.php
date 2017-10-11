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
use Zend\Mvc\Plugin\FlashMessenger\FlashMessenger;
class AuthController extends AbstractActionController {
    public $containerinterface;
    public function __construct(ContainerInterface $containerinterface) {
        $this->containerinterface = $containerinterface;
    }
    public function indexAction() {
        $listSubaward = $this->containerinterface->get(\Award\Model\AwardRepository::class)->findAll();
        $this->layout()->setVariable('listSub', $listSubaward);
        if (!$this->identity()) {
            return $this->redirect()->toRoute('login');
        }
        $alluser = $this->containerinterface->get(UserRepository::class)->findAll();
        $request = $this->getRequest();
        if ($request->isXmlHttpRequest()) {
            
            $jsData = array();
            $idx = 0;
            foreach ($alluser as $sampledata) {
                $jsData[$idx++] = $sampledata;
            }
            $view = new \Zend\View\Model\JsonModel($jsData);
            $view->setTerminal(true);
        } else {
            $view = new ViewModel([
                'alluser' => $alluser,
            ]);
        }
        
        return $view;
    }
    
    public function addAction() {
        $form = new \Auth\Form\AddUserForm();
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
        
        
        $flashMessenger = $this->flashMessenger();
        $success = true;
        if ($success){
            $toRoute = 'auth';
            $flashMessenger->addSuccessMessage('Thêm người dùng mới thành công');
        } else {
            $toRoute = 'auth/add';
             $flashMessenger->addErrorMessage('Có lỗi xảy ra');
        }
        return $this->redirect()->toRoute($toRoute);
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

        $flashMessenger = $this->flashMessenger();
        $success = true;
        if ($success){
            $toRoute = 'auth';
            $flashMessenger->addSuccessMessage('Cập nhật thành công');
        } else {
            $toRoute = 'auth/edit/'.$id;
             $flashMessenger->addErrorMessage('Có lỗi xảy ra');
        }
        return $this->redirect()->toRoute($toRoute);
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
