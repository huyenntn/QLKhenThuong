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

class AwardController extends AbstractActionController
{
    private $container;
    function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function indexAction()
    {
        $this->layout('layout/award');
    }
}
