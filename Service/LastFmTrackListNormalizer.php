<?php
namespace Application\LifestreamBundle\Service;

use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class LastFmTrackListNormalizer implements NormalizerInterface {

    public function normalize($object, $format, $properties = null) {
        $tracks = array();
        
        foreach ($object->recenttracks->track as $node) {
            $tracks[] = array(
                'artist' => $node->artist,
                'name'  => $node->name,
                'url'   => $node->url,
                'image' => (string)$node->image[1]
            );
        }

        return $tracks;
    }

    public function denormalize($data, $class, $format = null) {
        
    }

    public function supports(\ReflectionClass $class, $format = null) {
        
    }

    public function setSerializer(SerializerInterface $serializer) {
        
    }

    public function getSerializer() {
        
    }
}
