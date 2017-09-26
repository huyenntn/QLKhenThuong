<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Subaward\Model;

class Subaward{
    public $id;
    public $subAwardName;
    public $awardId;
    public $awardName;
    public $institute;
    public function exchangeArray (array $data){
        $this->id = !empty($data['id'])?$data['id']:NULL;
        $this->subAwardName = !empty($data['subAwardName'])?$data['subAwardName']:NULL;
        $this->awardId = !empty($data['awardId'])?$data['awardId']:NULL;
        $this->awardName = !empty($data['awardName'])?$data['awardName']:NULL;
        $this->institute = !empty($data['institute'])?$data['institute']:NULL;
    }
    public function getArrayCopy(){
        return [
            'id' => $this->id,
            'subAwardName' => $this->subAwardName,
            'awardId' => $this->awardId,
            'awardName' => $this->awardName,
            'institute' => $this->institute,
        ];
    }
}
