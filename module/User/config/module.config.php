<?php

namespace User;

return array(
    'router' => array(
        'routes' => array(
                        
            'login' => array(
              'type' => 'Literal',
                'options' => array(
                    'route'=>'/login',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller' => 'Auth',
                        'action' => 'index'
                    )
                )
            ),
            
            'logout' => array(
              'type' => 'Literal',
                'options' => array(
                    'route'=>'/logout',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller' => 'Auth',
                        'action' => 'logout'
                    )
                )
            ),
            
            'user' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/users',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller' => 'Users',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/users/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '\d+'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'user\Controller',
                                'controller' => 'users'
                            )
                        )
                    ),
                    'paginator' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/page/:page',
                            'constraints' => array(
                                'page' => '\d+'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'user\Controller',
                                'controller' => 'users'
                            )
                        )
                    )
                )
            ),
                
                            
        )
    ),
    
    'controllers' => array(
        'invokables' => array(
            'user\Controller\Index' => 'User\Controller\IndexController',
            'user\Controller\Users' => 'User\Controller\UsersController',
            'user\Controller\Auth' => 'User\Controller\AuthController',
        )
    ),
    
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            #'layout/user' => __DIR__ . '/../view/layout/user.phtml',
            'user/index/index' => __DIR__ . '/../view/user/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ),
            ),
        ),
    ),
);