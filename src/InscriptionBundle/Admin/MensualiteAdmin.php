<?php

namespace InscriptionBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MensualiteAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('enfant')
            ->add('mois')
            ->add('paye')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('enfant')
            ->add('niveau')
            ->add('mois')
            ->add('paye')
            ->add('commentaire')
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
            ->with('Mensuel', array('class' => 'col-md-6'))
                ->add('mois', ChoiceType::class, [
                    'choices' => [
                        'Janvier' => 'janvier',
                        'Février' => 'fevrier',
                        'Mars'    => 'mars',
                    ],
                    'label' => false
                ])
                ->add('paye')
                ->add('commentaire')
            ->end()
            ->with('Enfant', ['class' => 'col-md-6'])
                ->add('enfant', null, [
                    'label' => false
                ])
            ->end()
            ->with('Classe', ['class' => 'col-md-6'])
                ->add('niveau', null, [
                    'label' => false
                ])
            ->end()
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('mois')
            ->add('paye')
            ->add('commentaire')
        ;
    }
}
