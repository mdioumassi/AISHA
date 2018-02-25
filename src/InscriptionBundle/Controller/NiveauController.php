<?php

namespace InscriptionBundle\Controller;

use InscriptionBundle\Entity\Niveau;
use InscriptionBundle\Form\Type\NiveauType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NiveauController extends Controller
{
    /**
     * @Route("/niveaux", name="liste_niveaux")
     * @Template("@Inscription/Inscription/Niveau/index.html.twig")
     */
    public function indexAction()
    {
        $niveauManager = $this->get('niveau_manager');
        $niveaux = $niveauManager->getAll();
        $this->isExist($niveaux, "niveau");
        return [
            'niveaux' => $niveaux
        ];
    }

    /**
     * @Route("/niveaux/ajouter", name="ajouter_niveau")
     * @Template("@Inscription/Inscription/Niveau/ajouter.html.twig")
     */
    public function addNiveauAction(Request $request)
    {
        $niveau = new Niveau();
        $niveauManager = $this->get('niveau_manager');
        $form = $this->createForm(NiveauType::class, $niveau);
        $form->handleRequest($request);
        if ($request->isMethod('POST') && $form->isValid()) {
            $niveauManager->setForm($form)->create();
            $this->redirectToRoute('liste_niveaux');
        }
        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("niveaux/{classe}/eleves", name="niveaux_eleves")
     * @Template("InscriptionBundle:Inscription/Niveau:eleves.html.twig")
     */
    public function getElevesAction($classe)
    {
        $niveauManager = $this->get('niveau_manager');
        $eleves = $niveauManager->getElevesByNiveau($classe);
        return [
          'eleves' => $eleves ,
          'niveau' => $niveauManager->getOne($classe)
        ];
    }

    /**
     * @Route("/niveau/{id}/matieres", name="matieres")
     * @Template("@Inscription/Inscription/Matiere/liste.html.twig")
     */
    public function getMatieresAction(Request $request)
    {
        $niveau = $this->get('niveau_manager')->getOne($request->get('id'));
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
    private function isExist($entity, $exception)
    {
        if (empty($entity)) {
            throw $this->createNotFoundException('Not fount '.$exception);
        }
    }
}
