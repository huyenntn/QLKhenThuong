<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Auth\Model\Factory;
use Interop\Container\ContainerInterface;
use Auth\Model\UserRepository;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Auth\Model\User;
/**
 * Description of UserRepositoryFactory
 *
 * @author Ngoc
 */
class UserRepositoryFactory {
    public function __invoke(ContainerInterface $containerinterface) {
        $resultProtype = new ResultSet();
        $resultProtype->setArrayObjectPrototype(new User());
        return new UserRepository(new TableGateway('user', $containerinterface->get(AdapterInterface::class),null,$resultProtype));
    }
}
