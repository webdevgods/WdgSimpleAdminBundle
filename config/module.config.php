<?php
namespace WdgSimpleAdminBundle;

return array(
    "wdg-simple-admin-bundle" => array(
        "auth" => array(
            "whitelist" => array(
                'zfcuser/login'
            )
        )
    ),
    'view_manager' => array(
        'template_map' => array(
            'wdg-simple-admin-bundle/layout'           => __DIR__ . '/../view/layout/layout.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
