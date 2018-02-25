<?php

namespace InscriptionBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    /**
     * @Route("/", name="adminHome")
     *
     */
    public function indexAction()
    {
        return $this->render('@Inscription/Inscription/Admin/index.html.twig');
    }

    /**
     * @Route("/parentAndChild", name="admin_parent_enfant")
     */
    public function parentChildAction()
    {
        return $this->render('@Inscription/Inscription/Admin/parentchild.html.twig');
    }
}
