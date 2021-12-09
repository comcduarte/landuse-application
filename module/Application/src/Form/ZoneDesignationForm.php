<?php
namespace Application\Form;

use Components\Form\AbstractBaseForm;
use Laminas\Form\Element\Text;

class ZoneDesignationForm extends AbstractBaseForm
{
    public function init()
    {
        parent::init();
        
        $this->add([
            'name' => 'NAME',
            'type' => Text::class,
            'attributes' => [
                'class' => 'form-control',
                'id' => 'NAME',
                'required' => 'true',
                'placeholder' => '',
            ],
            'options' => [
                'label' => 'Name',
            ],
        ],['priority' => 100]);
    }
}