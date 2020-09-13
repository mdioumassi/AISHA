<?php


namespace InscriptionBundle\Services;


use Doctrine\ORM\EntityManager;


Class AbstractManager
{
    protected $em;
    protected $repository;
    protected $form;

    /**
     * EnfantManager constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
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