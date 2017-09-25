<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Auth\Form\Factory;
use Auth\Form\LoginForm;
use Interop\Container\ContainerInterface;
/**
 * Description of LoginFormFactory
 *
 * @author Ngoc
 */
class LoginFormFactory {
    public function __invoke(ContainerInterface $containerinterface) {
        return new LoginForm($containerinterface);
    }
}
