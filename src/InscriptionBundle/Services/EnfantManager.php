<?php
namespace InscriptionBundle\Services;

use Doctrine\ORM\EntityManager;
use InscriptionBundle\Entity\Enfant;

class EnfantManager extends AbstractManager
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);
        $this->repository = $this->em->getRepository(Enfant::class);
    }

    /**
     * @return array
     */
    public function getEnfants()
    {
        return $this->repository->findBy(['activated' => true]);
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
