<?php
namespace WdgAdmin\Controller;

use WdgAdmin\Controller\AbstractController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }
}
