<?php

namespace InscriptionBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ClasseController extends Controller
{
    /**
     *
     * @Route("/section/classe", name="section_classe")
     */
    public function indexAction()
    {
        return $this->render('InscriptionBundle:Inscription/Section:classes.html.twig');
    }
}
