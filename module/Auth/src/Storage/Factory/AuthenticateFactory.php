<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Auth\Storage\Factory;

use Interop\Container\ContainerInterface;
use Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter as AuthAdapter;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Authentication\AuthenticationService;
use Auth\Storage\AuthStorage;
use Auth\Storage\Authenticate;
/**
 * Description of AuthenticateFactory
 *
 * @author Ngoc
 */
class AuthenticateFactory {
    public function __invoke(ContainerInterface $container) {
        $dbAdapter =$container->get(AdapterInterface::class);
        $dbTableAuthAdapter = new AuthAdapter($dbAdapter,
            'user',
            'acc',
            'pass',
            "MD5('123') AND level = 1");
        $authService = new AuthenticationService();
        $authService->setAdapter($dbTableAuthAdapter);
        $authService->setStorage(new AuthStorage());
        return new Authenticate($authService);
    }
}
