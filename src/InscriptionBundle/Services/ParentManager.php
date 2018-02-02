<?php

namespace InscriptionBundle\Services;


use Doctrine\ORM\EntityManager;
use InscriptionBundle\Entity\Parents;

class ParentManager
{
    private $em;
    private $repository;
    private $form;


    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
        $this->repository = $this->em->getRepository(Parents::class);
    }

    public function getParents()
    {
        return $this->repository->findAll();
    }

    public function getParentById($parentId)
    {
        return $this->repository->find($parentId);
    }

    public function remove($parent)
    {
        $this->em->remove($parent);
        $this->em->flush();
    }
    public function setForm($form)
    {
        $this->form = $form;
        return $this;
    }

    public function create()
    {
        if ($this->form->isValid()) {
            $parent = $this->form->getData();
            $this->flush($parent);
        }
    }

    public function update()
    {
        $parent = $this->form->getData();
        $this->flush($parent);
    }

    private function flush($parent)
    {
        $this->em->persist($parent);
        $this->em->flush();
    }
}