<?php
namespace Application\Controller;

use Components\Controller\AbstractBaseController;
use Laminas\Db\Sql\Where;
use Laminas\View\Model\ViewModel;

class ListController extends AbstractBaseController
{
    public function indexAction()
    {
        $view = new ViewModel();
        
        $records = $this->model->fetchAll(new Where());
        $header = [];
        
        if (!empty($records)) {
            $header = array_keys($records[0]);
        }
        
        $route = $this->getEvent()->getRouteMatch()->getMatchedRouteName();
        $params = $this->getEvent()->getRouteMatch()->getParams();
        
        $view->setvariables ([
            'route' => $route,
            'params' => $params,
            'data' => $records,
            'header' => $header,
            'primary_key' => $this->model->getPrimaryKey(),
        ]);
        return $view;
    }
}