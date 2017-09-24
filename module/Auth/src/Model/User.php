<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Auth\Model;

/**
 * Description of User
 *
 * @author Ngoc
 */
class User {
    public $id;
    public $acc;
    public $name;
    public $pass;
    public function exchangeArray(array $option=[]){
        $hidrator = new \Zend\Hydrator\ClassMethods();
        $hidrator->hydrate($option, $this);
    }
    public function getArrayCopy()
    {
        return [
            'id' => $this->id,
            'acc' => $this->acc,
            'name' => $this->name,
            'pass' => $this->pass
        ];
    }
    function getId() {
        return $this->id;
    }

    function getAcc() {
        return $this->acc;
    }

    function getName() {
        return $this->name;
    }

    function getPass() {
        return $this->pass;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setAcc($acc) {
        $this->acc = $acc;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }


}
