<?php

namespace InscriptionBundle\Admin;


use InscriptionBundle\Entity\Matiere;
use InscriptionBundle\Form\MatiereType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class NiveauAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('classe')
            ->add('description')
            ->add('mensualite')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('classe')
            ->add('description')
            ->add('mensualite')
            ->add('matieres')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Classe', array('class' => 'col-md-4'))
                ->add('classe')
                ->add('description')
                ->add('mensualite')
            ->end()
            ->with('Matières', array('class' => 'col-md-8'))
            ->add('matieres')
            ->end()
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('classe')
            ->add('description')
            ->add('mensualite')
            ->add('createdAt')
        ;
    }
}
