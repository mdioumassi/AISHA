<?php

namespace InscriptionBundle\Controller;

use InscriptionBundle\Entity\Enfant;
use InscriptionBundle\Entity\Inscrit;
use InscriptionBundle\Entity\Mensualite;
use InscriptionBundle\Entity\Parents;
use InscriptionBundle\Form\Type\EnfantType;
use InscriptionBundle\Form\Type\InscritType;
use InscriptionBundle\Form\Type\MensualiteType;
use InscriptionBundle\Form\Type\NiveauType;
use InscriptionBundle\Form\Type\ParentsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;

class InscriptionController extends Controller
{
    /**
     * @Route("/inscription/parent", name="parent_insc")
     * @Template("@Inscription/Inscription/Inscrit/parent.html.twig")
     */
    public function addParentAction(Request $request)
    {
        $parentManager = $this->get('parent_manager');
        $formFactory =
            Forms::createFormFactoryBuilder()
            ->addExtension(new HttpFoundationExtension())
            ->getFormFactory();
        $formSearch =
            $formFactory->createBuilder()
            ->add('telephone', IntegerType::class, [
             //   'constraints' => new NotBlank()
            ])
            ->getForm();
        $request = Request::createFromGlobals();
        $formSearch->handleRequest($request);
        if ($formSearch->isSubmitted() && $formSearch->isValid()) {
            $parents = $parentManager->getParents();
            $data = $formSearch->getData();
            //var_dump($parents); die;
        }
        $parent = new Parents();
        $form = $this->createForm(ParentsType::class, $parent);
        $form->handleRequest($request);
        if ($request->isMethod('POST') && $form->isValid()) {
            $parentManager->setForm($form)->create();
            return $this->redirectToRoute('inscription_enfant', [
                'parent_id' => $parent->getId()
            ]);
        }

        return[
            'form' => $form->createView(),
            'formS' => $formSearch->createView()
        ];
    }

    /**
     * @Route("/inscription/enfant", name="inscription_enfant")
     * @Template("@Inscription/Inscription/Inscrit/enfant.html.twig")
     */
    public function addEnfantAction(Request $request)
    {
        $enfantManager = $this->get('enfant_manager');
        $parent = $this->get('parent_manager')->getParentById($request->get('parent_id'));
        if (empty($parent)) {
            throw  $this->createNotFoundException('Not found parent');
        }
        $session = $request->getSession();
        $session->set('parent_id', $request->get('parent_id'));

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
        return ['form' => $form->createView()];
    }

    /**
     * @Route("/inscription/niveau", name="inscription_niveau")
     * @Template("@Inscription/Inscription/Inscrit/inscrit.html.twig")
     */
    public function addNiveauAction(Request $request)
    {
        $inscritManager = $this->get('inscrit_manager');
        $enfant =  $this->get('enfant_manager')->getEnfantById($request->get('enfant_id'));
        if (empty($enfant)) {
            throw  $this->createNotFoundException('Not found enfant');
        }
        $session = $request->getSession();
        $session->set('enfant_id', $request->get('enfant_id'));
        $inscrit = new Inscrit();
        $inscrit->setEnfant($enfant);
        $form = $this->createForm(InscritType::class, $inscrit);
        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isValid()) {
            $inscritManager->setForm($form)->create();
            return $this->redirectToRoute('inscription_mensualite', [
                'inscrit_id' => $inscrit->getId(),
            ]);
        }
        return ['form' => $form->createView()];
    }

    /**
     * @Route("/inscription/mensualite", name="inscription_mensualite")
     */
    public function addMensualiteAction(Request $request)
    {
        $inscrit  = $this->get('inscrit_manager')->getOne($request->get('inscrit_id'));

        if (empty($inscrit)) {
            throw  $this->createNotFoundException('Not found enfant');
        }

        $mensualite = new Mensualite();
        $mensualite->setEnfant($inscrit->getEnfant());
        $mensualite->setNiveau($inscrit->getNiveau());
        $form = $this->createForm(MensualiteType::class, $mensualite);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $this->Em()->persist($mensualite);
            $this->Em()->flush();
            return $this->redirectToRoute('inscription_fiche', [
                'inscrit_id' => $inscrit->getId()
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
        $fiche  = $this->get('inscrit_manager')->getOne($request->get('inscrit_id'));
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
        $inscritManager = $this->get('inscrit_manager');
        if ($request->get('parent_id')) {
            $listeinscrits = $inscritManager->getListInscritEnfant($request->get('parent_id'));
        } else {
            $listeinscrits = $inscritManager->getListInscritEnfant();
        }
        if (null === $listeinscrits) {
            throw $this->createNotFoundException("Not Found");
        }
        return [
            'listes' => $listeinscrits,
        ];
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
