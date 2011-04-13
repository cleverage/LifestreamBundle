<?php
namespace CleverAge\Bundle\LifestreamBundle\ApiClient;

/**
 * Twitter API wrapper
 */
class Twitter extends BaseApi
{
    const API_GATEWAY = 'http://twitter.com/statuses/user_timeline/%s.json';

    const TYPE = 'twitter';
    
    /**
     * Twitter account
     *
     * @var string
     */
    protected $username;

    /**
     * Constructor
     *
     * @param array $params
     */
    public function __construct($params)
    {
        $this->username = $params['username'];
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestParams()
    {
        return array();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getRequestRootUrl()
    {
        return \sprintf(self::API_GATEWAY, $this->username);
    }

    /**
     * {@inheritdoc}
     */
    public function getProfileURL()
    {
        return 'http://twitter.com/' . $this->username;
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
    public function getFormat()
    {
        return 'json';
    }

    /**
     * {@inheritdoc}
     */
    public function denormalize(array $data)
    {
        $objects = array();
        
        foreach($data as $tweet)
        {
            $event = $this->denormalizeObject($tweet);
            if ($event && ($event instanceof \CleverAge\Bundle\LifestreamBundle\Entity\LifestreamEvent))
            {
                $objects[] = $event;
            }
        }
        
        return $objects;
    }

    /**
     * {@inheritdoc}
     */
    public function denormalizeObject(array $data)
    {
        if ( isset($data['text'])
            && isset($data['id_str'])
            && isset($data['created_at'])
            && $data['in_reply_to_status_id'] == null)
        {
            return $this->createEvent(
                    $data['text'],
                    $this->getProfileURL().'/status/'.$data['id_str'],
                    new \DateTime($data['created_at']),
                    $this->getType()
                    );
        }
        else
        {
            return false;
        }
    }
}