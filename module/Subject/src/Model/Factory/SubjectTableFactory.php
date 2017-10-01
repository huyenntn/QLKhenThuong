<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Subject\Model\Factory;

use Interop\Container\ContainerInterface;
use Zend\Db\ResultSet\ResultSet;
use Subject\Model\Subject;
use Subject\Model\SubjectTable;
use Zend\Db\TableGateway\TableGateway;
/**
 * Description of SubjectTableFactory
 *
 * @author Ngoc
 */
class SubjectTableFactory {
    public function __invoke(ContainerInterface $containerinterfacw) {
        $resultProtype = new ResultSet();
        $resultProtype->setArrayObjectPrototype(new Subject());
        return new SubjectTable(new TableGateway('subject', $containerinterfacw->get(\Zend\Db\Adapter\AdapterInterface::class),null,$resultProtype));
    }
}
