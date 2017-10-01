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
        $this->setAttribute('class','col-md-4 col-md-offset-4 form');
        $this->setAttribute('id','form');
        
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
                'required' => 'required',
                'id' => 'idS'
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
                'required' => 'required',
                'id' => 'idSubAward',
            ]
        ]);
        $this->add([
            'name' => 'year',
            'type' => 'select',
            'options' => [
                'label' => 'Năm',
                'value_options' => [
                    '2001' => '2001',
                    '2002' => '2002',
                    '2003' => '2003',
                    '2004' => '2004',
                    '2005' => '2005',
                    '2006' => '2006',
                    '2007' => '2007',
                    '2008' => '2008',
                    '2009' => '2009',
                    '2010' => '2010',
                    '2011' => '2011',
                    '2012' => '2012',
                    '2013' => '2013',
                    '2014' => '2014',
                    '2015' => '2015',
                    '2016' => '2016',
                    '2017' => '2017',
                ]
            ],
            'attributes' => [
                'class' => 'form-control',
                'id' => 'year'
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
