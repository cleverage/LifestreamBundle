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
     * The list of API services configured
     * @var array
     */
    private $service_names;

    /**
     *
     * @param \Doctrine\ORM\EntityManager $em
     */
    public function __construct(\Doctrine\ORM\EntityManager $em, $service_names)
    {
        $this->em = $em;
        $this->service_names = $service_names;
    }


    /**
     * @todo  Must return the N last event stored, use $this->fetch() & persist on each ? no
     * @param int $limit
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function get($limit = 20)
    {
        $query = $this->em->createQuery("SELECT e FROM CleverAgeLifestreamBundle:LifestreamEvent e ORDER BY e.event_at DESC");
        $query->setMaxResults($limit);

        return $query->getResult();
    }
}