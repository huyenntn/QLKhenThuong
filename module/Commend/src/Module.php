<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Commend;

use Zend\EventManager\EventInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module implements \Zend\ModuleManager\Feature\BootstrapListenerInterface, ConfigProviderInterface, ServiceProviderInterface {

    const VERSION = '3.0.3-dev';

    public function getConfig() {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function onBootstrap(EventInterface $e) {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function($e) {
            $controller = $e->getTarget();
            $controllerClass = get_class($controller);
            $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
            $config = $e->getApplication()->getServiceManager()->get('config');
            $action = $e->getRouteMatch()->getParam('action');
            if (isset($config['module_layouts'][$action])) {
            } elseif (isset($config['module_layouts'][$moduleNamespace])) {
                $controller->layout($config['module_layouts'][$moduleNamespace]);
            }
        }
                , 100);
        
    }

    public function getServiceConfig() {
        return [
            'factories'=>[
                Model\Commend::class=> Model\Factory\CommendFactory::class,
                Model\CommendRepository::class=> Model\Factory\CommendRepositoryFactory::class,
            ]
        ];
    }
   

    public function setFormToView($event)
    {
        $form = new Form\CommendForm();
        $viewModel = $event->getViewModel();
        $viewModel->setVariables(array(
            'form' => $form,
        ));
    }

}
