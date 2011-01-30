<?php

namespace Application\LifestreamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {

        return $this->render('LifestreamBundle:Default:index.html.twig', array(
            'services' => array('lastfm')
        ));
    }
    
    public function showAction($service) {
        
        $handler = $this->get(sprintf('lifestream.%s.api', $service));
        
        return $this->render('LifestreamBundle:Default:show.html.twig', array(
            'service' => $service,
            'items' => $handler->getRecents()
        ));
    }
}
