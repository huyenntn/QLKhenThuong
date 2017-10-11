<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Subject\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Subject\Form\SubjectForm;
use Subject\Model\Subject;
use Interop\Container\ContainerInterface;
use Zend\View\Model\JsonModel;

class SubjectController extends AbstractActionController {

    private $containerinterface;

    function __construct(ContainerInterface $containerinterface) {
        $this->containerinterface = $containerinterface;
    }

    public function indexAction() {
        if (!$this->identity()) {
            return $this->redirect()->toRoute('login');
        }
        $type = (int) $this->params()->fromQuery('type', 0);
        $listSubaward = $this->containerinterface->get(\Award\Model\AwardRepository::class)->findAll();
        $this->layout()->setVariable('listSub', $listSubaward);
        
        $request = $this->getRequest();
        $query = $request->getQuery();
        $paginator = $this->containerinterface->get(\Subject\Model\SubjectTable::class)->selectByType($type);

        if ($request->isXmlHttpRequest()) {
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
        $type = (int) $this->params()->fromQuery('type', 0);
        $form = new SubjectForm();
        if ($type == 2) {
            $form->get('nameF')->setAttribute('type', 'hidden');
        }
        $form->get('submit')->setAttribute('class', 'btn btn-danger');
        $form->get('submit')->setAttribute('value', 'Lưu');
        $form->get('typeS')->setAttribute('value', $type);
        $form->get('typeS')->setAttribute('type', 'hidden');
        $request = $this->getRequest();
        if (!$request->isPost()) {
            $viewModel = new ViewModel([
                'form' => $form,
                'type' => $type
            ]);
            return $viewModel;
        }
        $subject = new Subject();
        $form->setData($request->getPost());

        if (!$form->isValid()) {
            exit('not valid');
        }
        $subject->exchangeArray($form->getData());
        $this->containerinterface->get(\Subject\Model\SubjectTable::class)->saveRow($subject);


        $flashMessenger = $this->flashMessenger();
        $success = true;
        if ($success) {
            $flashMessenger->addSuccessMessage('Cập nhật thành công');
            return $this->redirect()->toRoute('subject', [
                        'action' => 'index',
                        'id' => $subject->typeS,
            ]);
        } else {
            $flashMessenger->addErrorMessage('Có lỗi xảy ra');
            return $this->redirect()->toRoute('subject', [
                        'action' => 'index',
                        'id' => $subject->typeS,
            ]);
        }
    }

    public function editAction() {
        if (!$this->identity()) {
            return $this->redirect()->toRoute('login');
        }
        $listSubaward = $this->containerinterface->get(\Award\Model\AwardRepository::class)->findAll();
        $this->layout()->setVariable('listSub', $listSubaward);
        $id = (int) $this->params()->fromQuery('id', 0);
        $type = (int) $this->params()->fromQuery('type', 0);

        if ($id == 0) {
            exit('invalid accccc');
        }
        try {
            $subject = $this->containerinterface->get(\Subject\Model\SubjectTable::class)->getRow($id);
        } catch (\Exception $e) {
            exit('Error with User table');
        }
        $form = new SubjectForm();
        if ($type == 2) {
            $form->get('nameF')->setAttribute('type', 'hidden');
        }
        $form->get('idS')->setAttribute('type', 'hidden');
        $form->get('submit')->setAttribute('value', 'Lưu');

        $form->bind($subject);
        $form->get('typeS')->setAttribute('type', 'hidden');
        $request = $this->getRequest();
        //if not post request
        if (!$request->isPost()) {
            return new ViewModel([
                'form' => $form,
                'id' => $id,
                'type' => $type,
            ]);
        }
        $form->setData($request->getPost());
        if (!$form->isValid()) {
            exit('not valid');
        }
        $this->containerinterface->get(\Subject\Model\SubjectTable::class)->saveRow($subject);

        $flashMessenger = $this->flashMessenger();
        $success = true;
        if ($success) {
            $flashMessenger->addSuccessMessage('Cập nhật thành công');
            return $this->redirect()->toRoute('subject', [
                        'action' => 'index',
                        'id' => $subject->typeS,
            ]);
        } else {
            $flashMessenger->addErrorMessage('Có lỗi xảy ra');
            return $this->redirect()->toRoute('subject', [
                        'action' => 'index',
                        'id' => $subject->typeS,
            ]);
        }
    }

    public function deleteAction() {
        $id = (int) $this->params()->fromQuery('id', 0);
        if ($id == 0) {
            exit('invalid acc');
        }
        try {
            $subject = $this->containerinterface->get(\Subject\Model\SubjectTable::class)->getRow($id);
        } catch (\Exception $e) {
            exit('Error with User table');
        }

        $this->containerinterface->get(\Subject\Model\SubjectTable::class)->delete($id);
        return $this->redirect()->toRoute('subject', [
                    'action' => 'index',
                    'id' => $subject->typeS,
        ]);
    }

    public function selectByType() {
        if (!$this->identity()) {
            return $this->redirect()->toRoute('login');
        }
        $listSubaward = $this->containerinterface->get(\Award\Model\AwardRepository::class)->findAll();
        $this->layout()->setVariable('listSub', $listSubaward);
        $type = (int) $this->params()->fromRoute('type', 0);
        return new ViewModel([
            'subjects' => $this->containerinterface->selectByType(['typeS' => $type]),
        ]);
    }

}
