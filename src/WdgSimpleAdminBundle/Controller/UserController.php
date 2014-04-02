<?php
namespace WdgSimpleAdminBundle\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    public function indexAction()
    {
        if (!$this->zfcUserAuthentication()->hasIdentity()) 
        {
            return $this->redirect()->toRoute(\ZfcUser\Controller\UserController::ROUTE_LOGIN);
        }
        
        return new ViewModel();
    }
}
