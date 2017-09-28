<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Commend\Model\Factory;

/**
 * Description of CommendRepositoryFactory
 *
 * @author Ngoc
 */
class CommendRepositoryFactory {
    public function __invoke(\Interop\Container\ContainerInterface $containerinterface) {
        $resultSet = new \Zend\Db\ResultSet\ResultSet();
        $resultSet->setArrayObjectPrototype(new \Commend\Model\Commend());
        return new \Commend\Model\CommendRepository(new \Zend\Db\TableGateway\TableGateway('commend', $containerinterface->get(\Zend\Db\Adapter\AdapterInterface::class),null,$resultSet));
    }
}
