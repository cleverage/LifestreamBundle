<?php
namespace Palleas\LifestreamBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

class PalleasLifestreamExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
    }

    public function getAlias()
    {
        return 'palleas_lifestream';
    }

    /**
     * @depreciated ???
     */
    protected function configServices(array $services, ContainerBuilder $container) 
    {
        foreach ($services as $name => $arguments) 
        {
            $this->configService($name, $arguments, $container);
        }
    }
    
    /**
     * @depreciated ???
     */
    protected function configService($name, $arguments, ContainerBuilder $container) 
    {
        $definitionName = sprintf('lifestream.%s.api', strtolower($name));
        $definition = $container->getDefinition($definitionName);
        
        foreach ($arguments as $argument) 
        {
            $definition->addArgument($argument);
        }
    }
}