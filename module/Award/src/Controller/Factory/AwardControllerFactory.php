<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Award\Controller\Factory;
use Interop\Container\ContainerInterface;
/**
 * Description of AwardControllerFactory
 *
 * @author Ngoc
 */
class AwardControllerFactory {
    public function __invoke(ContainerInterface $containerinterface) {
        return new \Award\Controller\AwardController($containerinterface);
    }
}
