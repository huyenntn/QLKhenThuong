<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AwardTable
 *
 * @author Ngoc
 */
namespace Award\Model;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;
class AwardRepository extends AbstractTableGateway{
    public $tableGateway;
 
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    public function getRow($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (!$row) {
            throw new RuntimeException(\sprintf(
                    'Could not find row with identifier %d', $id
            ));
        }
        return $row;
    }

    public function delete($id) {
        return $this->tableGateway->delete(['id' => (int) $id]);
    }

    public function getTable() {
        return $this->tableGateway->getTable();
    }

    public function insert($set) {
        $this->tableGateway->insert($set);
        return $this->tableGateway->getLastInsertValue();
    }

    public function select($where = null) {
        return $this->tableGateway->select($where);
    }

    public function update($set, $where = null) {
        return $this->tableGateway->update($set, $where);
    }

    public function findAll() {
        $sqlSelect = $this->tableGateway->getSql()
                ->select()
                ->order('id ASC');
        return $this->tableGateway->selectWith($sqlSelect);
        
        
        return $this->tableGateway->select();
    }

    public function saveRow(Award $award) {
        $data = [
            'awardName' => $award->awardName
        ];
        if ($award->id) {
            $this->tableGateway->update($data, [
                'id' => $award->id
            ]);
        } else {
            $this->tableGateway->insert($data);
        }
    }
}
