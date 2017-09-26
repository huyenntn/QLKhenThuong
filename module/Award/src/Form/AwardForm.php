<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Award\Form;

use Zend\Form\Form;
/**
 * Description of AddUserForm
 *
 * @author Ngoc
 */
class AwardForm extends Form 
{
    public function __construct($name = null) {
        parent::__construct('award');
        $this->setAttribute('method', 'POST');
        $this->setAttribute('class','col-md-4 col-md-offset-4');
        
        $this->add([
            'name' => 'awardName',
            'type' => 'text',
            'options' => [
                'label' => 'Loại khen thưởng',
            ],
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required'
            ]
        ]);
        
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'id' => 'btnLogin',
                'class' => 'btn btn-success'
            ]
        ]);
        $this->add([
            'name' => 'id',
            'type' => 'text',
            'options' => [
                'label' => 'ID'
            ],
            'attributes' => [
                'class' => 'form-control'
            ]
        ]);
    }
}
