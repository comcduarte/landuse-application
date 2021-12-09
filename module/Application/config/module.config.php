<?php

declare(strict_types=1);

namespace Application;

use Application\Controller\ConfigController;
use Application\Controller\Factory\ApplicationTypeControllerFactory;
use Application\Controller\Factory\ConfigControllerFactory;
use Application\Form\ApplicationForm;
use Application\Form\ApplicationTypeForm;
use Application\Form\Factory\ApplicationFormFactory;
use Application\Service\Factory\ModelAdapterFactory;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Application\Controller\ApplicationController;
use Application\Controller\Factory\ApplicationControllerFactory;
use Application\Controller\Factory\ParcelControllerFactory;
use Application\Controller\Factory\ZoneDesignationControllerFactory;
use Application\Form\ZoneDesignationForm;
use Application\Form\ParcelForm;
use Application\Form\Factory\ParcelFormFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:controller[/:action[/:uuid]]]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                    'constraints' => [
                        'uuid' => '[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}',
                    ],
                ],
            ],
            'config' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/config[/:action]',
                    'defaults' => [
                        'controller' => Controller\ConfigController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'lists' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/lists[/:controller[/:action[/:uuid]]]',
                    'defaults' => [
                        'action'     => 'index',
                    ],
                    'constraints' => [
                        'uuid' => '[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}',
                    ],
                ],
            ],
        ],
    ],
    'acl' => [
        'EVERYONE' => [
            'home' => ['index'],
        ],
        'admin' => [
            'config' => [],
            'lists' => [],
            'application' => [],
        ],
    ],
    'controllers' => [
        'aliases' => [
            'application' => ApplicationController::class,
        ],
        'factories' => [
            ApplicationController::class => ApplicationControllerFactory::class,
            Controller\IndexController::class => InvokableFactory::class,
            'applicationtype' => ApplicationTypeControllerFactory::class,
            ConfigController::class => ConfigControllerFactory::class,
            'parcel' => ParcelControllerFactory::class,
            'zonedesignation' => ZoneDesignationControllerFactory::class,
        ],
    ],
    'form_elements' => [
        'factories' => [
            ApplicationForm::class => ApplicationFormFactory::class,
            ApplicationTypeForm::class => InvokableFactory::class,
            ParcelForm::class => ParcelFormFactory::class,
            ZoneDesignationForm::class => InvokableFactory::class,
        ],
    ],
    'log' => [
        'syslogger' => [
            'writers' => [
                'syslog' => [
                    'name' => \Laminas\Log\Writer\Syslog::class,
                    'priority' => \Laminas\Log\Logger::INFO,
                    'options' => [
                        'application' => 'LANDUSE',
                    ],
                ],
            ],
        ],
    ],
    'navigation' => [
        'default' => [
            'home' => [
                'label' => 'Home',
                'route' => 'home',
                'order' => 0,
            ],
            'applications' => [
                'label' => 'Applications',
                'route' => 'application',
                'class' => 'dropdown',
                'order' => 100,
                'pages' => [
                    'create' => [
                        'label'  => 'Add Application',
                        'route'  => 'application',
                        'controller' => 'application',
                        'action' => 'create',
                        'resource' => 'application',
                        'privilege' => 'create',
                    ],
                ],
            ],
            'lists' => [
                'label' => 'Lists',
                'route' => 'lists',
                'class' => 'dropdown',
                'order' => 100,
                'pages' => [
                    'application-type' => [
                        'label'  => 'Application Types',
                        'route'  => 'lists',
                        'resource' => 'lists',
                        'privilege' => 'index',
                        'class' => 'dropdown-submenu',
                        'pages' => [
                            'application-type-create' => [
                                'label'  => 'Add Application Types',
                                'route'  => 'lists',
                                'controller' => 'applicationtype',
                                'action' => 'create',
                                'resource' => 'lists',
                                'privilege' => 'create',
                            ],
                            'application-type-list' => [
                                'label'  => 'List Application Types',
                                'route'  => 'lists',
                                'controller' => 'applicationtype',
                                'action' => 'index',
                                'resource' => 'lists',
                                'privilege' => 'index',
                            ],
                        ],
                    ],
                    'zone-designation' => [
                        'label'  => 'Zone Designations',
                        'route'  => 'lists',
                        'resource' => 'lists',
                        'privilege' => 'index',
                        'class' => 'dropdown-submenu',
                        'pages' => [
                            'zone-designation-create' => [
                                'label'  => 'Add Zone Designation',
                                'route'  => 'lists',
                                'controller' => 'zonedesignation',
                                'action' => 'create',
                                'resource' => 'lists',
                                'privilege' => 'create',
                            ],
                            'zone-designation-list' => [
                                'label'  => 'List Zone Designations',
                                'route'  => 'lists',
                                'controller' => 'zonedesignation',
                                'action' => 'index',
                                'resource' => 'lists',
                                'privilege' => 'index',
                            ],
                        ],
                    ],
                ],
            ],
            'settings' => [
                'label' => 'Settings',
                'route' => 'home',
                'class' => 'dropdown',
                'order' => 100,
                'pages' => [
                    'application-config' => [
                        'label'  => 'Application Settings',
                        'route'  => 'config',
                        'action' => 'index',
                        'resource' => 'config',
                        'privilege' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'aliases' => [
        ],
        'factories' => [
            'model-adapter' => ModelAdapterFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'navigation'              => __DIR__ . '/../view/partials/navigation.phtml',
            'flashmessenger'          => __DIR__ . '/../view/partials/flashmessenger.phtml',
            'layout/layout'           => __DIR__ . '/../../User/view/layout/user-layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
