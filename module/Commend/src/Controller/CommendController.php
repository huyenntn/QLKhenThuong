<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Commend\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Commend\Model\CommendRepository;
use Interop\Container\ContainerInterface;

class CommendController extends AbstractActionController
{
    private $containerinterface;
    function __construct(ContainerInterface $containerinterface) {
        $this->containerinterface = $containerinterface;
    }

    public function indexAction() {
        if (!$this->identity()) {
            return $this->redirect()->toRoute('login');
        }
        $commends = $this->containerinterface->get(CommendRepository::class)->JoinfetchAll();
        $listSubaward = $this->containerinterface->get(\Award\Model\AwardRepository::class)->findAll();
        $this->layout()->setVariable('listSub', $listSubaward);
        return new ViewModel(['commends' => $commends]);
    }
    
    public function listbytypeAction(){
        $type = (int) $this->params()->fromRoute('id', 0);
        $commends = $this->containerinterface->get(CommendRepository::class)->fetchByType($type);
        return new ViewModel(['commends' => $commends,]);
    }

        public function addPersonalAction() {
        $selectOptionSubject = $this->containerinterface->get(\Subject\Model\SubjectTable::class)->fetchAll();
        $selectDataSubject = [];
        foreach ($selectOptionSubject as $resS) {
             $selectDataSubject[$resS->idS] = $resS->nameS;
        }
        
        $selectOptionAward = $this->containerinterface->get(\Subaward\Model\SubawardRepository::class)->fetchByType(1);
        $selectDataAward = [];
        foreach ($selectOptionAward as $resAw) {
             $selectDataAward[$resAw->id] = $resAw->subAwardName;
        }
        
        $form = new \Commend\Form\CommendForm();
        $form->get('submit')->setAttribute('class', 'btn btn-danger');
        $form->get('idCmd')->setAttribute('type', 'hidden');
        $form->get('submit')->setAttribute('value', 'Lưu');
        $form->get('idS')->setAttribute('options', $selectDataSubject);
        $form->get('idSubAward')->setAttribute('options', $selectDataAward);
        $request = $this->getRequest();
        if (!$request->isPost()) {
            $viewModel = new ViewModel([
                'form' => $form
            ]);
            return $viewModel;
        }
        $commend = new \Commend\Model\Commend();
        $form->setData($request->getPost());
        if (!$form->isValid()) {
            exit('not validdddddddd');
        }               
        $commend->exchangeArray($form->getData());
        $this->containerinterface->get(CommendRepository::class)->saveRow($commend);
        return $this->redirect()->toRoute('commend');
    }
    
    public function addGroupAction() {
        $selectOptionSubject = $this->containerinterface->get(\Subject\Model\SubjectTable::class)->fetchAll();
        $selectDataSubject = [];
        foreach ($selectOptionSubject as $resS) {
             $selectDataSubject[$resS->idS] = $resS->nameS;
        }
        
        $selectOptionAward = $this->containerinterface->get(\Subaward\Model\SubawardRepository::class)->fetchByType(2);
        $selectDataAward = [];
        foreach ($selectOptionAward as $resAw) {
             $selectDataAward[$resAw->id] = $resAw->subAwardName;
        }
        
        $form = new \Commend\Form\CommendForm();
        $form->get('submit')->setAttribute('class', 'btn btn-danger');
        $form->get('idCmd')->setAttribute('type', 'hidden');
        $form->get('submit')->setAttribute('value', 'Lưu');
        $form->get('idS')->setAttribute('options', $selectDataSubject);
        $form->get('idSubAward')->setAttribute('options', $selectDataAward);
        $request = $this->getRequest();
        if (!$request->isPost()) {
            $viewModel = new ViewModel([
                'form' => $form
            ]);
            return $viewModel;
        }
        $commend = new \Commend\Model\Commend();
        $form->setData($request->getPost());
        if (!$form->isValid()) {
            exit('not validdddddddd');
        }               
        $commend->exchangeArray($form->getData());
        $this->containerinterface->get(CommendRepository::class)->saveRow($commend);
        return $this->redirect()->toRoute('commend');
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
            $commend = $this->containerinterface->get(CommendRepository::class)->getRow($id);
        } catch (\Exception $e) {
            exit('Errorrrrrr');
        }
        $selectOptionSubject = $this->containerinterface->get(\Subject\Model\SubjectTable::class)->fetchAll();
        $selectDataSubject = [];
        foreach ($selectOptionSubject as $resS) {
             $selectDataSubject[$resS->idS] = $resS->nameS;
        }
        
        $selectOptionAward = $this->containerinterface->get(\Subaward\Model\SubawardRepository::class)->findAll();
        $selectDataAward = [];
        foreach ($selectOptionAward as $resAw) {
             $selectDataAward[$resAw->id] = $resAw->subAwardName;
        }
        
        $form = new \Commend\Form\CommendForm();
        $form->get('submit')->setAttribute('class', 'btn btn-danger');
        $form->get('idCmd')->setAttribute('type', 'hidden');
        $form->get('submit')->setAttribute('value', 'Lưu');
        $form->get('idS')->setAttribute('options', $selectDataSubject);
        $form->get('idSubAward')->setAttribute('options', $selectDataAward);
        $form->bind($commend);
        $request = $this->getRequest();
        //if not post request
        if (!$request->isPost()) {
            return new ViewModel([
                'form' => $form,
                'id' => $id
            ]);
        }
        $form->setData($request->getPost());
        var_dump($form);
        if (!$form->isValid()) {
            exit('not valid');
        }
        
//        $this->containerinterface->get(SubawardRepository::class)->saveRow($subaward);
//        return $this->redirect()->toRoute('subaward');
    }

    public function deleteAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        var_dump($id);
        if ($id == 0) {
            exit('invalid');
        }
        $this->containerinterface->get(CommendRepository::class)->delete($id);
        return $this->redirect()->toRoute('commend');
    }
    public function requestTypeAction(){
       
    }
}
