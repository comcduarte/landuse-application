<?php
namespace Application\Form;

use Components\Form\AbstractBaseForm;
use Components\Form\Element\DatabaseSelect;
use Laminas\Form\Element\Text;
use Laminas\Db\Adapter\AdapterAwareTrait;

class ParcelForm extends AbstractBaseForm
{
    use AdapterAwareTrait;
    
    public function init()
    {
        parent::init();
        
        $this->add([
            'name' => 'PARCEL_ID',
            'type' => Text::class,
            'attributes' => [
                'class' => 'form-control',
                'id' => 'PARCEL_ID',
                'placeholder' => '',
            ],
            'options' => [
                'label' => 'Parcel ID',
            ],
        ],['priority' => 100]);
    
        $this->add([
            'name' => 'PARCEL_NAME',
            'type' => Text::class,
            'attributes' => [
                'class' => 'form-control',
                'id' => 'PARCEL_NAME',
                'placeholder' => '',
            ],
            'options' => [
                'label' => 'Parcel Name',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'STREET_NUM',
            'type' => Text::class,
            'attributes' => [
                'class' => 'form-control',
                'id' => 'STREET_NUM',
                'placeholder' => '',
            ],
            'options' => [
                'label' => 'Street Number',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'STREET_NAME',
            'type' => Text::class,
            'attributes' => [
                'class' => 'form-control',
                'id' => 'STREET_NAME',
                'placeholder' => '',
            ],
            'options' => [
                'label' => 'Street Name',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'STREET_SUFFIX_TYPE',
            'type' => Text::class,
            'attributes' => [
                'class' => 'form-control',
                'id' => 'STREET_SUFFIX_TYPE',
                'placeholder' => '',
            ],
            'options' => [
                'label' => 'Street Suffix Type',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'ZONE_DESIGNATION',
            'type' => DatabaseSelect::class,
            'attributes' => [
                'class' => 'form-control',
                'id' => 'ZONE_DESIGNATION',
                'placeholder' => '',
            ],
            'options' => [
                'label' => 'Zone Designation',
                'database_adapter' => $this->adapter,
                'database_table' => 'zone_designations',
                'database_id_column' => 'UUID',
                'database_value_columns' => [
                    'NAME',
                ],
            ],
        ],['priority' => 100]);
    }
}