<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Award\Model;

class Award{
    public $id;
    public $awardName;
    public function exchangeArray (array $data){
        $this->id = !empty($data['id'])?$data['id']:NULL;
        $this->awardName = !empty($data['awardName'])?$data['awardName']:NULL;
    }
    public function getArrayCopy(){
        return [
            'id' => $this->id,
            'awardName' => $this->awardName
        ];
    }
}
