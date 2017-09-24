<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Auth;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module  implements ConfigProviderInterface, ServiceProviderInterface{

    const VERSION = '3.0.3-dev';

    public function getConfig() {
        return include __DIR__ . '/../config/module.config.php';
    }


    public function getServiceConfig() {
        return [
            'factories' => [
            Model\User::class => Model\Factory\UserFactory::class,
            Model\UserRepository::class => Model\Factory\UserRepositoryFactory::class,
            Form\LoginFrom::class => Form\Factory\LoginFormFactory::class,
            Form\LoginFilter::class => Form\Factory\LoginFilterFactory::class
            ]
        ];
    }

}
