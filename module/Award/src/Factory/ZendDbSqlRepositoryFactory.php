<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Award\Factory;

/**
 * Description of ZendDbSqlRepositoryFactory
 *
 * @author Ngoc
 */
use Interop\Container\ContainerInterface;
use Award\Model\Award;
use Award\Model\ZendDbSqlRepository;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Hydrator\Reflection as ReflectionHydrator;
use Zend\ServiceManager\Factory\FactoryInterface;
use Award\Model\ZendDbSqlRepository;

class ZendDbSqlRepositoryFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return ZendDbSqlRepository
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new ZendDbSqlRepository(
            $container->get(AdapterInterface::class),
            new ReflectionHydrator(),
            new Award('', '')
        );
    }
}
    
