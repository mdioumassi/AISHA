<?php

namespace InscriptionBundle\Services;

use Doctrine\ORM\EntityManager;
use InscriptionBundle\Entity\Parents;

/**
 * Class ParentManager
 * @package InscriptionBundle\Services
 */
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

    public function getSearchParentByTelephone($telephone)
    {
        return $this->repository->findOneBy(['telephone' => $telephone]);
    }

    public function getOne($parentId)
    {
        return $this->repository->find($parentId);
    }

    /**
     * @return array
     */
    public function getParents()
    {
        return $this->repository->findBy(['activated' => true]);
    }

    /**
     * @param $parentId
     * @return null|object
     */
    public function getParentById($parentId)
    {
        return $this->repository->find($parentId);
    }

    /**
     * @param $parent
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove($parent)
    {
        $this->em->remove($parent);
        $this->em->flush();
    }

    public function deletedParent($parent)
    {
        $parentenfants = $this->repository->isDeleted($parent);
        foreach ($parentenfants as $parent){
            foreach ($parent->getEnfants() as $enfants){
                $parent->setActivated(false);
                $enfants->setActivated(false);
            }
        }
        $this->flush($parent);
        $this->flush($enfants);
    }

    /**
     * @param $form
     * @return $this
     */
    public function setForm($form)
    {
        $this->form = $form;
        return $this;
    }

    /**
     * Persister les données du formulaire
     */
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
