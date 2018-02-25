<?php
namespace InscriptionBundle\Form\Handler;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class ParentHandler
{
    private $form;
    private $request;
    private $em;


    public function __construct(Form $form, Request $request, EntityManager $em)
    {
        $this->form = $form;
        $this->request = $request;
        $this->em = $em;
    }

    public function process()
    {
        $this->form->handleRequest($this->request);
        if ($this->request->isMethod('POST') && $this->form->isValid()) {
            $this->onSuccess();
        } else {
            return false;
        }
    }

    public function getForm()
    {
        return $this->form;
    }

    public function onSuccess()
    {
        $parent = $this->form->getData();
        $this->em->persist($parent);
        $this->em->flush();
    }
}
