<?php

namespace InscriptionBundle\Controller;
use InscriptionBundle\Controller\ParentController;

use InscriptionBundle\Entity\Parents;
use InscriptionBundle\Form\ParentsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class InscriptionController extends Controller
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function indexAction(Request $request)
    {
        $parent = new Parents();
        $form = $this->createForm(ParentsType::class, $parent);
        $form->handleRequest($request);
        if ($request->isMethod('POST') && $form->isValid()) {
            $this->Em()->persist($parent);
            $this->Em()->flush();
            return $this->redirectToRoute();
        }

        return $this->render('@Inscription/Inscription/Inscription.html.twig',[
            'form' => $form->createView()
        ]);
    }

    public function postEnfant()
    {

    }
    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    private function Em()
    {
        return $this->getDoctrine()->getManager();
    }
}
