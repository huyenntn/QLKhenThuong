<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Subaward\Model\Factory;

/**
 * Description of AwardRepository
 *
 * @author Ngoc
 */
use Interop\Container\ContainerInterface;
use Zend\Db\ResultSet\ResultSet;
use Subaward\Model\Subaward;
use Subaward\Model\SubawardRepository;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\AdapterInterface;
class SubawardRepositoryFactory {
    public function __invoke(ContainerInterface $containerinterfacw) {
        $resultProtype = new ResultSet();
        $resultProtype->setArrayObjectPrototype(new Subaward());
        return new SubawardRepository(new TableGateway('subaward', $containerinterfacw->get(AdapterInterface::class),null,$resultProtype));
    }
}
