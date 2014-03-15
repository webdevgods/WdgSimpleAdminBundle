<?php
return array(
    'router' => array(
        'routes' => array(
            'wdgadmin' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/wdgadmin',
                    'defaults' => array(
                        '__NAMESPACE__' => 'WdgAdmin\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'user' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/user',
                            'defaults' => array(
                                'controller' => 'WdgAdmin\Controller\User',
                                'action' => 'list'
                            )
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'mine' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/mine',
                                    'defaults' => array(
                                        'controller' => 'WdgAdmin\Controller\User',
                                        'action'     => 'mine',
                                    ),
                                ),
                            ),
                            'add' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/add',
                                    'defaults' => array(
                                        'controller' => 'WdgAdmin\Controller\User',
                                        'action' => 'add'
                                    )
                                ),
                                'may_terminate' => true,
                            ),
                            'list' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/list',
                                    'defaults' => array(
                                        'controller' => 'WdgAdmin\Controller\User',
                                        'action' => 'list'
                                    )
                                ),
                                'may_terminate' => true,
                            ),
                            'show' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/show[/:id]',
                                    'defaults' => array(
                                        'controller' => 'WdgAdmin\Controller\User',
                                        'action' => 'show'
                                    )
                                ),
                                'may_terminate' => true,
                            ),
                            'edit' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/edit[/:id][/:redirect]',
                                    'defaults' => array(
                                        'controller' => 'WdgAdmin\Controller\User',
                                        'action' => 'edit'
                                    )
                                ),
                                'may_terminate' => true,
                            ),
                            'delete' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/delete[/:id]',
                                    'defaults' => array(
                                        'controller' => 'WdgAdmin\Controller\User',
                                        'action' => 'delete'
                                    )
                                ),
                                'may_terminate' => true,
                            ),
                        )
                    ),
                ),
            ),
        ),
    ),
);
