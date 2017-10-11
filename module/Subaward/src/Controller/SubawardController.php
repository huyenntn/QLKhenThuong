<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Subaward\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Interop\Container\ContainerInterface;
use Subaward\Model\SubawardRepository;
use Subaward\Model\Subaward;
use Subaward\Form\SubawardForm;
use Zend\View\Model\JsonModel;
use Zend\Json\Encoder;

class SubawardController extends AbstractActionController
{
    
    private $containerinterface;
    function __construct(ContainerInterface $containerinterface) {
        $this->containerinterface = $containerinterface;
    }

    public function indexAction() {
        if (!$this->identity()) {
            return $this->redirect()->toRoute('login');
        }
        $listSubaward = $this->containerinterface->get(\Award\Model\AwardRepository::class)->findAll();
        $this->layout()->setVariable('listSub', $listSubaward);
        $id = (int) $this->params()->fromRoute('id', 0);
        $sj = $this->containerinterface->get(SubawardRepository::class)->JoinfetchAll($id);
        $request = $this->getRequest();
        $query = $request->getQuery();
        if ($request->isXmlHttpRequest() || $query->get('showJson') == 1) {
            $jsonData = array();
            $idx = 0;
            foreach ($sj as $sampledata) {
                $jsonData[$idx++] = $sampledata;
            }
            $view = new JsonModel($jsonData);
            $view->setTerminal(true);
        } else {
            $view = new ViewModel(['idAward' => $id]);
        }
        return $view;
    }
    
    public function addAction() {
        if (!$this->identity()) {
            return $this->redirect()->toRoute('login');
        }
        $listSubaward = $this->containerinterface->get(\Award\Model\AwardRepository::class)->findAll();
        $this->layout()->setVariable('listSub', $listSubaward);
        $id = (int) $this->params()->fromRoute('id', 0);
        $selectOption = $this->containerinterface->get(\Award\Model\AwardRepository::class)->findAll();
        $selectData = [];
        foreach ($selectOption as $res) {
             $selectData[$res->id] = $res->awardName;
        }
        $form = new SubawardForm();
        $form->get('submit')->setAttribute('value', 'Lưu');
        $form->get('awardId')->setAttribute('options', $selectData);
        $form->get('awardId')->setAttribute('value', $id);

        $request = $this->getRequest();
        if (!$request->isPost()) {
            $viewModel = new ViewModel([
                'form' => $form,
            ]);
            
            return $viewModel;
        }

        $subaward = new Subaward();
        $form->setData($request->getPost());
        
        if (!$form->isValid()) {
            exit('not valid');
        }
        $subaward->exchangeArray($form->getData());
        $this->containerinterface->get(SubawardRepository::class)->saveRow($subaward);
        
        $flashMessenger = $this->flashMessenger();
        $success = true;
        if ($success){
            $flashMessenger->addSuccessMessage('Cập nhật thành công');
            return $this->redirect()->toRoute('subaward', [
                                            'action' => 'index',
                                            'id' => $subaward->awardId,
                                        ]);
            
        } else {
            $flashMessenger->addErrorMessage('Có lỗi xảy ra');
            return $this->redirect()->toRoute('subaward', [
                                            'action' => 'add',
                                            'id' => $subaward->awardId,
                                        ]);
             
        }
    }

    public function editAction() {
         if (!$this->identity()) {
            return $this->redirect()->toRoute('login');
        }
        $listSubaward = $this->containerinterface->get(\Award\Model\AwardRepository::class)->findAll();
        $this->layout()->setVariable('listSub', $listSubaward);
        $id = (int) $this->params()->fromRoute('id', 0);
        $selectOption = $this->containerinterface->get(\Award\Model\AwardRepository::class)->findAll();
        $selectData = [];
        foreach ($selectOption as $res) {
             $selectData[$res->id] = $res->awardName;
        }
        if ($id == 0) {
            exit('invalid');
        }
        try {
            $subaward = $this->containerinterface->get(SubawardRepository::class)->getRow($id);
        } catch (\Exception $e) {
            exit('Errorrrrrr');
        }
        $form = new SubawardForm();
        $form->get('id')->setAttribute('type', 'hidden');
        $form->get('submit')->setAttribute('value', 'Lưu');
        $form->get('awardId')->setAttribute('options', $selectData);
        $form->bind($subaward);
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
        
        $this->containerinterface->get(SubawardRepository::class)->saveRow($subaward);
        
        $flashMessenger = $this->flashMessenger();
        $success = true;
        if ($success){
            $flashMessenger->addSuccessMessage('Cập nhật thành công');
            return $this->redirect()->toRoute('subaward', [
                                            'action' => 'index',
                                            'id' => $subaward->awardId,
                                        ]);
            
        } else {
            $flashMessenger->addErrorMessage('Có lỗi xảy ra');
            return $this->redirect()->toRoute('subaward', [
                                            'action' => 'edit',
                                            'id' => $id,
                                        ]);
             
        }
    }

    public function deleteAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id == 0) {
            exit('invalid');
        }
        try {
            $subaward = $this->containerinterface->get(SubawardRepository::class)->getRow($id);
        } catch (\Exception $e) {
            exit('Errorrrrrr');
        }
        
        $this->containerinterface->get(SubawardRepository::class)->delete($id);
        return $this->redirect()->toRoute('subaward', [
                                            'action' => 'index',
                                            'id' => $subaward->awardId,
                                        ]);
    }
    public function getAllSubAward(){
        $subaward = $this->containerinterface->get(SubawardRepository::class)->findAll();
        return $subaward;
    }
}
