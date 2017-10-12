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

namespace Subaward\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;

class SubawardRepository extends AbstractTableGateway {

    public $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function getRow($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (!$row) {
            throw new \Zend\Db\Exception\RuntimeException(\sprintf(
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
        return $this->tableGateway->select();
    }
    
    public function fetchByType($where){
        $sqlSelect = $this->tableGateway->getSql()
                ->select()
                ->where(['institute' => $where])
                ->order(['subAwardName ASC']);
        return $this->tableGateway->selectWith($sqlSelect);
    }

    public function saveRow(Subaward $subaward) {
        $data = [
            'subAwardName' => $subaward->subAwardName,
            'awardId' => $subaward->awardId,
            'institute' => $subaward->institute,
        ];
        if ($subaward->id) {
            $this->tableGateway->update($data, [
                'id' => $subaward->id
            ]);
        } else {
            $this->tableGateway->insert($data);
        }
    }

    public function JoinfetchAll($where) {
        $sqlSelect = $this->tableGateway->getSql()
                ->select()
                ->where(['awardId' => $where])
                ->join('award', 'award.id = subaward.awardId', array('awardName'), 'left');
        return $this->tableGateway->selectWith($sqlSelect);
    }

}
