<?php

namespace InscriptionBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
                          ->findFicheByEnfant($request->get('enfant_id'));

        $enfant = $inscrit->getEnfant();
        $mensualites = $enfant->getMensualites();

        if (null === $mensualites) {
            throw $this->createNotFoundException("Not Found");
        }

        return [
          'mensualites' => $mensualites
        ];
    }
}
