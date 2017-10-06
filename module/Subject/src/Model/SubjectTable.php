<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Subject\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\DbTableGateway;

class SubjectTable extends AbstractTableGateway {

    public $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll($paginated = false) {
        return $this->tableGateway->select();
    }

    public function getRow($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['idS' => $id]);
        $row = $rowset->current();
        if (!$row) {
            throw new RuntimeException(\sprintf(
                    'Could not find row with identifier %d', $id
            ));
        }
        return $row;
    }

    public function saveRow(Subject $subject) {
        $data = [
            'nameS' => $subject->nameS,
            'email' => $subject->email,
            'typeS' => $subject->typeS,
        ];

        if ($subject->idS) {
            $this->tableGateway->update($data, [
                'idS' => $subject->idS
            ]);
        } else {
            $this->tableGateway->insert($data);
//            return $this->getUser($user->id);
        }
    }

    public function delete($id) {
        return $this->tableGateway->delete(['idS' => $id]);
    }

    public function selectByType($where, $paginated = false) {
        if ($paginated) {
            $sql = $this->tableGateway->getSql();
            $select = $sql->select();
            $select->where(['typeS' => $where]);
            $select->order('nameS ASC');
            $adapter = new \Zend\Paginator\Adapter\DbSelect($select, $sql);
            $paginator = new \Zend\Paginator\Paginator($adapter);
            return $paginator;
        }

        $sqlSelect = $this->tableGateway->getSql()
                ->select()
                ->where(['typeS' => $where]);
        return $this->tableGateway->selectWith($sqlSelect);
    }

}
