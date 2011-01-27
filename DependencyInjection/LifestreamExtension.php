<?php
namespace Application\LifestreamBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;


/**
* 
*/
class LifestreamExtension extends Extension
{
  public function configLoad($config, ContainerBuilder $container)
  {
    
  }
  
  public function getXsdValidationBasePath()
  {
    return null;
  }
  
  public function getNamespace()
  {
    return 'http://www.symfony-project.org/schema/dic/symfony';
  }

  public function getAlias()
  {
      return 'lifestream';
  }
}
