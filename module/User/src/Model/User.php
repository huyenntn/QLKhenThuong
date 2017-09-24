<?php
namespace User\Model;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class User
{
    public $id;
    public $acc;
    public $name;
    public $pass;
    protected $inputFilter;
    public function exchangeArray(array $data)
    {
        $this->id = !empty($data['id'])?$data['id']:NULL;
        $this->acc = !empty($data['acc'])?$data['acc']:NULL;
        $this->name = !empty($data['name'])?$data['name']:NULL;
        $this->pass = !empty($data['pass'])?$data['pass']:NULL;
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
    

}
