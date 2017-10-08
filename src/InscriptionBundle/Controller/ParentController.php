<?php

namespace InscriptionBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ParentController extends Controller
{
    /**
     * @Route("/parents", name="liste_parents")
     * @Method({"GET"})
     * @Template("@Inscription/Inscription/Parent/liste.html.twig")
     */
    public function getParentsAction(){
        $em = $this->getDoctrine()->getManager();
        $parents = $em->getRepository('InscriptionBundle:Parents')
                   ->findAll();
        if(empty($parents)){
            throw $this->createNotFoundException('Parents not found');
        }

        return [
            'parents' => $parents
        ];
    }
}
