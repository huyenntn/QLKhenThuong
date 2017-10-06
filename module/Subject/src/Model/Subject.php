<?php
namespace Subject\Model;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Subject 
{
    public $idS;
    public $nameF;
    public $nameS;
    public $email;
    public $typeS;

    public function exchangeArray(array $data)
    {
        $this->idS = !empty($data['idS'])?$data['idS']:NULL;
        $this->nameF = !empty($data['nameF'])?$data['nameF']:NULL;
        $this->nameS = !empty($data['nameS'])?$data['nameS']:NULL;
        $this->email = !empty($data['email'])?$data['email']:NULL;
        $this->typeS = !empty($data['typeS'])?$data['typeS']:NULL;
    }
    public function getArrayCopy()
    {
        return [
            'idS' => $this->idS,
            'nameF' => $this->nameF,
            'nameS' => $this->nameS,
            'email' => $this->email,
            'typeS' => $this->typeS
        ];
    }
    

}
