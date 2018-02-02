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
     * @Template("@Inscription/Inscription/Parent/liste.html.twig")
     */
    public function getParentsAction(){
        $manager = $this->get('parent_manager');
        $parents = $manager->getParents();
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
        $parentManager = $this->get('parent_manager');
        $parent = new Parents();
        $form = $this->createForm(ParentsType::class, $parent);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $parentManager->setForm($form)->create();
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
        $parentManager = $this->get('parent_manager');
        $parent = $parentManager->getParentById($request->get('id'));
        if (empty($parent)) {
            throw $this->createNotFoundException('Not found parent');
        }
        $parentManager->remove($parent);
        return $this->redirectToRoute('liste_parents');
    }

    /**
     * @Route("/parent/{id}/edit", name = "parent_update")
     */
    public function updateParentAction(Request $request)
    {
        $parentManager = $this->get('parent_manager');
        $parent = $parentManager->getParentById($request->get('id'));
        if (empty($parent)) {
            throw $this->createNotFoundException('Not found parent');
        }
        $form = $this->createForm(ParentsType::class, $parent);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $parentManager->setForm($form)->update();
            return $this->redirectToRoute('liste_parents');
        }
        return $this->render('@Inscription/Inscription/Parent/form/parent.html.twig', [
           'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/parent/{id}/detail", name = "parent_display")
     */
    public function displayParentAction(Request $request)
    {
        $parentManager = $this->get('parent_manager');
        $parent = $parentManager->getParentById($request->get('id'));
        if (empty($parent)) {
            throw $this->createNotFoundException('Not found parent');
        }

        return $this->render('@Inscription/Inscription/Parent/detail.html.twig', [
           'parent' => $parent
        ]);
    }
}
