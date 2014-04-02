<?php
namespace WdgSimpleAdminBundle;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;

class Module 
{
    protected $whitelist = array('zfcuser/login');
    
    public function onBootstrap(MvcEvent $e)
    {
        $app            = $e->getApplication();
        $eventManager   = $app->getEventManager();        
        $sm             = $app->getServiceManager();
        $config         = $sm->get("config");
        $list           = $config["wdg-simple-admin-bundle"]["auth"]["whitelist"];
        $zfcuserOptions = $sm->get('zfcuser_module_options');        
        $auth           = $sm->get('zfcuser_auth_service');

        $eventManager->attach(MvcEvent::EVENT_DISPATCH, function($e2) use ($list, $auth, $zfcuserOptions) 
        {
            $route_match    = $e2->getRouteMatch();
            
            // No route match, this is a 404 it will get handled normally
            if (!$route_match instanceof RouteMatch) 
            {
                return;
            }
            
            $is_xhttp   = $e2->getRequest()->isXmlHttpRequest();
            $route_name = $route_match->getMatchedRouteName();

            // Route is whitelisted it does not require authorization
            if (in_array($route_name, $list)) 
            {
                return;
            }

            $destination_route  = null;
            $response_code      = null;

            if(!$auth->hasIdentity())
            {
                // We are on a route that requires auth and has no identity
                $response_code = 401;
                
                if(!$is_xhttp)
                {
                    //Standard http request redirect to login
                    $destination_route = 'zfcuser/login';
                }
            }
            else
            {
                //We have an identity
                if(
                    $zfcuserOptions->getEnableUserState() && 
                    !in_array($auth->getIdentity()->getState(), $zfcuserOptions->getAllowedLoginStates())
                )
                {
                    //User is disabled
                    $response_code = 403;

                    if(!$is_xhttp)
                    {
                        //Standard http request redirect to login
                        $destination_route = 'zfcuser/logout';
                    }
                }
                // User is authorized just continue
                else return;
            }
            
            if(!$destination_route)
            {
                throw new HttpException($response_code, "Unauthorized");
            }

            // Redirect to the user login page, as an example
            $router   = $e2->getRouter();
            $url      = $router->assemble(array(), array(
                'name' => $destination_route
            ));
            
            $response = $e2->getResponse();
            
            $response->getHeaders()->addHeaderLine('Location', $url);
            $response->setStatusCode($response_code);
            $response->sendHeaders();
            exit;
        }, 100);
        
        $moduleRouteListener = new ModuleRouteListener();
        
        $moduleRouteListener->attach($eventManager);
    }
    
    public function getConfig()
    {
        $config         = array();
        $configFiles    = array(
            'module.zfcadmin.config.php',
            'module.zfcuser.config.php',
            'module.zfcuseradmin.config.php',
            'module.config.php',
            'routes.config.php',
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