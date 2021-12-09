<?php
namespace Application\Form\Factory;

use Application\Form\ParcelForm;
use Application\Model\ParcelModel;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ParcelFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $form = new ParcelForm();
        $adapter = $container->get('model-adapter');
        
        $model = new ParcelModel($adapter);
        
        $form->setInputFilter($model->getInputFilter());
        $form->setDbAdapter($adapter);
        return $form;
    }
}