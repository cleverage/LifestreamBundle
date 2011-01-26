<?php

namespace ApplicationLifestreamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ApplicationLifestreamBundle:Default:index.html.twig');
    }
}
