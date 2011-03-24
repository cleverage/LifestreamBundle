<?php

namespace CleverAge\Bundle\LifestreamBundle\ApiClient;

class Lifestream 
{
    private $em;
    private $service_container;

    public function __construct(\Doctrine\ORM\EntityManager $em, \Symfony\Component\DependencyInjection\Container $service_container)
    {
        $this->em = $em;
        $this->service_container = $service_container;
    }
}