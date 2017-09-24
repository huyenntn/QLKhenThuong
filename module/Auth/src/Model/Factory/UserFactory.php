<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Auth\Model\Factory;
use Auth\Model\User;
/**
 * Description of UserFactory
 *
 * @author Ngoc
 */
class UserFactory {
    public function __invoke(\Interop\Container\ContainerInterface $containerinterface) {
        return new User();
    }
}
