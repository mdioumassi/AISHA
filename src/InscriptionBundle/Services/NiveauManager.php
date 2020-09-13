<?php
namespace InscriptionBundle\Services;

use Doctrine\ORM\EntityManager;
use InscriptionBundle\Entity\Niveau;

class NiveauManager extends AbstractManager
{
    public function __construct(EntityManager $entityManager)
    {
        $this->manager($entityManager);
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
}
