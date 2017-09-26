<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Subaward\Controller\Factory;
use Interop\Container\ContainerInterface;
/**
 * Description of AwardControllerFactory
 *
 * @author Ngoc
 */
class SubawardControllerFactory {
    public function __invoke(ContainerInterface $containerinterface) {
        return new \Subaward\Controller\SubawardController($containerinterface);
    }
}
