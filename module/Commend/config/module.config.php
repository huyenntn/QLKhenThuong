<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Commend;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Commend\Controller\CommendController;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => CommendController::class,
                        'action'     => 'listbytype',
                        'type' => 1,
                    ],
                ],
            ],
            'commend' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/commend[/:action[/:type[/:id[/:page]]]]',
                    'defaults' => [
                        'controller' => CommendController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            CommendController::class => \Commend\Controller\Factory\CommendControllerFactory::class,
            
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/admin.phtml',
            'commend/index/index' => __DIR__ . '/../view/commend/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => array('ViewJsonStrategy',),
    ],
    
];
