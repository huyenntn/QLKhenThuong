<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Award\Controller;

/**
 * Description of CommonServiceFactory
 *
 * @author Ngoc
 */
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
class CommonServiceFactory implements FactoryInterface
{
    protected $controller;
     
    public function createService(ServiceLocatorInterface $services)
    {
        $serviceLocator = $services->getServiceLocator();
        $dbAdapter      = $serviceLocator->get('Zend\Db\Adapter\Adapter');
         
        $controller = new $this->controller;
        $controller->setDbAdapter($dbAdapter);
         
        return $controller;
    }
     
    //setter controller 
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, mixed $options = null): object {
        
    }
}