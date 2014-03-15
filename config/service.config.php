<?php
return array(
    'factories' => array(
        'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
    ),
    'aliases' => array(
        'zfcuser_doctrine_em' => 'Doctrine\ORM\EntityManager'
    ),
);
