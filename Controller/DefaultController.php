<?php

namespace CleverAge\Bundle\LifestreamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $request = $this->get('request');
        $lifestream = $this->get('lifestream');
        
        return $this->render('CleverAgeLifestreamBundle:Default:index.html.twig', array(
            'lifestream' => $lifestream->get()
        ));
    }
}
