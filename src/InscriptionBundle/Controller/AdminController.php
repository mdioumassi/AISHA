<?php

namespace InscriptionBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    /**
     * @Route("/")
     *
     */
    public function indexAction()
    {
        return $this->render('@Inscription/Inscription/Admin/index.html.twig');
    }
}
