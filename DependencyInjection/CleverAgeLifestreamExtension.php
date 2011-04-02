<?php
namespace CleverAge\Bundle\LifestreamBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Definition;

class CleverAgeLifestreamExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        // Merge all the configs into one.
        $config = call_user_func_array('array_merge_recursive', $configs);

        // The main manager class
        $definition = new Definition($config['class']);
        $services_names = array();

        // Set service for each API set
        foreach ($config['apis'] as $name => $configuration)
        {
            if (!$container->hasDefinition(sprintf('lifestream.%s', $name)))
            {
                $api_definition = new Definition($configuration['class']);
                $configuration = isset($configuration['config']) ? $configuration['config'] : array();

                $api_definition->setArguments( array(0 => $configuration) );
                $api_definition->addMethodCall('setEntityManager', new Reference('doctrine.orm.entity_manager'));
                $api_definition->addMethodCall('setGoutte', new Reference('goutte'));

                $container->setDefinition( sprintf('lifestream.%s', $name), $api_definition);
                $services_names[] = sprintf('lifestream.%s', $name);
            }
        }

        $definition->setArguments(array(0 => new Reference('doctrine.orm.entity_manager'), 1 => $services_names));
        $container->setDefinition('lifestream', $definition);
    }
}