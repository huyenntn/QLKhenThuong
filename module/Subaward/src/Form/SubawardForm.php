<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Subaward\Form;

use Zend\Form\Form;

/**
 * Description of AddUserForm
 *
 * @author Ngoc
 */
class SubawardForm extends Form {

    public function __construct($name = null) {
        parent::__construct('subaward');
        $this->setAttribute('method', 'POST');
        $this->setAttribute('class', 'col-md-4 col-md-offset-4');

        $this->add([
            'name' => 'subAwardName',
            'type' => 'text',
            'options' => [
                'label' => 'Khen thưởng',
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
        $this->add([
            'name' => 'awardId',
            'type' => 'select',
            'options' => [
                'label' => 'Loại khen thưởng',
                'value_options' => [
                    
                ]
            ],
            'attributes' => [
                'class' => 'form-control'
            ]
        ]);
        $this->add([
            'name' => 'institute',
            'type' => 'select',
            'options' => [
                'label' => 'Loại tổ chức',
                'value_options' => [
                    '3' => 'Không',
                    '1' => 'Cá nhân',
                    '2' => 'Tập thể',
                ]
            ],
            'attributes' => [
                'class' => 'form-control'
            ]
        ]);
    }

}
