<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Auth\Form;

use Zend\Form\Form;
use Interop\Container\ContainerInterface;
use Auth\Form\LoginFilter;
/**
 * Description of LoginFrom
 *
 * @author Ngoc
 */
class LoginFrom extends Form
{
    public function __construct(ContainerInterface $containerinterface, $name = "login", array $options=[]) {
        parent::__construct($name,$options);
        $this->setInputFilter($containerinterface->get(LoginFilter::class));
        $this->setAttribute('method', 'POST');
        $this->setAttribute('role', 'login');
        $this->setAttribute('action', 'login');


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
            'type' => 'password',
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
