<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Auth\Controller\Factory;
use Interop\Container\ContainerInterface;
use Auth\Controller\LoginController;
/**
 * Description of LoginControllerFactory
 *
 * @author Ngoc
 */
class LoginControllerFactory {
    public function __invoke(ContainerInterface $containerinterface) {
        return new LoginController($containerinterface);
    }
}
