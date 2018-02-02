<?php

namespace InscriptionBundle\Controller;

use InscriptionBundle\Entity\Enfant;
use InscriptionBundle\Form\EnfantType;
use InscriptionBundle\Form\InscritType;
use InscriptionBundle\Form\NiveauType;
use InscriptionBundle\Form\ParentsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EnfantController extends Controller
{
    /**
     * @Route("/enfants", name="liste_enfants")
     * @Method({"GET"})
     * @Template("@Inscription/Inscription/Enfant/liste.html.twig")
     */
    public function getEnfants(){
        $manager = $this->get('enfant_manager');
        $enfants = $manager->getEnfants();

        return [
            'enfants' => $enfants
        ];
    }

    /**
     * @Route("/parents/{parent_id}/enfants", name="parent_enfants")
     * @Template("@Inscription/Inscription/Enfant/liste.html.twig")
     */
    public function getEnfantsAction(Request $request){
        $manager = $this->get('enfant_manager');
        $parent = $manager->getParentById($request->get('parent_id'));
        $niveauEnfantsParent = $manager->getNiveauEnfants($request->get('parent_id'));

        return [
            'parent_id' => $request->get('parent_id'),
            'parent' => $parent,
            'enfants' => $niveauEnfantsParent
        ];
    }

    /**
     * @Route("/enfants/{id}/parent", name="enfant_parent")
     * @Template("@Inscription/Inscription/Parent/parent.html.twig")
     */
    public function getParent(Request $request){
        $manager = $this->get('enfant_manager');
        $enfant = $manager->getEnfantById($request->get('id'));
        if(empty($enfant)){
            throw $this->createNotFoundException('Not found Enfant');
        }
        return [
            'parent' => $enfant->getParent(),
        ];
    }

    /**
     * @Route("/parents/{parent_id}/enfant/ajouter", name="ajout_enfant")
     */
    public function ajouterEnfantAction(Request $request)
    {
        $enfantManager = $this->get('enfant_manager');
        $parentManager = $this->get('parent_manager');
        $parent = $parentManager->getParentById($request->get('parent_id'));
        if (empty($parent)) {
            throw  $this->createNotFoundException('Not found parent');
        }
        $enfant = new Enfant();
        $enfant->setParent($parent);
        $form = $this->createForm(EnfantType::class, $enfant);
        $form->handleRequest($request);
        if ($request->isMethod('POST') && $form->isValid()) {
            $enfantManager->setForm($form)->create();
            return $this->redirectToRoute('inscription_niveau', [
                'enfant_id' => $enfant->getId()
            ]);
        }
        return $this->render('@Inscription/Inscription/Inscrit/enfant.html.twig', [
            'form' => $form->createView(),
            'parent_id' => $parent->getId()
        ]);
    }

    /**
     * @Route("/enfants/{enfant_id}/enfant/delete" ,name="delete_enfant")
     */
    public function deleteEnfant(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $enfant = $em->getRepository('InscriptionBundle:Enfant')
                     ->find($request->get('enfant_id'));
        if (empty($enfant)) {
            throw  $this->createNotFoundException('Not found parent');
        }
        $parent = $enfant->getParent();
        $em->remove($enfant);
        $em->flush();
        return $this->redirectToRoute('parent_enfants', [
            'parent_id' => $parent->getId()
        ]);
    }

    /**
     * @Route("/enfants/{id}/edit", name="modifier_enfant")
     */
    public function modifierEnfantAction(Request $request)
    {
        $manager = $this->get('enfant_manager');
        $enfant = $manager->getEnfantById($request->get('enfant_id'));
        if (empty($enfant)) {
            throw  $this->createNotFoundException('Not found parent');
        }
        //$parent = $enfant->getParent();
        $form = $this->createForm(EnfantType::class, $enfant);
        $form->handleRequest($request);
        if ($request->isMethod('POST') && $form->isValid()) {
           $manager->setForm($form)->update();
            return $this->redirectToRoute('inscription_niveau', [
                'enfant_id' => $enfant->getId()
            ]);
        }
        return $this->render('@Inscription/Inscription/Inscrit/enfant.html.twig', [
           'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("enfant/{enfant_id}/fiche", name="enfant_fiche")
     * @Template("@Inscription/Inscription/Fiche/Form/fiche.html.twig")
     * @param Request $request
     * @return array
     */
    public function getFicheAction(Request $request)
    {
        $fiche = $this->Em()
            ->getRepository('InscriptionBundle:Inscrit')
            ->findByEnfant($request->get('enfant_id'));

        $enfant = $fiche->getEnfant();
        $parent = $enfant->getParent();
        $classe = $fiche->getNiveau();
        $mensualites = $enfant->getMensualites();

        $formEnfant = $this->createForm(EnfantType::class, $enfant);
        $formParent = $this->createForm(ParentsType::class, $parent);
        $formClasse = $this->createForm(NiveauType::class, $classe);
        $formInscrit = $this->createForm(InscritType::class, $fiche);

        return [
            'formEnfant'  => $formEnfant->createView(),
            'formParent'  => $formParent->createView(),
            'formClasse'  => $formClasse->createView(),
            'formInscrit' => $formInscrit->createView(),
            'mensualites' => $mensualites,
            'parent_id'   => $enfant->getParent()->getId()
        ];
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    private function Em()
    {
        return $this->getDoctrine()->getManager();
    }
}
