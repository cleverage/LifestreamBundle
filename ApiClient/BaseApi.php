<?php

namespace CleverAge\Bundle\LifestreamBundle\ApiClient;

abstract class BaseApi
{
    /**
     * @var \Sonata\GoutteBundle\Manager
     */
    private $goutte;
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * Services setted by the DIC
     */
    public function setGoutte(\Sonata\GoutteBundle\Manager $goutte)
    {
        $this->goutte = $goutte;
    }
    public function setEntityManager(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Return the normalized data
     *
     * @return array
     */
    public function fetch()
    {
        $data = $this->fetchData( $this->getDataUrl() );

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
     * Return the webservice request params
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
     * Create the LifestreamEvent object's Collection from a collection data array
     * Using self::denormalizeObject.
     * See Lastfm ApiClient for example.
     *
     * @return array of \CleverAge\Bundle\LifestreamBundle\Entity\LifestreamEvent
     */
    abstract public function denormalize(array $data);

    /**
     * Return the request root url (the webservice URL to hit)
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
    private function fetchData($url)
    {
        $client     = $this->goutte->getNamedClient('curl');
        $crawler    = $client->request('GET', $url);

        $response   = $client->getResponse();

        return $response->getContent();
    }

    /**
     * Return the full URL using the params, the root url and options
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
     * Must be overriden by the ClientApi if not "xml".
     * Serializer encoder/decoder must exist for the specified format.
     *
     * @return string
     */
    public function getFormat()
    {
        return 'xml';
    }

    /**
     * Create the LifestreamEvent object and return it
     * 
     * @param string $title
     * @param string $url
     * @param \DateTime $date
     * @param string $type
     * @return \CleverAge\Bundle\LifestreamBundle\Entity\LifestreamEvent
     */
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
     * Return an ArrayCollection of LifestreamEvent for the specific type, ordered by date
     * @param int $limit The max amount of event to retrieve
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function get($limit = 20)
    {
        $query = $this->em->createQuery("SELECT e FROM CleverAgeLifestreamBundle:LifestreamEvent e WHERE e.type = ?1 ORDER BY e.event_at DESC");
        $query->setMaxResults($limit);
        $query->setParameter('1', $this->getType());

        return $query->getResult();
    }

    /**
     * Returns profile's url (ex: http://lastfm.com/user/palleas)
     *
     * @return String
     */
    abstract public function getProfileURL();

    /**
     * Return the type of the Event API,
     * must be unique string
     * @return string
     */
    abstract public function getType();
}