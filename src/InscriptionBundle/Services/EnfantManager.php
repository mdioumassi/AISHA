<?php
namespace InscriptionBundle\Services;

use Doctrine\ORM\EntityManager;
use InscriptionBundle\Entity\Enfant;

class EnfantManager
{
    private $em;
    private $repository;
    private $form;


    /**
     * EnfantManager constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
        $this->repository = $this->em->getRepository(Enfant::class);
    }

    /**
     * @param mixed $form
     * @return EnfantManager
     */
    public function setForm($form)
    {
        $this->form = $form;
        return $this;
    }

    /**
     *
     */
    public function create()
    {
        $enfant = $this->form->getData();
        $this->flush($enfant);
    }

    /**
     *
     */
    public function update()
    {
        $enfant = $this->form->getData();
        $this->flush($enfant);
    }

    /**
     * @param $enfant
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function flush($enfant)
    {
        $this->em->persist($enfant);
        $this->em->flush();
    }

    /**
     * @return array
     */
    public function getEnfants()
    {
        return $this->repository->findAll();
    }

    /**
     * @param $parentId
     * @return mixed
     */
    public function getNiveauEnfants($parentId)
    {
        return $this->repository->findNiveauxEnfants($parentId);
    }

    /**
     * @param $enfantId
     * @return null|object
     */
    public function getOne($enfantId)
    {
        return $this->repository->find($enfantId);
    }

    /**
     * @param $enfantId
     * @return mixed
     */
    public function getEnfantByClasse($enfantId)
    {
        return $this->repository->findByClasse($enfantId);
    }

    /**
     * @param $enfant
     * @return null|object
     */
    public function getEnfantById($enfant)
    {
        return $this->repository->find($enfant);
    }
}
