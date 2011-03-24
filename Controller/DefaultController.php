<?php

namespace Palleas\LifestreamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller 
{
    public function indexAction() 
    {
        $request = $this->get('request');

        $response = new Response();
        
        if (!$response->isNotModified($request))
        {
            $response->setMaxAge(600);
            $response->setPublic();
            
            return $this->render('PalleasLifestreamBundle:Default:index.html.twig', array(
                'services' => array('lastfm', 'flickr')
                ), $response);
        }
        else
        {
            $response->setNotModified();
            $response->send();
        }
    }

    public function showAction($service) 
    {

        $handler = $this->get(sprintf('lifestream.%s.api', $service));
        $recents = $handler->getRecents();

        $response = $this->render(sprintf('PalleasLifestreamBundle:Default:show_%s.html.twig', $service), 
        array(
            'service' => $service, 
            'recents' => $recents
            ));


        return $response;
    }
}
