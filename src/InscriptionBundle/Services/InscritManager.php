<?php
/**
 * Created by PhpStorm.
 * User: Mohamed
 * Date: 02/02/2018
 * Time: 09:48
 */

namespace InscriptionBundle\Services;
use Doctrine\ORM\EntityManager;
use InscriptionBundle\Entity\Inscrit;

class InscritManager
{
    private $em;
    private $repository;
    private $form;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
        $this->repository = $this->em->getRepository(Inscrit::class);
    }

    /**
     * @param mixed $form
     * @return InscritManager
     */
    public function setForm($form)
    {
        $this->form = $form;
        return $this;
    }

    public function create()
    {
        $inscrit = $this->form->getData();
        $this->flush($inscrit);
    }

    public function flush($inscrit)
    {
        $this->em->persist($inscrit);
        $this->em->flush();
    }

    public function getOne($inscritId)
    {
        return $this->repository->find($inscritId);
    }
}