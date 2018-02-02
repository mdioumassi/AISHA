<?php
/**
 * Created by PhpStorm.
 * User: Mohamed
 * Date: 02/02/2018
 * Time: 09:43
 */

namespace InscriptionBundle\Services;


use Doctrine\ORM\EntityManager;
use InscriptionBundle\Entity\Mensualite;

class MensualiteManager
{
    private $em;
    private $repository;
    private $form;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
        $this->repository = $this->em->getRepository(Mensualite::class);
    }


    public function getMensualitesEnfant($enfantId)
    {
        return $this->repository->findMensualiteByEnfant($enfantId);
    }
}