<?php
namespace CleverAge\Bundle\LifestreamBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

class CleverAgeLifestreamExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
    	var_dump($container);die();
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
    }

    public function getAlias()
    {
        return 'clever_age_lifestream';
    }
}