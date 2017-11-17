<?php

namespace InscriptionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscritType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('frais', IntegerType::class, [
                    'label' => false,
                     'attr' => [
                         'placeholder' => 'Frais d\'inscription',
                     ]
                ])
                ->add('paye', CheckboxType::class, [
                    'label' => 'Payé'
                ])
                ->add('annee', IntegerType::class, [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Année en cours',
                    ]
                ])
                ->add('enfant', EnfantType::class)
                ->add('niveau', NiveauType::class);
                    /*  ->add('niveau', EntityType::class, [
                    'class' => 'InscriptionBundle\Entity\Niveau',
                    'choice_label' => 'classe',
                    'placeholder' => 'Classe',
                    'label' => false
                ]);*/
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InscriptionBundle\Entity\Inscrit'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'inscriptionbundle_inscrit';
    }


}
