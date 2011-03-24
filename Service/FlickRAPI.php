<?php
namespace Palleas\LifestreamBundle\Service;

use Palleas\LifestreamBundle\Service\ServiceInterface;

use Flickr\Account;

/**
* 
*/
class FlickRAPI implements ServiceInterface
{
    const API_GATEWAY = 'http://api.flickr.com/services/rest';
    
    protected $key;

    protected $userId;
    
    public function __construct($key, $user_id) 
    {
        $this->key = $key;
        $this->userId = $user_id;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getRecents() 
    {
        $url = self::API_GATEWAY;
        
        $photos = array();
        
        $parameters = $this->getInitialRequestParameters();
        $parameters['method'] = 'flickr.people.getPublicPhotos';
        $parameters['extras'] = 'url_sq';
        
        $results = file_get_contents($url.'?'.http_build_query($parameters));
        $tree = new \SimpleXMLElement($results);

        if (!$tree->photos->photo)
        {
            return $photos;
        }
        foreach ($tree->photos->photo as $photo)
        {
            $photos[] = array(
                'url' => $photo['url_sq'],
                'title' => $photo['title']
            );
        }
        
        return $photos;
    }

    /**
     * {@inheritdoc}
     */
    public function getProfileURL() 
    {
        return null;
    }
    
    protected function getInitialRequestParameters($signed = false)
    {
        return array(
            'user_id' => $this->userId,
            'api_key' => $this->key
        );
    }
}
