<?php
namespace InscriptionBundle\Services;


use Doctrine\ORM\EntityManager;
use InscriptionBundle\Entity\Enfant;

class EnfantManager
{
    private $em;
    private $repository;
    private $form;


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

    public function create()
    {
        $enfant = $this->form->getData();
        $this->flush($enfant);
    }

    public function update()
    {
        $enfant = $this->form->getData();
        $this->flush($enfant);
    }

    public function flush($enfant)
    {
        $this->em->persist($enfant);
        $this->em->flush();
    }

    public function getEnfants()
    {
        $enfants = $this->repository->findAll();

        if(empty($enfants)){
            throw $this->createNotFoundException('Not found enfants');
        }

        return $enfants;
    }

    public function getParentById($parentId)
    {
        return $this->repository->find($parentId);
    }

    public function getNiveauEnfants($parentId)
    {
        return $this->repository->findNiveauxEnfants($parentId);
    }

    public function getEnfantById($enfantId)
    {
        $enfant = $this->repository->find($enfantId);
        return $enfant;
    }

    public function getEnfantByClasse($enfantId)
    {
       return $this->repository->findByClasse($enfantId);
    }
}