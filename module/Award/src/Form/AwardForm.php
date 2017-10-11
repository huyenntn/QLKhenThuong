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
                
            ],
            'attributes' => [
                'class' => 'form-control text-input input-sm',
                'required' => 'required',
                'label' => 'Tên danh mục',
            ]
        ]);
        
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'id' => 'btnLogin',
                'class' => 'btn btn-primary submit-button btn-sm'
            ]
        ]);
        $this->add([
            'name' => 'id',
            'type' => 'text',
            'options' => [
                'label' => 'ID'
            ],
            'attributes' => [
                'class' => 'form-control input-sm'
            ]
        ]);
    }
}
