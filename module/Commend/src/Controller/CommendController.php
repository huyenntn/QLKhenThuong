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

        foreach ($selectOptionSubject as $resS) {
            $selectDataSubject[$resS->year] = $resS->year;
        }
        $form = new \Commend\Form\CommendForm();
        $form->get('selectYear')->setAttribute('options', $selectDataSubject);
        $paginator = $this->containerinterface->get(CommendRepository::class)->fetchByType($type, true);
        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        // set the number of items per page to 10
        $paginator->setItemCountPerPage(10);
        if ($request->isXmlHttpRequest() || $query->get('showJson') == 1) {
            $year = $this->request->getPost('year');
            if ($year) {
                $paginator = $this->containerinterface->get(CommendRepository::class)->fetchByTypeAndYear($type, $year, true);
            } else {
                $paginator = $this->containerinterface->get(CommendRepository::class)->fetchByType($type, true);
            }
            $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
            // set the number of items per page to 10
            $paginator->setItemCountPerPage(10);
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
        if ((int) $this->params()->fromRoute('type', 0) == 0) {
            $type = (int) $this->params()->fromQuery('type', 0);
        } else {
            $type = (int) $this->params()->fromRoute('type', 0);
        }
        $selectOptionSubject = $this->containerinterface->get(\Subject\Model\SubjectTable::class)->selectByType($type);
        $selectDataSubject = [];
        foreach ($selectOptionSubject as $resS) {
            $selectDataSubject[$resS->idS] = $resS->nameS;
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
        return $this->redirect()->toRoute('commend', ['action' => 'listbytype', 'type' => $type]);
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

    public function requestTypeAction() {
        
    }

}
