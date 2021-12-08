<?php
namespace Application\Form;

use Components\Form\AbstractBaseForm;
use Components\Form\Element\DatabaseSelect;
use Laminas\Db\Adapter\AdapterAwareTrait;

class ApplicationForm extends AbstractBaseForm
{
    use AdapterAwareTrait;
    
    public function init()
    {
        parent::init();
        
        $this->add([
            'name' => 'APP_TYPE',
            'type' => DatabaseSelect::class,
            'attributes' => [
                'class' => 'form-control',
                'id' => 'NAME',
                'required' => 'true',
                'placeholder' => '',
            ],
            'options' => [
                'label' => 'Application Type',
                'database_adapter' => $this->adapter,
                'database_table' => 'application_types',
                'database_id_column' => 'UUID',
                'database_value_columns' => [
                    'NAME',
                ],
            ],
        ],['priority' => 100]);
    }
}