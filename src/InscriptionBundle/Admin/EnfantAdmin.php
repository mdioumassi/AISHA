<?php

namespace InscriptionBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EnfantAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nom')
            ->add('prenom')
            ->add('genre')
            ->add('parent')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('nom')
            ->add('prenom')
            ->add('dateNaissance')
            ->add('genre')
            ->add('parent')
            ->add('mensualites')
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
            ->with('Enfant', array('class' => 'col-md-6'))
                ->add('nom')
                ->add('prenom')
                 ->add('dateNaissance', 'sonata_type_date_picker')
            ->add('genre', ChoiceType::class, [
                'choices' => [
                    'Garçon' => 'Garçon',
                    'Fille' => 'Fille'
                ],
                //   'constraints' => new IsTrue(['message'=>'Needs to be clicked']),
                'label_attr' => ['class' =>'radio-inline'],
                'multiple' => false,
                'expanded' => true,
                'label' => 'Genre'
            ])
            ->end()
            ->with('Parent', array('class' => 'col-md-6'))
               ->add('parent', ModelAutocompleteType::class, [
                   'property'=>'nom',
                   'placeholder'=>'Selectionner',
                  //'label'=>'town.name',
                  // 'model_manager'=> null,
                   'btn_add' => true,
               ])
            ->end()
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('nom')
            ->add('prenom')
            ->add('dateNaissance')
            ->add('genre')
        ;
    }
}
