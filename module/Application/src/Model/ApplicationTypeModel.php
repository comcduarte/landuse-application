<?php
namespace Application\Model;

use Components\Model\AbstractBaseModel;
use Laminas\Db\Adapter\Adapter;

class ApplicationTypeModel extends AbstractBaseModel
{
    public $NAME;
    
    public function __construct(Adapter $adapter)
    {
        parent::__construct($adapter);
        
        $this->setTableName('application_types');
        return $this;
    }
}