<?php
namespace Application\LifestreamBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
* 
*/
class LifestreamExtension extends Extension {
    
    public function configLoad($config, ContainerBuilder $container) {
        $loader = new XmlFileLoader($container, __DIR__.'/../Resources/config');
        $loader->load('config.xml');
        
        $this->configServices($config[0]['services'], $container);
    }

    public function getXsdValidationBasePath() {

        return null;
    }

    public function getNamespace() {

        return 'http://www.symfony-project.org/schema/dic/symfony';
    }

    public function getAlias() {

        return 'lifestream';
    }
    
    protected function configServices(array $services, ContainerBuilder $container) {
        foreach ($services as $name => $arguments) {
            $this->configService($name, $arguments, $container);
        }
    }
    
    protected function configService($name, $arguments, ContainerBuilder $container) {
        $definitionName = sprintf('lifestream.%s.api', strtolower($name));
        $definition = $container->getDefinition($definitionName);
        
        foreach ($arguments as $argument) {
            $definition->addArgument($argument);
        }
    }
}
