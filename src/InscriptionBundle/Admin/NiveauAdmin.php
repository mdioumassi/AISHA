<?php

namespace InscriptionBundle\Admin;


use InscriptionBundle\Entity\Matiere;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
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
            ->add('matieres', 'sonata_type_collection', [
                'type_options' => [
                    'delete' => false,
                    'delete_options' => [
                        // You may otherwise choose to put the field but hide it
                        'type'         => 'hidden',
                        // In that case, you need to fill in the options as well
                        'type_options' => [
                            'mapped'   => false,
                            'required' => false,
                        ]
                    ]
                ]
            ], [
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position',
            ])
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
