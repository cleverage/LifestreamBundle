<?php

namespace CleverAge\Bundle\LifestreamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $this->get('lifestream')->fetchAll();
        
        return $this->render('CleverAgeLifestreamBundle:Default:index.html.twig', array(
            'lifestream' => $this->get('lifestream')->get()
        ));
    }
}
