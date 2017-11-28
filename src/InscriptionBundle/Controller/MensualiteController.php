<?php

namespace InscriptionBundle\Controller;

use InscriptionBundle\Entity\Mensualite;
use InscriptionBundle\Form\MensualiteType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;

class MensualiteController extends Controller
{
    /**
     * @Route("mensualite/enfant/{enfant_id}", name="mensualite_child")
     * @Template("@Inscription/Inscription/Mensualite/mensualite.html.twig")
     */
    public function getMensualiteAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $inscrit = $em->getRepository('InscriptionBundle:Inscrit')
                          ->findByEnfant($request->get('enfant_id'));

        $enfant = $inscrit->getEnfant();
        $mensualites = $enfant->getMensualites();

        if (null === $mensualites) {
            throw $this->createNotFoundException("Not Found");
        }

        return [
          'mensualites' => $mensualites,
          'classe' => $inscrit->getNiveau(),
            'cout' => $inscrit->getNiveau()->getMensualite(),
          'enfant_id' => $enfant->getId()
        ];
    }

    /**
     * @Route("mensualite/enfant/{enfant_id}/add", name="add_mensualite")
     * @Template("@Inscription/Inscription/Mensualite/ajouter.html.twig")
     */
    public function addMensualiteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $enfant = $em->getRepository('InscriptionBundle:Enfant')
                     ->findByClasse($request->get('enfant_id'));

        if (empty($enfant)) {
            throw  $this->createNotFoundException('Not found enfant');
        }

        $mensualite = new Mensualite();
        $mensualite->setEnfant($enfant->getEnfant());
        $mensualite->setNiveau($enfant->getNiveau());
        $form = $this->createForm(MensualiteType::class, $mensualite);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->persist($mensualite);
            $em->flush();
            return $this->redirectToRoute('mensualite_child', [
                'enfant_id' => $enfant->getEnfant()->getId()
            ]);
        }

        return [
            'form' => $form->createView(),
            'enfant' => $enfant->getEnfant()->getId()
        ];
    }

    /**
     * @Route("mensualite/{id}/delete", name="del_mensualite")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $mensuel = $em->getRepository('InscriptionBundle:Mensualite')
                      ->find($id);
        if (null === $mensuel) {
            throw $this->createNotFoundException('Not Found');
        }
        $em->remove($mensuel);
        $em->flush();

        return $this->redirectToRoute('mensualite_child', [
            'enfant_id' => $mensuel->getEnfant()->getId(),
        ]);
    }
}
