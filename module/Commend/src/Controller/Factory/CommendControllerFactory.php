<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Commend\Controller\Factory;

use Interop\Container\ContainerInterface;
/**
 * Description of CommendControllerFactory
 *
 * @author Ngoc
 */
class CommendControllerFactory {
    public function __invoke(ContainerInterface $containerinterface) {
        return new \Commend\Controller\CommendController($containerinterface);
    }
}
