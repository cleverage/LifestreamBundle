<?php

namespace CleverAge\Bundle\LifestreamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $lifestream = $this->get('lifestream');

        
        var_dump($lifestream->get('lastfm')->get());
        
        return $this->render('CleverAgeLifestreamBundle:Default:index.html.twig', array(
            'lifestream' => $lifestream->get('lastfm')->get()
        ));
    }
}
