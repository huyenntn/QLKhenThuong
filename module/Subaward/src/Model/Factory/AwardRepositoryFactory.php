<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Award\Model\Factory;

/**
 * Description of AwardRepository
 *
 * @author Ngoc
 */
use Interop\Container\ContainerInterface;
use Zend\Db\ResultSet\ResultSet;
use Award\Model\Award;
use Award\Model\AwardRepository;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\AdapterInterface;
class AwardRepositoryFactory {
    public function __invoke(ContainerInterface $containerinterfacw) {
        $resultProtype = new ResultSet();
        $resultProtype->setArrayObjectPrototype(new Award());
        return new AwardRepository(new TableGateway('award', $containerinterfacw->get(AdapterInterface::class),null,$resultProtype));
    }
}
