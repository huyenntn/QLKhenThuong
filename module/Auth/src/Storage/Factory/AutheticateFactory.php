<?php
/**
 * Created by PhpStorm.
 * User: Ale
 * Date: 29/12/2016
 * Time: 11:23
 */

namespace Auth\Storage\Factory;


use Auth\Storage\Authenticate;
use Auth\Storage\AuthStorage;
use Interop\Container\ContainerInterface;

use Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter as AuthAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\Db\Adapter\AdapterInterface;

class AutheticateFactory
{

    public function __invoke(ContainerInterface $container)
    {
        // Configure the instance with constructor parameters:
        $dbAdapter =$container->get(AdapterInterface::class);
        $dbTableAuthAdapter = new AuthAdapter($dbAdapter,
            'user',
            'acc',
            'pass',
            "MD5('123456') AND level = 1");
        $authService = new AuthenticationService();
        $authService->setAdapter($dbTableAuthAdapter);
        $authService->setStorage(new AuthStorage());
        return new Authenticate($authService);
    }
}