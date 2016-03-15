<?php

namespace Webservice\ServicesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WebserviceServicesBundle:Default:index.html.twig');
    }
}
