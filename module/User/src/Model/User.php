<?php
namespace User\Model;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class User
{
    public $acc;
    public $name;
    public $pass;
    
    public function exchangeArray(array $data)
    {
        $this->acc = !empty($data['acc'])?$data['acc']:NULL;
        $this->name = !empty($data['name'])?$data['name']:NULL;
        $this->pass = !empty($data['pass'])?$data['pass']:NULL;
    }
    public function getArrayCopy()
    {
        return [
            'acc' => $this->acc,
            'name' => $this->name,
            'pass' => $this->pass
        ];
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
