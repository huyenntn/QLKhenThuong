<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Auth\Form\Factory;

/**
 * Description of LoginFilterFactory
 *
 * @author Ngoc
 */
use Interop\Container\ContainerInterface;
use Auth\Form\LoginFilter;
class LoginFilterFactory {
    public function __invoke(ContainerInterface $containerinterface) {
        return new LoginFilter($containerinterface);
    }
}
