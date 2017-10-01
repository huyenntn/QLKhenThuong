<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Subject\Controller\Factory;

/**
 * Description of SubjectControllerFactory
 *
 * @author Ngoc
 */
class SubjectControllerFactory {
    public function __invoke(\Interop\Container\ContainerInterface $containerinterface) {
        return new \Subject\Controller\SubjectController($containerinterface);
    }
}
