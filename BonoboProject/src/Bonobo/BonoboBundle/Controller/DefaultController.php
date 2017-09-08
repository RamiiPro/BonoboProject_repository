<?php

namespace Bonobo\BonoboBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BonoboBonoboBundle:Default:index.html.twig');
    }
}
