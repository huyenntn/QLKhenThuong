<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User\Form;

use Zend\Form\Form;
/**
 * Description of LoginFrom
 *
 * @author Ngoc
 */
class LoginFrom extends Form
{
    public function __construct($name = null) {
        parent::__construct('user');
        $this->setAttribute('method', 'POST');
        $this->setAttribute('role', 'login');


        $this->add([
            'name' => 'acc',
            'type' => 'text',
            'attributes' => [
                'class' => 'form-control input-lg input-login',
                'placeholder' => 'Tên đăng nhập',
                'required' => 'required'
            ]
        ]);
        $this->add([
            'name' => 'pass',
            'type' => 'text',
            'attributes' => [
                'class' => 'form-control input-lg input-login',
                'placeholder' => 'Mật khẩu',
                'required' => 'required'
            ]
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'class' => 'btn btn-block btn-success btn-lg',
                'value' => 'Đăng nhập',
                'id' => 'btnLogin'
            ]
        ]);
    }
}
