<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Award\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Interop\Container\ContainerInterface;
use Award\Model\AwardRepository;
use Award\Model\Award;
use Award\Form\AwardForm;

class AwardController extends AbstractActionController
{
    private $containerinterface;
    function __construct(ContainerInterface $containerinterface) {
        $this->containerinterface = $containerinterface;
    }

    public function indexAction() {
        $listSubaward = $this->containerinterface->get(\Award\Model\AwardRepository::class)->findAll();
        $this->layout()->setVariable('listSub', $listSubaward);
        if (!$this->identity()) {
            return $this->redirect()->toRoute('login');
        }
        $awards = $this->containerinterface->get(AwardRepository::class)->findAll();
        $request = $this->getRequest();
        if ($request->isXmlHttpRequest()) {
            $jsData = array();
            $idx = 0;
            foreach ($awards as $sampledata) {
                $jsData[$idx++] = $sampledata;
            }
            $view = new \Zend\View\Model\JsonModel($jsData);
            $view->setTerminal(true);
        } else {
            $view = new ViewModel([
                'awards' => $awards,
            ]);
        }
        
        return $view;
    }
    
    public function addAction() {
        $listSubaward = $this->containerinterface->get(\Award\Model\AwardRepository::class)->findAll();
        $this->layout()->setVariable('listSub', $listSubaward);
        if (!$this->identity()) {
            return $this->redirect()->toRoute('login');
        }
        $form = new AwardForm();
        $form->get('submit')->setAttribute('value', 'Lưu');
        $request = $this->getRequest();
        if (!$request->isPost()) {
            $viewModel = new ViewModel([
                'form' => $form
            ]);
            return $viewModel;
        }

        $award = new Award();
        $form->setData($request->getPost());

        if (!$form->isValid()) {
            exit('not valid');
        }
        $award->exchangeArray($form->getData());
        $this->containerinterface->get(AwardRepository::class)->saveRow($award);

        $flashMessenger = $this->flashMessenger();
        $success = true;
        if ($success){
            $toRoute = 'award';
            $flashMessenger->addSuccessMessage('Cập nhật thành công');
        } else {
            $toRoute = 'award/add';
             $flashMessenger->addErrorMessage('Có lỗi xảy ra');
        }
        return $this->redirect()->toRoute($toRoute);
    }

    public function editAction() {
        $listSubaward = $this->containerinterface->get(\Award\Model\AwardRepository::class)->findAll();
        $this->layout()->setVariable('listSub', $listSubaward);
        if (!$this->identity()) {
            return $this->redirect()->toRoute('login');
        }
        $id = (int) $this->params()->fromRoute('id', 0);
        
        if ($id == 0) {
            exit('invalid');
        }
        try {
            $award = $this->containerinterface->get(AwardRepository::class)->getRow($id);
        } catch (\Exception $e) {
            exit('Error');
        }
        $form = new AwardForm();
        $form->get('id')->setAttribute('type', 'hidden');
        $form->get('submit')->setAttribute('value', 'Lưu');
        $form->bind($award);
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
        $this->containerinterface->get(AwardRepository::class)->saveRow($award);
        $flashMessenger = $this->flashMessenger();
        $success = true;
        if ($success){
            $toRoute = 'award';
            $flashMessenger->addSuccessMessage('Cập nhật thành công');
        } else {
            $toRoute = 'award/edit/'.$id;
             $flashMessenger->addErrorMessage('Có lỗi xảy ra');
        }
        return $this->redirect()->toRoute($toRoute);
    }

    public function deleteAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id == 0) {
            exit('invalid');
        }
        $this->containerinterface->get(AwardRepository::class)->delete($id);
        return $this->redirect()->toRoute('award');
    }
}
