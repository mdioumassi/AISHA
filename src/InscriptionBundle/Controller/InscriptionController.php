<?php

namespace InscriptionBundle\Controller;

use InscriptionBundle\Entity\Enfant;
use InscriptionBundle\Entity\Inscrit;
use InscriptionBundle\Entity\Mensualite;
use InscriptionBundle\Entity\Parents;
use InscriptionBundle\Form\EnfantType;
use InscriptionBundle\Form\InscritType;
use InscriptionBundle\Form\MensualiteType;
use InscriptionBundle\Form\NiveauType;
use InscriptionBundle\Form\ParentsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class InscriptionController extends Controller
{
    /**
     * @Route("/inscription/parent", name="parent_insc")
     * @Template()
     */
    public function addParentAction(Request $request)
    {
        $parent = new Parents();
        $form = $this->createForm(ParentsType::class, $parent);
        $form->handleRequest($request);
        if ($request->isMethod('POST') && $form->isValid()) {
            $this->Em()->persist($parent);
            $this->Em()->flush();
            return $this->redirectToRoute('inscription_enfant',[
                'parent_id' => $parent->getId()
            ]);
        }

        return $this->render('@Inscription/Inscription/Inscrit/parent.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/inscription/enfant", name="inscription_enfant")
     */
    public function addEnfantAction(Request $request)
    {
        $parent = $this->Em()->getRepository('InscriptionBundle:Parents')
            ->find($request->get('parent_id'));
        if (empty($parent)) {
            throw  $this->createNotFoundException('Not found parent');
        }
        $enfant = new Enfant();
        $enfant->setParent($parent);
        $form = $this->createForm(EnfantType::class, $enfant);
        $form->handleRequest($request);
        if ($request->isMethod('POST') && $form->isValid()) {
            $this->Em()->persist($enfant);
            $this->Em()->flush();
            return $this->redirectToRoute('inscription_niveau', [
                'enfant_id' => $enfant->getId()
            ]);
        }
        return $this->render('@Inscription/Inscription/Inscrit/enfant.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/inscription/niveau", name="inscription_niveau")
     */
    public function addNiveauAction(Request $request)
    {
        $enfant = $this->Em()->getRepository('InscriptionBundle:Enfant')
            ->find($request->get('enfant_id'));


        if (empty($enfant)) {
            throw  $this->createNotFoundException('Not found enfant');
        }
        $inscrit = new Inscrit();
        $inscrit->setEnfant($enfant);

        $form = $this->createForm(InscritType::class, $inscrit);
        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isValid()) {
            $this->Em()->persist($inscrit);
            $this->Em()->flush();
            return $this->redirectToRoute('inscription_mensualite', [
                'enfant_id' => $enfant->getId()
            ]);
        }

        return $this->render('@Inscription/Inscription/Inscrit/inscrit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/inscription/mensualite", name="inscription_mensualite")
     */
    public function addMensualiteAction(Request $request)
    {
        $enfant = $this->Em()->getRepository('InscriptionBundle:Enfant')
            ->findByClasse($request->get('enfant_id'));

        if (empty($enfant)) {
            throw  $this->createNotFoundException('Not found enfant');
        }

        $mensualite = new Mensualite();
        $mensualite->setEnfant($enfant->getEnfant());
        $mensualite->setNiveau($enfant->getNiveau());
        $form = $this->createForm(MensualiteType::class, $mensualite);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $this->Em()->persist($mensualite);
            $this->Em()->flush();
            return $this->redirectToRoute('inscription_fiche', [
                'enfant_id' => $enfant->getEnfant()->getId()
            ]);
        }

        return $this->render('@Inscription/Inscription/Mensualite/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("inscription/fiche", name="inscription_fiche")
     * @Template("@Inscription/Inscription/Fiche/index.html.twig")
     * @param Request $request
     * @return array
     */
    public function getFicheAction(Request $request)
    {
        $fiche = $this->Em()
                      ->getRepository('InscriptionBundle:Inscrit')
                      ->findByEnfant($request->get('enfant_id'));
        if (null === $fiche) {
            throw $this->createNotFoundException("Not Found");
        }

        $enfant = $fiche->getEnfant();
        $parent = $enfant->getParent();
        $classe = $fiche->getNiveau();
        $mensualites = $enfant->getMensualites();

        $formEnfant = $this->createForm(EnfantType::class, $enfant);
        $formParent = $this->createForm(ParentsType::class, $parent);
        $formClasse = $this->createForm(NiveauType::class, $classe);
        $formInscrit = $this->createForm(InscritType::class, $fiche);

        return $this->render('@Inscription/Inscription/Fiche/index.html.twig', [
                'formEnfant'  => $formEnfant->createView(),
                'formParent'  => $formParent->createView(),
                'formClasse'  => $formClasse->createView(),
                'formInscrit' => $formInscrit->createView(),
                'mensualites' => $mensualites,
                'parent_id'   => $enfant->getParent()->getId()
        ]);
    }

    /**
     * Affiche les effectifs d'une classe
     * @Template("InscriptionBundle:Inscription/Niveau:nbinscrit.html.twig")
     */
    public function nbinscritsAction($classe)
    {
        $nbinscrit = $this->Em()->getRepository('InscriptionBundle:Inscrit')
            ->findByEleve($classe);
        return [
            'classe' => $nbinscrit
        ];
    }

    /**
     * @Route("/inscription/liste", name="liste_inscrit")
     * @Template("@Inscription/Inscription/Inscrit/liste.html.twig")
     */
    public function getInscritAction(Request $request)
    {
        if ($request->get('parent_id')) {
            $listeinscrits = $this->Em()
                ->getRepository('InscriptionBundle:Inscrit')
                ->getInscritAll($request->get('parent_id'));
        } else {
            $listeinscrits = $this->Em()
                ->getRepository('InscriptionBundle:Inscrit')
                ->getInscritAll();
        }


        if (null === $listeinscrits) {
            throw $this->createNotFoundException("Not Found");
        }

        if ($request->get('parent_id')) {
            return [
                'listes' => $listeinscrits,
            ];
        } else {
            return [
                'listes' => $listeinscrits,
            ];
        }
    }

    /**
     * @Template("@Inscription/Inscription/Inscrit/Ajax/listeinscritbyp.html.twig")
     */
    public function selectParentAction()
    {
        $parents = $this->Em()
                   ->getRepository('InscriptionBundle:Parents')
                    ->findAll();
        return [
            'parents' => $parents,
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
