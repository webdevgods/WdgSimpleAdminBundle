<?php
namespace WdgAdmin;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        $config         = array();
        $configFiles    = array(
            'module.config.php',
            'routes.config.php',
            'navigation.config.php',
        );

        foreach ($configFiles as $configFile)
        {
            $config = \Zend\Stdlib\ArrayUtils::merge($config, include __DIR__ . '/config/' . $configFile);
        }

        return $config;
    }

    /**
     * {@InheritDoc}
     */
    public function getControllerConfig()
    {
        return include __DIR__ . '/config/controllers.config.php';
    }

    /**
     * {@InheritDoc}
     */
    public function getControllerPluginConfig()
    {
        return include __DIR__ . '/config/controller.plugin.config.php';
    }

    /**
     * {@InheritDoc}
     */
    public function getServiceConfig()
    {
        $config         = array();
        $configFiles    = array(
            'service.config.php',
            'form.config.php'
        );

        foreach ($configFiles as $configFile)
        {
            $config = \Zend\Stdlib\ArrayUtils::merge($config, include __DIR__ . '/config/' . $configFile);
        }

        return $config;
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
