<?php

namespace Application\LifestreamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $lastfm = $this->get('lifestream.lastfm.api');
        
        return $this->render('LifestreamBundle:Default:index.html.twig', array(
            'tracks' => $lastfm->getRecentTracks()
        ));
    }
}
