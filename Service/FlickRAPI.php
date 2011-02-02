<?php
namespace Application\LifestreamBundle\Service;

use Application\LifestreamBundle\Service\ServiceInterface;


/**
* 
*/
class FlickRAPI implements ServiceInterface
{
    protected $key;
    
    protected $secret;
    
    protected $userId;
    
    public function __construct($key, $user_id) {
        $this->key = $key;
        $this->userId = $user_id;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getRecents() {
        return array();
    }

    /**
     * {@inheritdoc}
     */
    public function getProfileURL() {
        return null;
    }
}
