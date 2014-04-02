<?php
return array(
    'zfcuseradmin' => array(
        'user_mapper' => 'ZfcUserAdmin\Mapper\UserDoctrine',
    ),
    'service_manager' => array(
        'factories' => array(
            //This is a fix for zfcuser admin not having it
            //Move to zfcuseradmin if they ever do a pull request
            'zfcuseradmin_mapper' => function($sm)
            {
                return new \ZfcUserAdmin\Mapper\UserDoctrine(
                    $sm->get('zfcuser_doctrine_em'),
                    $sm->get('zfcuser_module_options')
                );
            }
        )
    )
);