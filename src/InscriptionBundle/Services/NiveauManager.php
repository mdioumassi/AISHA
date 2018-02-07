<?php
namespace InscriptionBundle\Services;
use Doctrine\ORM\EntityManager;
use InscriptionBundle\Entity\Niveau;

class NiveauManager
{
    private $em;
    private $repository;
    private $form;


    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
        $this->repository = $this->em->getRepository(Niveau::class);
    }

    public function getAll()
    {
        return $this->repository->findAll();
    }

    public function getOne($id)
    {
        return $this->repository->find($id);
    }

    public function getElevesByNiveau($classeId)
    {
        return $this->repository->findElevesByNiveau($classeId);
    }

    public function setForm($form)
    {
        $this->form = $form;
        return $this;
    }

    public function create()
    {
        $niveau = $this->form->getData();
        $this->flush($niveau);
    }

    public function flush($niveau)
    {
        $this->em->persist($niveau);
        $this->flush();
    }
}