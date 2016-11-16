<?php

namespace Szkla\Bundle\ProductGridBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SzklaProductGridBundle:Default:index.html.twig', array('name' => $name));
    }
}
