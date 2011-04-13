<?php

namespace CleverAge\Bundle\LifestreamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $lifestream = $this->get('lifestream.twitter');

        $em = $this->get('doctrine.orm.entity_manager');

        foreach ($lifestream->fetch() as $event)
        {
            if ($event->isNew($em)) // That's not is new in a Doctrine1 way
            {
                $em->persist( $event );
            }
        }
        $em->flush();
        
        return $this->render('CleverAgeLifestreamBundle:Default:index.html.twig', array(
            'lifestream' => $this->get('lifestream')->get()
        ));
    }
}
