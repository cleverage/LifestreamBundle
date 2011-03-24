<?php

namespace Cleverage\LifestreamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller 
{
    public function indexAction() 
    {
        $request = $this->get('request');

        $this->get('lifestream');

        return $this->render('CleverageLifestreamBundle:Default:index.html.twig', array(
                'services' => array('lastfm', 'flickr')
                ));
    }

    public function showAction($service) 
    {

        $handler = $this->get(sprintf('lifestream.%s', $service));
        $recents = $handler->getRecents();

        $response = $this->render(sprintf('CleverageLifestreamBundle:Default:show_%s.html.twig', $service), 
        array(
            'service' => $service, 
            'recents' => $recents
            ));


        return $response;
    }
}
