<?php
/**
 * Created by PhpStorm.
 * User: Mohamed
 * Date: 12/02/2018
 * Time: 00:05
 */

namespace InscriptionBundle\Controller\ApiWeb;

use FOS\RestBundle\Controller\Annotations as Rest;
use InscriptionBundle\Entity\Inscrit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class InscriptionApiController extends Controller
{

    /**
     * @Rest\View(statusCode=Response::HTTP_OK)
     * @Rest\Get("/inscrits", name="api_les_inscrits")
     * @param Request $request
     * @return array
     */
    public function getInscritAction(Request $request)
    {
        $inscritManager = $this->get('inscrit_manager');

        return $inscritManager->getListInscritEnfant();
    }
}
