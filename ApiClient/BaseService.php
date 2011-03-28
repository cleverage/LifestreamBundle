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
      $data = $this->fetch( $this->getDataUrl() );

      if (!empty($data))
      {
          /**
           * @todo : use the DIC to import and configure the Serializer
           */
          $this->serializer = new \Symfony\Component\Serializer\Serializer();
          $this->serializer->setEncoder('xml', new \Symfony\Component\Serializer\Encoder\XmlEncoder());
          $this->serializer->setEncoder('json', new \Symfony\Component\Serializer\Encoder\JsonEncoder());

          $decoded_data = $this->serializer->decode($data, $this->getFormat());

          if (is_array($decoded_data))
          {
              return $this->denormalize($decoded_data);
          }
          else
          {
              throw new \Exception("Can't read the collection.");
          }
      }
  }

  /**
   * Return the request params
   *
   * @return array
   */
  abstract public function getRequestParams();

  /**
   * Create the LifestreamEvent object from a data array
   *
   * @return \CleverAge\Bundle\LifestreamBundle\Entity\LifestreamEvent
   */
  abstract public function denormalizeObject(array $data);

  /**
   * Create the LifestreamEvent object's from a collection data array
   *
   * @return array of \CleverAge\Bundle\LifestreamBundle\Entity\LifestreamEvent
   */
  abstract public function denormalize(array $data);

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
   * Return the format of the server API payload
   * 
   * @return string
   */
  public function getFormat()
  {
      return 'xml';
  }

  public function createEvent($title, $url, \DateTime $date, $type)
  {
      $object = new \CleverAge\Bundle\LifestreamBundle\Entity\LifestreamEvent();
      $object->setEventAt($date);
      $object->setTitle($title);
      $object->setUrl($url);
      $object->setType($type);

      return $object;
  }

  /**
   * Returns profile's url (ex: http://lastfm.com/user/palleas)
   *
   * @return String
   */
  abstract public function getProfileURL();
}