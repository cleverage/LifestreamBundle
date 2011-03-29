<?php
namespace CleverAge\Bundle\LifestreamBundle\ApiClient;

use CleverAge\Bundle\LifestreamBundle\Service\ServiceInterface;

/**
 * LastFm API wrapper
 */
class Lastfm extends BaseApi
{
    const API_GATEWAY = 'http://ws.audioscrobbler.com/2.0/';

    const TYPE = 'lastfm';
    
    /**
     * API Key
     *
     * @var string
     */
    protected $key;

    /**
     * LastFM account username
     *
     * @var string
     */
    protected $username;

    /**
     * Constructor
     *
     * @param string $key
     * @param string $username
     */
    public function __construct($key, $username)
    {
        $this->key = $key;
        $this->username = $username;
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestParams()
    {
        return array(
            'user' => $this->username,
            'api_key' => $this->key,
            'method'  => 'user.getrecenttracks'
        );
    }
    
    /**
     * {@inheritdoc}
     */
    public function getRequestRootUrl()
    {
        return self::API_GATEWAY;
    }

    /**
     * {@inheritdoc}
     */
    public function getProfileURL()
    {
      return 'http://www.lastfm.fr/user/' . $this->username;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
      return self::TYPE;
    }

    /**
     * {@inheritdoc}
     */
    public function denormalize(array $data)
    {
        $objects = array();
        
        if (isset($data['recenttracks']) && isset($data['recenttracks']['track']))
        {
          for ($i = 0; $i < 10; $i++)
          {
              if (isset($data['recenttracks']['track'][$i]) && is_array($data['recenttracks']['track'][$i]))
              {
                  $event = $this->denormalizeObject($data['recenttracks']['track'][$i]);
                  if ($event && ($event instanceof \CleverAge\Bundle\LifestreamBundle\Entity\LifestreamEvent))
                  {
                      $objects[] = $event;
                  }
              }
          }
        }
        
        return $objects;
    }

    /**
     * {@inheritdoc}
     */
    public function denormalizeObject(array $data)
    {
        if ( isset($data['artist'])
            && isset($data['name'])
            && isset($data['url'])
            && isset($data['date']) )
        {
            return $this->createEvent(
                    $data['name'].' - '.$data['artist'],
                    $data['url'],
                    new \DateTime($data['date']),
                    $this->getType()
                    );
        }
        else
        {
            throw new \Exception("Can't denormalize the array, missing mandatory field.");
        }
    }
}