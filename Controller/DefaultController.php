<?php

namespace CleverAge\Bundle\LifestreamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $lifestream = $this->get('lifestream');

        $em = $this->get('doctrine.orm.entity_manager');

        foreach ($lifestream->get('lastfm')->fetch() as $event)
        {
        $em->persist(
            $event
                );
        }
        $em->flush();

        
        var_dump($lifestream->get('lastfm')->fetch());
        
        return $this->render('CleverAgeLifestreamBundle:Default:index.html.twig', array(
            'lifestream' => $lifestream->get('lastfm')->fetch()
        ));
    }
}
