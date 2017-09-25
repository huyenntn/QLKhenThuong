<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Auth;

use Auth\Form\Factory\LoginFilterFactory;
use Auth\Form\Factory\LoginFormFactory;
use Auth\Form\LoginFilter;
use Auth\Form\LoginForm;
use Auth\Model\Factory\UserRepositoryFactory;
use Auth\Model\Factory\UserFactory;
use Auth\Model\User;
use Auth\Model\UserRepository;
use Auth\Storage\Authenticate;
use Auth\Storage\Factory\AuthenticateFactory;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
class Module implements ConfigProviderInterface, ServiceProviderInterface
{
    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__.'/../config/module.config.php';
    }
    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        return [
            'factories'=>[
                LoginForm::class=>LoginFormFactory::class,
                LoginFilter::class=>LoginFilterFactory::class,
                User::class=>UserFactory::class,
                UserRepository::class=>UserRepositoryFactory::class,
                Authenticate::class=>AuthenticateFactory::class
            ]
        ];
    }
}