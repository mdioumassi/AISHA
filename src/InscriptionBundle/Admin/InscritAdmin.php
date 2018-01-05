<?php

namespace InscriptionBundle\Admin;

use InscriptionBundle\Form\EnfantType;
use InscriptionBundle\Form\NiveauType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;

class InscritAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('enfant')
            ->add('niveau')
            ->add('paye')
            ->add('annee')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('enfant')
            ->add('niveau')
            ->add('frais')
            ->add('paye')
            ->add('annee')
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
            ->with('Inscription', array('class' => 'col-md-4'))
                ->add('frais')
                ->add('paye')
                ->add('annee')
            ->end()
            ->with('Enfant', array('class' => 'col-md-4'))
            ->add('enfant', ModelType::class, [
                'btn_add' => true,
            ])
            ->end()
            ->with('Classe', array('class' => 'col-md-4'))
            ->add('niveau', ModelType::class, [
                'btn_add' => true,
            ])
            ->end()
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('frais')
            ->add('paye')
            ->add('annee')
        ;
    }
}
