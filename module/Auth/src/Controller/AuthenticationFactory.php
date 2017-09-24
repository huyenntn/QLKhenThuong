<?php

namespace Auth\Service;

use Auth\Model\MyAuthStorage;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;

class AuthenticationFactory
{
    public function __invoke($container)
    {
        $storage = new MyAuthStorage();
        $dbAdapter = $container->get('Zend\Db\Adapter\Adapter');
        $dbTableAuthAdapter  = new DbTableAuthAdapter($dbAdapter, 'user','acc','pass', 'MD5(?)');
        
        $authService = new AuthenticationService();
        $authService->setAdapter($dbTableAuthAdapter);
        $authService->setStorage($storage);
                
        return $authService;
    }
}
