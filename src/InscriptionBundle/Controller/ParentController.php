<?php

namespace InscriptionBundle\Controller;

use InscriptionBundle\Entity\Parents;
use InscriptionBundle\Form\ParentsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
        if (empty($parents)) {
            throw $this->createNotFoundException('Parents not found');
        }
        return [
            'parents' => $parents
        ];
    }

    /**
     * @Route("/parents/ajouter", name ="add_parents")
     * @Template("@Inscription/Inscription/Parent/ajouter.html.twig")
     */
    public function postParentsAction(Request $request){
        $parent = new Parents();
        $form = $this->createForm(ParentsType::class, $parent);
        $form->handleRequest($request);
        if ($request->isMethod('POST') && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($parent);
            $em->persist($parent);
            $em->flush();
            return $this->redirectToRoute('ajout_enfant', [
                'parent_id' =>$parent->getId(),
            ]);
        }
        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("parents/{id}/delete", name="parent_delete")
     *
     */
    public function deleteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $parent = $em->getRepository('InscriptionBundle:Parents')
                     ->find($request->get('id'));
        if (empty($parent)) {
            throw $this->createNotFoundException('Not found parent');
        }
        $em->remove($parent);
        $em->flush();
        return $this->redirectToRoute('liste_parents');
    }

    /**
     * @Route("/parent/{id}/edit", name = "parent_update")
     */
    public function updateParentAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $parent = $em->getRepository('InscriptionBundle:Parents')
                  ->find($request->get('id'));
        if (empty($parent)) {
            throw $this->createNotFoundException('Not found parent');
        }
        $form = $this->createForm(ParentsType::class, $parent);
        $form->handleRequest($request);
        if ($request->isMethod('POST') && $form->isValid()) {
            $em->persist($parent);
            $em->flush();
            return $this->redirectToRoute('liste_parents');
        }
        return $this->render('@Inscription/Inscription/Parent/modifier.html.twig', [
           'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/parent/{id}/detail", name = "parent_display")
     */
    public function displayParentAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $parent = $em->getRepository('InscriptionBundle:Parents')
            ->find($request->get('id'));
        if (empty($parent)) {
            throw $this->createNotFoundException('Not found parent');
        }

        return $this->render('@Inscription/Inscription/Parent/detail.html.twig', [
           'parent' => $parent
        ]);
    }
}
