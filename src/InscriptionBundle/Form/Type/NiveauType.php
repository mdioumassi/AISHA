<?php

namespace InscriptionBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NiveauType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('classe', TextType::class, [
                    'attr' => [
                        'placeholder' => 'Classe'
                    ],
                    'label' => false
                ])
                ->add('description', TextareaType::class, [
                    'attr' => [
                        'placeholder' => 'Description'
                    ],
                    'label' => false
                ])
                ->add('mensualite', IntegerType::class, [
                    'attr' => [
                        'placeholder' => 'Mensualité'
                    ],
                    'label' => false
                ])
                ->add('matieres', CollectionType::class, [
                    'entry_type'   => MatiereType::class,
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'label' => false
                ])
                ->add("Enregistrer", SubmitType::class, [
                    'attr' => [
                        'class' => 'w3-button w3-blue'
                    ]
                ]);
        /* ->add('submit', SubmitType::class, [
             'attr' => [
                 'class' => 'btn btn-primary',
             ],
             'label' => 'Enregistrer'
         ]);*/
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InscriptionBundle\Entity\Niveau'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'inscriptionbundle_niveau';
    }
}
