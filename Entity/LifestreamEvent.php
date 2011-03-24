<?php
namespace CleverAge\Bundle\LifestreamBundle\Entity;

/**
 * @orm:Entity
 * @orm:Options()
 */
class LifestreamEvent
{
    /**
     * @orm:Id
     * @orm:Column(type="integer")
     * @orm:GeneratedValue(strategy="AUTO")
     * @var integer $id
     */
    protected $id;

    /**
     * @orm:Column(type="string", length="255", nullable=false)
     * @var string $title
     */
    protected $title;

    /**
     * @orm:Column(type="string", lenght="255")
     * @var string $url
     */
    protected $url = null;
    
    /**
     * @orm:Column(type="string", lenght="20")
     * @var string $type
     */
    protected $type;

    /**
     * @orm:Column(type="datetime")
     * @var string $created_at
     */
    protected $created_at;

    /**
     * @orm:Column(type="datetime")
     * @var string $event_at
     */
    protected $event_at;
}