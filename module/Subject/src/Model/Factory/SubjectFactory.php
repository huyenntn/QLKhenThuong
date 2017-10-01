<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Subject\Model\Factory;

/**
 * Description of SubjectFactory
 *
 * @author Ngoc
 */
class SubjectFactory {
    public function __invoke(\Interop\Container\ContainerInterface $containerinterface) {
        return new \Subject\Model\Subject();
    }
}
