<?php
return array(
    'zfcuser' => array(
        'enable_registration' => false,
        'enable_username' => true,
        'enable_display_name' => true,
        'auth_identity_fields' => array( 'username' ),
        'EnableDefaultEntities' => true,
        'use_redirect_parameter_if_present' => true,
        'login_redirect_route' => 'zfcadmin',
        'logout_redirect_route' => 'zfcuser/login',
        'enable_user_state' => true,
        'default_user_state' => 1,
        'allowed_login_states' => array( 1 ),
    ),
    //This is a fix for zfcuserdoctrine
    'service_manager' => array(
        'aliases' => array(
            'zfcuser_doctrine_em' => 'Doctrine\ORM\EntityManager',
        ),
    )
);