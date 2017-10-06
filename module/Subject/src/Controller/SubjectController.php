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

class SubjectController extends AbstractActionController {

    private $containerinterface;

    function __construct(ContainerInterface $containerinterface) {
        $this->containerinterface = $containerinterface;
    }

    public function indexAction() {
        if (!$this->identity()) {
            return $this->redirect()->toRoute('login');
        }
        $id = (int) $this->params()->fromRoute('id', 0);
        $listSubaward = $this->containerinterface->get(\Award\Model\AwardRepository::class)->findAll();
        $this->layout()->setVariable('listSub', $listSubaward);
        $paginator = $this->containerinterface->get(\Subject\Model\SubjectTable::class)->selectByType($id,true);
        // set the current page to what has been passed in query string, or to 1 if none set
        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        // set the number of items per page to 10
        $paginator->setItemCountPerPage(10);

        return new ViewModel(array(
            'paginator' => $paginator,
            'type' => $id,
        ));
    }

    public function addAction() {
        if (!$this->identity()) {
            return $this->redirect()->toRoute('login');
        }
        $listSubaward = $this->containerinterface->get(\Award\Model\AwardRepository::class)->findAll();
        $this->layout()->setVariable('listSub', $listSubaward);
        $type = (int) $this->params()->fromQuery('type', 0);
        $form = new SubjectForm();
        $form->get('submit')->setAttribute('class', 'btn btn-danger');
        $form->get('submit')->setAttribute('value', 'Lưu');
        $form->get('typeS')->setAttribute('value', $type);
        $form->get('typeS')->setAttribute('type', 'hidden');
        $request = $this->getRequest();
        if (!$request->isPost()) {
            $viewModel = new ViewModel([
                'form' => $form
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

        return $this->redirect()->toRoute('subject', [
                    'action' => 'index',
                    'id' => $subject->typeS,
        ]);
    }

    public function editAction() {
        $id = (int) $this->params()->fromQuery('id', 0);
      
        if ($id == 0) {
            exit('invalid accccc');
        }
        try {
            $subject = $this->containerinterface->get(\Subject\Model\SubjectTable::class)->getRow($id);
        } catch (\Exception $e) {
            exit('Error with User table');
        }
        $form = new SubjectForm();
        $form->get('idS')->setAttribute('type', 'hidden');
        $form->get('submit')->setAttribute('value', 'Lưu');

        $form->bind($subject);
        $form->get('typeS')->setAttribute('type', 'hidden');
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
        $this->containerinterface->get(\Subject\Model\SubjectTable::class)->saveRow($subject);
        return $this->redirect()->toRoute('subject', [
                    'action' => 'index',
                    'id' => $subject->typeS,
        ]);
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
        $type = (int) $this->params()->fromRoute('type', 0);
        return new ViewModel([
            'subjects' => $this->containerinterface->selectByType(['typeS' => $type]),
        ]);
    }

}