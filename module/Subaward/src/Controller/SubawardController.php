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


class SubawardController extends AbstractActionController
{
    private $containerinterface;
    function __construct(ContainerInterface $containerinterface) {
        $this->containerinterface = $containerinterface;
    }

    public function indexAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$this->identity()) {
            return $this->redirect()->toRoute('login');
        }
        $listSubaward = $this->containerinterface->get(\Award\Model\AwardRepository::class)->findAll();
        $this->layout()->setVariable('listSub', $listSubaward);
        $subawards = $this->containerinterface->get(SubawardRepository::class)->JoinfetchAll($id);
        return new ViewModel(['subawards' => $subawards,]);
    }
    
    public function addAction() {
        $selectOption = $this->containerinterface->get(\Award\Model\AwardRepository::class)->findAll();
        $selectData = [];
        foreach ($selectOption as $res) {
             $selectData[$res->id] = $res->awardName;
        }
        $form = new SubawardForm();
        $form->get('submit')->setAttribute('class', 'btn btn-danger');
        $form->get('submit')->setAttribute('value', 'Lưu');
        $form->get('awardId')->setAttribute('options', $selectData);
        $request = $this->getRequest();
        if (!$request->isPost()) {
            $viewModel = new ViewModel([
                'form' => $form
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
        return $this->redirect()->toRoute('subaward');
    }

    public function editAction() {
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
        return $this->redirect()->toRoute('subaward');
    }

    public function deleteAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id == 0) {
            exit('invalid');
        }
        $this->containerinterface->get(SubawardRepository::class)->delete($id);
        return $this->redirect()->toRoute('subaward');
    }
}
