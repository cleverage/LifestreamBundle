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
     * @orm:Column(type="string", length="255")
     * @var string $url
     */
    protected $url = null;
    
    /**
     * @orm:Column(type="string", length="20")
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

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set url
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Get url
     *
     * @return string $url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set type
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return datetime $createdAt
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set event_at
     *
     * @param datetime $eventAt
     */
    public function setEventAt($eventAt)
    {
        $this->event_at = $eventAt;
    }

    /**
     * Get event_at
     *
     * @return datetime $eventAt
     */
    public function getEventAt()
    {
        return $this->event_at;
    }
}