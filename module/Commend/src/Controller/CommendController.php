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
use Zend\View\Model\JsonModel;

class CommendController extends AbstractActionController {

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
        $commends = $this->containerinterface->get(CommendRepository::class)->JoinfetchAll();
        return new ViewModel(['commends' => $commends]);
    }

    public function listbytypeAction() {
        if (!$this->identity()) {
            return $this->redirect()->toRoute('login');
        }
        $listSubaward = $this->containerinterface->get(\Award\Model\AwardRepository::class)->findAll();
        $this->layout()->setVariable('listSub', $listSubaward);
        $type = (int) $this->params()->fromRoute('type', 0);
        $request = $this->getRequest();
        $query = $request->getQuery();
        $selectOptionSubject = $this->containerinterface->get(CommendRepository::class)->getListYear();
        $selectDataSubject = [];
        $selectDataSubject[0] = 'Xóa bộ lọc năm';
        foreach ($selectOptionSubject as $resS) {
            $selectDataSubject[$resS->year] = $resS->year;
        }
        
        $selectOptionAward = $this->containerinterface->get(\Subaward\Model\SubawardRepository::class)->fetchByType($type);
        $selectDataAward = [];
        $selectDataAward[0] = 'Xóa bộ lọc danh hiệu';
        foreach ($selectOptionAward as $resAw) {
            $selectDataAward[$resAw->id] = $resAw->subAwardName;
        }
        
        $form = new \Commend\Form\CommendForm();
        $form->get('selectYear')->setAttribute('options', $selectDataSubject);
        $form->get('selectsubaward')->setAttribute('options', $selectDataAward);
        $paginator = $this->containerinterface->get(CommendRepository::class)->fetchByType($type, true);

        if ($request->isXmlHttpRequest()) {
            $year = $this->request->getPost('year');
            $idSub = $this->request->getPost('idSub');
            if ($year!=0 && $idSub==0) {
                $paginator = $this->containerinterface->get(CommendRepository::class)->fetchByTypeAndYear($type, $year, true);
            } else if($year==0 && $idSub!=0){
                $paginator = $this->containerinterface->get(CommendRepository::class)->fetchByTypeAndSubAward($type, $idSub, true);
            }else if($year!=0 && $idSub!=0){
                $paginator = $this->containerinterface->get(CommendRepository::class)->fetchByTypeSubAwardYear($type, $idSub, $year, true);
            }
            else {
                $paginator = $this->containerinterface->get(CommendRepository::class)->fetchByType($type, true);
            }

            $jsData = array();
            $idx = 0;
            foreach ($paginator as $sampledata) {
                $jsData[$idx++] = $sampledata;
            }
            $view = new JsonModel($jsData);
            $view->setTerminal(true);
        } else {
            $view = new ViewModel([
                'paginator' => $paginator,
                'type' => $type,
                'form' => $form,
            ]);
        }
        return $view;
    }

    public function addAction() {
        if (!$this->identity()) {
            return $this->redirect()->toRoute('login');
        }
        $listSubaward = $this->containerinterface->get(\Award\Model\AwardRepository::class)->findAll();
        $this->layout()->setVariable('listSub', $listSubaward);
        if ((int) $this->params()->fromRoute('type', 0) == 0) {
            $type = (int) $this->params()->fromQuery('type', 0);
        } else {
            $type = (int) $this->params()->fromRoute('type', 0);
        }
        $selectOptionSubject = $this->containerinterface->get(\Subject\Model\SubjectTable::class)->selectByType($type);
        $selectDataSubject = [];
        foreach ($selectOptionSubject as $resS) {
            $selectDataSubject[$resS->idS] = $resS->nameF.' '.$resS->nameS;
        }

        $selectOptionAward = $this->containerinterface->get(\Subaward\Model\SubawardRepository::class)->fetchByType($type);
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
                'form' => $form,
                'type' => $type
            ]);
            return $viewModel;
        }

        $commend = new \Commend\Model\Commend();
        $form->setData($request->getPost());

        if (!$form->isValid()) {
            $form->getMessages(); //error messages
        }

        $commend->exchangeArray($form->getData());

        $this->containerinterface->get(CommendRepository::class)->saveRow($commend);
        
        $flashMessenger = $this->flashMessenger();
        $success = true;
        if ($success){
            $flashMessenger->addSuccessMessage('Cập nhật thành công');
            return $this->redirect()->toRoute('commend', ['action' => 'listbytype', 'type' => $type]);
            
        } else {
            $flashMessenger->addErrorMessage('Có lỗi xảy ra');
            return $this->redirect()->toRoute('commend', ['action' => 'listbytype', 'type' => $type]);
             
        }
    }

    public function editAction() {
        $id = (int) $this->params()->fromQuery('id', 0);
        $type = (int) $this->params()->fromQuery('type', 0);
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
            $selectDataSubject[$resS->idS] = $resS->nameF.' '.$resS->nameS;
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
                'id' => $id,
                'type' => $type
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
        $id = (int) $this->params()->fromQuery('id', 0);
        try {
            $commend = $this->containerinterface->get(CommendRepository::class)->getRow($id);
        } catch (\Exception $e) {
            exit('Errorrrrrr');
        }
        $type = $commend->institute;
        if ($id == 0) {
            exit('invalid');
        }
        $this->containerinterface->get(CommendRepository::class)->delete($id);
        return $this->redirect()->toRoute('commend', ['action' => 'listbytype', 'type' => $type]);
    }

    public function detailAction() {
        if (!$this->identity()) {
            return $this->redirect()->toRoute('login');
        }
        $listSubaward = $this->containerinterface->get(\Award\Model\AwardRepository::class)->findAll();
        $this->layout()->setVariable('listSub', $listSubaward);
        
        $id = (int) $this->params()->fromQuery('id', 0);
        $subject = $this->containerinterface->get(\Subject\Model\SubjectTable::class)->getRow($id);
        $info = $this->containerinterface->get(CommendRepository::class)->getDetail($id);
        $request = $this->getRequest();
        if ($request->isXmlHttpRequest()) {            
            $jsData = array();
            $idx = 0;
            foreach ($info as $sampledata) {
                $jsData[$idx++] = $sampledata;
            }
            $view = new JsonModel($jsData);
            $view->setTerminal(true);
        } else {
            $view = new ViewModel([
                'info' => $info,
                'subject' => $subject,
            ]);
        }
        return $view;
    }
    
    public function searchAction(){
        $listSubaward = $this->containerinterface->get(\Award\Model\AwardRepository::class)->findAll();
        $this->layout()->setVariable('listSub', $listSubaward);
        if (!$this->identity()) {
            return $this->redirect()->toRoute('login');
        }
        $searchvalue = $this->params()->fromQuery('search','');
        $searchrs = $this->containerinterface->get(CommendRepository::class)->searchByName($searchvalue);
        return new ViewModel(['searchvalue' => $searchrs]);
    }

}
