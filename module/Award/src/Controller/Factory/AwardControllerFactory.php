<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Award\Controller\Factory;

use Interop\Container\ContainerInterface;
use Award\Controller\AwardController;
/**
 * Description of AwardControllerFactory
 *
 * @author Ngoc
 */
class AwardControllerFactory {
    //put your code here
    public function __invoke(ContainerInterface $container){
        return new AwardController($container);
    }

}
