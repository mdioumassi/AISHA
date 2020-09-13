<?php


namespace InscriptionBundle\Services;


use Doctrine\ORM\EntityManager;


abstract Class AbstractManager
{
    protected $em;
    protected $repository;
    protected $form;

    /**
     * @param EntityManager $entityManager
     */
    public function manager(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param mixed $form
     */
    public function setForm($form)
    {
        $this->form = $form;
        return $this;
    }

    /**
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function flush()
    {
        $this->em->persist($this->form->getData());
        $this->em->flush();
    }

}