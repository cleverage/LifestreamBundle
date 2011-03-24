<?php

namespace Cleverage\Bundle\LifestreamBundle\Service;

/**
 * Handle all the lifestream (allow merge between all the data stream)
 */
class Lifestream
{
	/**
     * Doctrine EntityManager
     *
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * Constructor
     */
    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
    	$this->em = $em;
    }

    public function getLasts($limit = 30)
    {
    	// todo, merge all data and send them nicelly
    }

    public function refreshAll()
    {
    	// todo, load all the services and store the resulting new data
    }
}