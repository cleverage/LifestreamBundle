<?php

namespace CleverAge\Bundle\LifestreamBundle\ApiClient;

/**
 * 
 * @author CleverAge
 */
class Lifestream 
{
    /**
     * Doctrine ORM
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    
    /**
     * Used only the the parameters bag. Plan to use a better config system.
     * @var \Symfony\Component\DependencyInjection\Container
     */
    private $service_container;

    /**
     *
     * @param \Doctrine\ORM\EntityManager $em
     * @param \Symfony\Component\DependencyInjection\Container $service_container
     */
    public function __construct(\Doctrine\ORM\EntityManager $em, \Symfony\Component\DependencyInjection\Container $service_container)
    {
        $this->em = $em;
        $this->service_container = $service_container;
    }

    /**
     * @todo  Must return the N last event stored
     * @param int $limit
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function get($limit = 20)
    {
        // Here is how to retreive params : 
        $this->service_container->getParameter('lifestream.lastfm.username');
        return array();
    }
}