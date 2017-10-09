<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Subject\Form;

use Zend\Form\Form;
/**
 * Description of AddUserForm
 *
 * @author Ngoc
 */
class SubjectForm extends Form 
{
    public function __construct($name = null) {
        parent::__construct('subject');
        $this->setAttribute('method', 'POST');
        $this->setAttribute('class','col-md-4 col-md-offset-4');
        
        $this->add([
            'name' => 'nameF',
            'type' => 'text',
            'options' => [
                'label' => 'Họ và tên đệm',
            ],
            'attributes' => [
                'class' => 'form-control flexbox',
                'id' => 'nameF',
                'required' => 'required'
            ]
        ]);
        $this->add([
            'name' => 'nameS',
            'type' => 'text',
            'options' => [
                'label' => 'Tên',
            ],
            'attributes' => [
                'class' => 'form-control flexbox',
                'id' => 'nameS',
                'required' => 'required'
            ]
        ]);
        $this->add([
            'name' => 'email',
            'type' => 'text',
            'options' => [
                'label' => 'Email',
            ],
            'attributes' => [
                'class' => 'form-control flexbox',
                'required' => 'required',
                'id' => 'email'
            ]
        ]);
        $this->add([
            'name' => 'typeS',
            'type' => 'select',
            'options' => [
                'label' => 'Đối tượng',
                'value_options' => [
                    '1' => 'Cá nhân',
                    '2' => 'Tập thể',
                ]
            ],
            'attributes' => [
                'class' => 'form-control flexbox',
                'required' => 'required',
                'id' => 'typeS'
            ]
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'id' => 'btnLogin',
                'class' => 'btn btn-success flexbox'
            ]
        ]);
        $this->add([
            'name' => 'idS',
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
