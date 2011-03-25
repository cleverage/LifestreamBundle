<?php

namespace CleverAge\Bundle\LifestreamBundle\ApiClient;

abstract class BaseService
{
  /**
   *
   * @var \Sonata\GoutteBundle\Manager
   */
  private $goutte;

  /**
   * To be removed ?
   * Better be in the DIC
   */
  public function setGoutte(\Sonata\GoutteBundle\Manager $goutte)
  {
      $this->goutte = $goutte;
  }

  /**
   * Return the normalized data
   *
   * @return array
   */
  public function get()
  {
      $url = $this->getDataUrl();

      $data = $this->fetch($url);
      
      // Todo : read the data and return the array !
  }

  /**
   * Return the request params
   *
   * @return array
   */
  abstract public function getRequestParams();

  /**
   * Return the request root url
   *
   * @return string
   */
  abstract public function getRequestRootUrl();

  /**
   * Fetch raw data from an given URL
   * Perform a GET request and return the result as a string
   * 
   * @return string
   */
  private function fetch($url)
  {
    $client = $this->goutte->getNamedClient('curl');
    $crawler = $client->request('GET', $url);

    $response = $client->getResponse();
    
    return $response->getContent();
  }

  /**
   * Return the full URL
   *
   * @param array $options   The params to add to the request
   * @return string
   */
  public function getDataUrl(array $options = array())
  {
    $parameters = array_merge($options, $this->getRequestParams());

    if (!empty ($parameters))
    {
        return sprintf('%s?%s', $this->getRequestRootUrl(), http_build_query($parameters));
    }
    else
    {
        return $this->getRequestRootUrl();
    }
  }

  /**
   * Returns profile's url (ex: http://lastfm.com/user/palleas)
   *
   * @return String
   */
  abstract public function getProfileURL();
}