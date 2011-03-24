<?php
namespace CleverAge\Bundle\LifestreamBundle\ApiClient;

use CleverAge\Bundle\LifestreamBundle\Service\ServiceInterface;

/**
 * LastFm API wrapper
 */
class Lastfm implements ServiceInterface
{
    const API_GATEWAY = 'http://ws.audioscrobbler.com/2.0/';
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

    // /**
    //  * Returns recent played tracks
    //  *
    //  * @param array $options An array of options
    //  * @return array
    //  */
    // public function getRecentTracks(array $options = array())
    // {
    //     static $method = 'user.getrecenttracks';

    //     $parameters = array_merge($options, $this->getInitialRequestParameters());
    //     $parameters['method'] = $method;

    //     $request = sprintf('%s?%s', self::API_GATEWAY, http_build_query($parameters));

    //     $results = file_get_contents($request);
    //     $normalizer = new LastFmTrackListNormalizer();

    //     return $normalizer->normalize(new \SimpleXMLElement($results), 'array', null);
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function getRecents()
    // {
    //     return $this->getRecentTracks();
    // }

    /**
     * {@inheritdoc}
     */
    public function getProfileURL()
    {
      return 'http://www.lastfm.fr/user/' . $this->username;
    }

    // /**
    //  * Returns an array of request's  mandatory parameters
    //  *
    //  * @param boolean $signed
    //  * @return array
    //  */
    // protected function getInitialRequestParameters($signed = false)
    // {
    //     return array(
    //         'user' => $this->username,
    //         'api_key' => $this->key
    //     );
    // }
}