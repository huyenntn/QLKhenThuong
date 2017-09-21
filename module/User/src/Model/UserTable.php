<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace User\Model;
use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class UserTable
{
    public $tableGateway;
    
    public function __construct(TableGatewayInterface $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
    
    public function fetchAllUser(){
        return $this->tableGateway->select();
    }
    
    public function getUser($acc){
        $acc = (string) $acc;
        $rowset = $this->tableGateway->select(['acc' => $acc]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(\sprintf(
                'Could not find row with identifier %d',
                $acc
            ));
        }
        return $row;
    }
    
    public function saveUser(User $user)
    {
        $data = [
            'acc' => $user->acc,
            'name'  => $user->name,
            'pass'  => $user->pass,
        ];
        
        if($user->acc){
            $this->tableGateway->update($data,[
                'acc' => $user->acc
            ]);
        } else {
            $this->tableGateway->insert($data);
            return $this->getUser($user->acc);
        }
    }
    
    public function deleteUser($acc)
    {
        return $this->tableGateway->delete(['acc' => (string) $acc]);
    }
    public function selectByAcc($where)
    {
        return $this->tableGateway->select($where);
    }
}