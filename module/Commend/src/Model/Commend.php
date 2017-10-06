<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Commend\Model;

/**
 * Description of Commend
 *
 * @author Ngoc
 */
class Commend {
    public $idCmd;
    public $idS;
    public $idSubAward;
    public $year;
    public $subAwardName;
    public $institute;
    public $nameS;
    public $nameF;
    public $awardName;
    
    public function exchangeArray(array $data)
    {
        $this->idCmd = !empty($data['idCmd'])?$data['idCmd']:NULL;
        $this->idS = !empty($data['idS'])?$data['idS']:NULL;
        $this->idSubAward = !empty($data['idSubAward'])?$data['idSubAward']:NULL;
        $this->year = !empty($data['year'])?$data['year']:NULL;
        $this->subAwardName = !empty($data['subAwardName'])?$data['subAwardName']:NULL;
        $this->institute = !empty($data['institute'])?$data['institute']:NULL;
        $this->nameS = !empty($data['nameS'])?$data['nameS']:NULL;
        $this->nameF = !empty($data['nameF'])?$data['nameF']:NULL;
        $this->awardName = !empty($data['awardName'])?$data['awardName']:NULL;
        
    }
    public function getArrayCopy()
    {
        return [
            'idCmd' => $this->idCmd,
            'idS' => $this->idS,
            'idSubAward' => $this->idSubAward,
            'year' => $this->year,
            'subAwardName' => $this->subAwardName,
            'institute' => $this->institute,
            'nameS' => $this->nameS,
            'nameF' => $this->nameF,
            'awardName' => $this->awardName,
        ];
    }
    
}
