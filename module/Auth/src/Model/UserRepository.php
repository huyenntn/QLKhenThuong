<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Auth\Model;
use RuntimeException;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\TableGatewayInterface;

/**
 * Description of UserRepository
 *
 * @author Ngoc
 */
class UserRepository {

    public $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function getUser($id) {
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

    public function deleteUser($id) {
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

    public function saveUser(User $user) {
        $data = [
            'acc' => $user->acc,
            'name' => $user->name,
            'pass' => $user->pass,
        ];

        if ($user->id) {
            $this->tableGateway->update($data, [
                'acc' => $user->acc
            ]);
        } else {
            $this->tableGateway->insert($data);
//            return $this->getUser($user->id);
        }
    }
    
    public function getUserByAcc($where){
        $sqlSelect = $this->tableGateway->getSql()
                ->select()
                ->where(['acc' => $where]);
        return $this->tableGateway->selectWith($sqlSelect);
    }

}
