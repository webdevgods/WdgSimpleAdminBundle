<?php
namespace Application;

return array(
    'zfcuser' => array(
        // telling ZfcUser to use our own class
        'user_entity_class' => 'WdgUser\Entity\User',
        // telling ZfcUserDoctrineORM to skip the entities it defines
        'enable_default_entities' => false,
        'enable_registration' => false
    ),
    'view_manager' => array(
        'template_map' => array(
            'wdgadmin/layout'           => __DIR__ . '/../view/layout/layout.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'aliases' => array(
        'zfcuser_doctrine_em' => 'Doctrine\ORM\EntityManager',
    ),
    'module_layouts' => array(
        'WdgAdmin' => 'wdgadmin/layout',
        'ZfcUser' => 'wdgadmin/layout',
    ),
    'bjyauthorize' => array(
        'guards' => array(
            /* If this guard is specified here (i.e. it is enabled), it will block
             * access to all routes unless they are specified here.
             */
//            'BjyAuthorize\Guard\Route' => array(
//                array('route' => 'pr', 'roles' => array('user')),
//                array('route' => 'ct', 'roles' => array('user')),
//                array('route' => 'tb-admin', 'roles' => array('user')),
//                array('route' => 'tb-admin/category', 'roles' => array('user')),
//                array('route' => 'zfcuser', 'roles' => array('user')),
//                array('route' => 'zfcuser/logout', 'roles' => array('user')),
//                array('route' => 'zfcuser/login', 'roles' => array('guest')),
//                array('route' => 'zfcuser/register', 'roles' => array('user')),
//                // Below is the default index action used by the ZendSkeletonApplication
//                array('route' => 'home', 'roles' => array('guest', 'user')),
//            ),
        ),
    )
);
