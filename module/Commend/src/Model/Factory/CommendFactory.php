<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Commend\Model\Factory;

/**
 * Description of CommendFactory
 *
 * @author Ngoc
 */
class CommendFactory {
    public function __invoke(\Interop\Container\ContainerInterface $containerinterface) {
        return new \Commend\Model\Commend();
    }
}
