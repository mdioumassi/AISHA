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

    /**
     * @param mixed $form
     * @return MensualiteManager
     */
    public function setForm($form)
    {
        $this->form = $form;
        return $this;
    }

    public function create()
    {
        if ($this->form->isValid()){
            $this->persist($this->form->getData());
        }
    }

    public function persist($data)
    {
        $this->em->persist($data);
        $this->em->flush();
    }

    /**
     * @param $enfantId
     * @return mixed
     */
    public function getMensualitesEnfant($enfantId)
    {
        return $this->repository->findMensualiteByEnfant($enfantId);
    }

    public function getInscritOne($enfantId)
    {
        return $this->repository->findInscritByEnfant($enfantId);
    }
}