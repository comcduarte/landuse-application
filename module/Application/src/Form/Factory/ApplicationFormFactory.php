<?php
namespace Application\Form\Factory;

use Application\Form\ApplicationForm;
use Application\Model\ApplicationModel;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ApplicationFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $form = new ApplicationForm();
        $adapter = $container->get('model-adapter');
        
        $model = new ApplicationModel($adapter);
        
        $form->setInputFilter($model->getInputFilter());
        $form->setDbAdapter($adapter);
        return $form;
    }
}