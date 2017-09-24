<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Interop\Container\ContainerInterface;
use Auth\Form\LoginFrom;
use Zend\View\Model\ViewModel;

/**
 * Description of LoginController
 *
 * @author Ngoc
 */
class LoginController extends AbstractActionController {

    public $containerinterface;

    public function __construct(ContainerInterface $containerinterface) {
        $this->containerinterface = $containerinterface;
    }

    public function loginAction() {
        $form = $this->containerinterface->get(LoginFrom::class);
        if ($this->params()->fromPost()) {
            
        }
        $viewModel = new ViewModel(['form' => $form,]);
        $viewModel->setTerminal(TRUE);
        return $viewModel;
    }

}
