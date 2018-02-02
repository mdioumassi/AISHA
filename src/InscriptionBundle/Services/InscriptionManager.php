<?php
/**
 * Created by PhpStorm.
 * User: Mohamed
 * Date: 02/02/2018
 * Time: 00:05
 */

namespace InscriptionBundle\Services;


use Doctrine\ORM\EntityManager;

class InscriptionManager
{
    private $em;
    private $form;
    private $repository;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
       // $this->repository = $this->em->g
    }
}