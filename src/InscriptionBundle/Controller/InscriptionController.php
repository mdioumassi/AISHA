<?php

namespace InscriptionBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InscriptionController extends Controller
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function indexAction()
    {
        return $this->render('@Inscription/Inscription/Inscription.html.twig');
    }
}
