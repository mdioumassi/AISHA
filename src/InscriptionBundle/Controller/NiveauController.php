<?php

namespace InscriptionBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class NiveauController extends Controller
{
    /**
     * @Route("/niveaux", name="liste_niveaux")
     * @Method({"GET"})
     * @Template("@Inscription/Inscription/Niveau/index.html.twig")
     */
    public function indexAction()
    {
        $niveaux = $this->Em()
                     ->getRepository('InscriptionBundle:Niveau')
                     ->findAll()
        ;
        $enfants =
        $this->isExist($niveaux, "niveau");

        return [
            'niveaux' => $niveaux
        ];
    }

    /**
     * @Route("/niveau/{id}/matieres", name="matieres")
     * @Template("@Inscription/Inscription/Matiere/liste.html.twig")
     */
    public function getMatieresAction(Request $request)
    {
        $niveau = $this->Em()
                       ->getRepository('InscriptionBundle:Niveau')
                       ->find($request->get('id'))
        ;
        $this->isExist($niveau, "niveau");

        return [
            'matieres' => $niveau->getMatieres()
        ];

    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    private function Em()
    {
        return $this->getDoctrine()->getManager();
    }

    /**
     * Verifie si l'entité existe
     * @param $entity
     * @param $exception
     */
    private function isExist($entity, $exception )
    {
        if (empty($entity)) {
            throw $this->createNotFoundException('Not fount '.$exception);
        }
    }
}
