<?php

namespace InscriptionBundle\Admin;

use InscriptionBundle\Form\Type\EnfantType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\CollectionType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ParentsAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nom')
            ->add('prenom')
            ->add('civilite')
            ->add('fonction')
            ->add('telephone')
            ->add('addresse')
            ->add('type')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('nom')
            ->add('prenom')
            ->add('civilite')
            ->add('fonction')
            ->add('telephone')
            ->add('addresse')
            ->add('type')
            ->add('enfants')
            ->add('activated', null, [
                'attr' => [
                    'label' => 'Active'
                ]
            ])
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
            ->with('Parent', array('class' => 'col-md-6'))
            ->add('nom')
            ->add('prenom')
            ->add('civilite', ChoiceType::class, [
                'placeholder' => 'Civilité',
                'choices' => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme'
                ]
            ])
            ->add('type', ChoiceType::class, [
                'placeholder' => 'Lien de parenté',
                'choices' => [
                    'Pére' => 'pére',
                    'Mère' => 'mère',
                    'Oncle' => 'oncle',
                    'Tante' => 'tante',
                    'Frère' => 'frère',
                    'Soeur' => 'soeur'
                ]
            ])
            ->add('fonction')
            ->add('telephone')
            ->add('addresse')
            ->add('activated')
            ->end()
            ->with('Enfant', array('class' => 'col-md-6'))
                ->add('enfants', CollectionType::class, [
                    'entry_type'   => EnfantType::class,
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'label' => false
                ])
            ->end()
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('nom')
            ->add('prenom')
            ->add('civilite')
            ->add('fonction')
            ->add('telephone')
            ->add('addresse')
            ->add('type')
        ;
    }
}
