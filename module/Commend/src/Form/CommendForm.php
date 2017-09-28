<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Commend\Form;

use Zend\Form\Form;
/**
 * Description of CommendForm
 *
 * @author Ngoc
 */
class CommendForm extends Form{
    public function __construct($name = null) {
        parent::__construct('commend');
        $this->setAttribute('method', 'POST');
        $this->setAttribute('class','col-md-4 col-md-offset-4');
        
        $this->add([
            'name' => 'idCmd',
            'type' => 'text',
            'options' => [
                'label' => 'idCmd ',
            ],
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required'
            ]
        ]);
        $this->add([
            'name' => 'idS',
            'type' => 'select',
            'options' => [
                'label' => 'Họ tên cá nhân/Tập thể ',
            ],
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required'
            ]
        ]);
        $this->add([
            'name' => 'idSubAward',
            'type' => 'select',
            'options' => [
                'label' => 'Hình thức khen thưởng',
            ],
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required'
            ]
        ]);
        $this->add([
            'name' => 'year',
            'type' => 'select',
            'options' => [
                'label' => 'Năm',
                'value_options' => [
                    '2013' => '2013',
                    '2014' => '2014',
                    '2015' => '2015',
                    '2016' => '2016',
                    '2017' => '2017',
                ]
            ],
            'attributes' => [
                'class' => 'form-control'
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
        
    }
}
