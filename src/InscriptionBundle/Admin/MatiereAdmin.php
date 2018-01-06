<?php

namespace InscriptionBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;

class MatiereAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('libelle')
            ->add('description')
            ->add('coefficient')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('libelle')
            ->add('description')
            ->add('coefficient')
            ->add('niveau')
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
            ->with('Matière', array('class' => 'col-md-6'))
            ->add('libelle')
            ->add('description')
            ->add('coefficient')
            ->end()
            ->with('Classe', array('class' => 'col-md-6'))
            ->add('niveau', ModelType::class, [
                'btn_add' => true
            ])
            ->end()
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('libelle')
            ->add('description')
            ->add('coefficient')
        ;
    }
}
