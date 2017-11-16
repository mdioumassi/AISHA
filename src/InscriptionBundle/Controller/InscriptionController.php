<?php

namespace InscriptionBundle\Controller;

use InscriptionBundle\Entity\Enfant;
use InscriptionBundle\Entity\Inscrit;
use InscriptionBundle\Entity\Parents;
use InscriptionBundle\Form\EnfantType;
use InscriptionBundle\Form\InscritType;
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
            return $this->redirectToRoute('inscr_niveau',[
                'parent_id' => $parent->getId()
            ]);
        }

        return $this->render('@Inscription/Inscription/Inscrit/parent.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/inscription/enfant", name="inscr_enfant")
     */
   /* public function addEnfantAction(Request $request)
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
            return $this->redirectToRoute('inscr_niveau', [
                'enfant_id' => $enfant->getId()
            ]);
        }
        return $this->render('@Inscription/Inscription/Inscrit/enfant.html.twig', [
            'form' => $form->createView()
        ]);
    }*/

    /**
     * @Route("/inscription/niveau", name="inscr_niveau")
     */
    public function addNiveauAction(Request $request)
    {
        $enfants = $this->Em()->getRepository('InscriptionBundle:Parents')
            ->findByParent($request->get('parent_id'));

        $niveaux = $this->Em()->getRepository('InscriptionBundle:Parents')
            ->findByNiveau($request->get('parent_id'));

        if (empty($enfants)) {
            throw  $this->createNotFoundException('Not found enfant');
        }
        $inscrit = new Inscrit();

        foreach ($enfants as $enfant){
            $inscrit->setEnfant($enfant);
        }

        foreach ($niveaux as $niveau){
            $inscrit->setNiveau($niveau);
        }

        $form = $this->createForm(InscritType::class, $inscrit);
        $form->handleRequest($request);
        if ($request->isMethod('POST') && $form->isValid()) {
            $this->Em()->persist($inscrit);
            $this->Em()->flush();
        }
        $form = $this->createForm(InscritType::class, $inscrit);
        return $this->render('@Inscription/Inscription/Inscrit/inscrit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
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
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    private function Em()
    {
        return $this->getDoctrine()->getManager();
    }
}
