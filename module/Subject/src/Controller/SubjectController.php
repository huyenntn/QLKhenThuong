<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Subject\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Subject\Model\SubjectTable;
use Subject\Form\SubjectForm;
use Subject\Model\Subject;

include "vendor/autoload.php";

class SubjectController extends AbstractActionController {

    public $subjectTable;
    public $authenticate;

    public function getAuthenticate() {
        return $this->authenticate;
    }

    function __construct(SubjectTable $subjectTable) {
        $this->subjectTable = $subjectTable;
    }

    public function indexAction() {
        $type = (int) $this->params()->fromRoute('type', 0);
        return new ViewModel([
            'subjects' =>  $this->subjectTable->selectByType(['typeS' => $type]),
        ]);
    }

    public function addAction() {
        $form = new SubjectForm();
        $form->get('submit')->setAttribute('class', 'btn btn-danger');
        $form->get('submit')->setAttribute('value', 'Lưu');
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
        $this->subjectTable->saveRow($subject);
        return $this->redirect()->toRoute('subject');
    }

    public function editAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        
        if ($id == 0) {
            exit('invalid acc');
        }
        try {
            $subject = $this->subjectTable->getRow($id);
        } catch (\Exception $e) {
            exit('Error with User table');
        }
        $form = new SubjectForm();
        $form->get('idS')->setAttribute('type', 'hidden');
        $form->get('submit')->setAttribute('value', 'Lưu');
        $form->bind($subject);
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
        $this->subjectTable->saveRow($subject);
        return $this->redirect()->toRoute('subject');
    }

    public function deleteAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id == 0) {
            exit('invalid acc');
        }
        try {
            $subject = $this->subjectTable->getRow($id);
        } catch (\Exception $e) {
            exit('Error with User table');
        }

        $this->subjectTable->delete($id);
        return $this->redirect()->toRoute('subject');
    }
    public function selectByType(){
        $type = (int) $this->params()->fromRoute('type', 0);
        return new ViewModel([
            'subjects' =>  $this->subjectTable->selectByType(['typeS' => $type]),
        ]);
        
    }

}
