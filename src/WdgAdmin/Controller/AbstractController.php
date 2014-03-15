<?php
namespace WdgAdmin\Controller;

use Application\Controller\AbstractController as ApplicationAbstractController;

abstract class AbstractController extends ApplicationAbstractController
{
    public function onDispatch(\Zend\Mvc\MvcEvent $e) 
    {
        /* @var $authentication \ZfcUser\Controller\Plugin\ZfcUserAuthentication */
        $authentication = $this->zfcUserAuthentication();
        
        if(!$authentication->hasIdentity())
        {
            if($this->isAjaxRequest())
                throw new Exception("Not logged in.", 401);

            $this->flashMessenger()->addErrorMessage("Please log in.");

            $this->redirect()->toRoute('zfcuser/login');

            $this->getResponse()->sendHeaders();
        }
        elseif($authentication->getIdentity()->getState() !== 1)
        {            
            if($this->isAjaxRequest())
                throw new Exception("User is disabled.", 403);

            $this->flashMessenger()->addErrorMessage("User is disabled.");

            $this->redirect()->toRoute('zfcuser/logout');

            $this->getResponse()->sendHeaders();
        }
        
        parent::onDispatch($e);
    }
}
