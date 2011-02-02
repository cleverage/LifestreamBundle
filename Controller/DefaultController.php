<?php

namespace Application\LifestreamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {

        return $this->render('LifestreamBundle:Default:index.html.twig', array(
            'services' => array('lastfm', 'flickr')
        ));
    }
    
    public function showAction($service) {
        
        $handler = $this->get(sprintf('lifestream.%s.api', $service));
        $recents = $handler->getRecents();
        
        return $this->render(sprintf('LifestreamBundle:Default:show_%s.html.twig', $service), 
        array(
            'service' => $service, 
            'recents' => $recents
            ));
    }
}
