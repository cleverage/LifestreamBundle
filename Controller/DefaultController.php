<?php

namespace Application\LifestreamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LifestreamBundle:Default:index.html.twig');
    }
}
