<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Db\Sql\Select;

class UserTable {

    public $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAllUser() {
        return $this->tableGateway->select();
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

    public function deleteUser($id) {
        return $this->tableGateway->delete(['id' => (int) $id]);
    }

    public function selectByAcc($where) {
        return $this->tableGateway->select($where);
    }

    public function selectByAccAndPass($acc, $pass) {
        $resultSet = $this->tableGateway->select()->where(array('acc'=>$acc, 'pass'=>$pass));
        $row = $resultSet->current();
        if (!$row) {
            throw new Exception('No row found');
        }
        return $row;
    }

}
