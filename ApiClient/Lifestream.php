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
     * DIC, needed to get other services
     * @var \Symfony\Component\DependencyInjection\Container
     */
    private $service_container;

    /**
     * The list of API services configured
     * @var array
     */
    private $service_names;

    /**
     *
     * @param \Doctrine\ORM\EntityManager $em
     * @param \Symfony\Component\DependencyInjection\Container $service_container
     * @param array $service_names
     */
    public function __construct(\Doctrine\ORM\EntityManager $em, \Symfony\Component\DependencyInjection\Container $service_container, $service_names)
    {
        $this->em                   = $em;
        $this->service_container    = $service_container;
        $this->service_names        = $service_names;
    }


    /**
     * @param int $limit
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function get($limit = 20)
    {
        $query = $this->em->createQuery("SELECT e FROM CleverAgeLifestreamBundle:LifestreamEvent e ORDER BY e.event_at DESC");
        $query->setMaxResults($limit);

        return $query->getResult();
    }

    /**
     * @return array
     */
    public function getServiceNames()
    {
        return $this->service_names;
    }

    /**
     * @return \Symfony\Component\DependencyInjection\Container
     */
    protected function getServiceContainer()
    {
        return $this->service_container;
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEntityManager()
    {
        return $this->em;
    }

    /**
     * Fetch all the events from all registred API's and store new events.
     */
    public function fetchAll()
    {
        foreach($this->getServiceNames() as $service_name)
        {
            $service = $this->getServiceContainer()->get($service_name);

            foreach ($service->fetch() as $event)
            {
                if ($event->isNew($this->getEntityManager())) // That's not is new in a Doctrine1 way
                {
                    $this->getEntityManager()->persist( $event );
                }
            }
        }
        $this->getEntityManager()->flush();
    }
}