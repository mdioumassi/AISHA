<?php

namespace InscriptionBundle\Form;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParentsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', TextType::class, [
                    'attr' => [
                        'class' => 'w3-input w3-border',
                        'placeholder' => 'Nom'
                    ],
                    'label' => false
                ])
                ->add('prenom', TextType::class, [
                    'attr' => [
                        'class' => 'w3-input w3-border',
                        'placeholder' => 'Prenom'
                    ],
                     'label' => false
                ])
                ->add('civilite', ChoiceType::class, [
                    'placeholder' => 'Civilité',
                    'choices' => [
                        'Homme' => 'Homme',
                        'Femme' => 'Femme'
                    ],
                    'expanded' => true,
                    'label_attr' => ['class' => 'radio-inline'],
                    'label' => 'Civilié : '
                ])
                ->add('fonction', TextType::class, [
                    'attr' => [
                        'class' => 'w3-input w3-border',
                        'placeholder' => 'Fonction'
                    ],
                    'label' => false
                ])
                ->add('type', ChoiceType::class, [
                    'placeholder' => 'Type de parent',
                    'choices' => [
                        'Pére' => 'pére',
                        'Mère' => 'mère',
                        'Oncle' => 'oncle',
                        'Tante' => 'tante',
                        'Frère' => 'frère',
                        'Soeur' => 'soeur'
                    ],
                    'label' => false
                ])
                ->add('telephone', TextType::class, [
                    'attr' => [
                        'class' => 'w3-input w3-border',
                        'placeholder' => 'Téléphone'
                    ],
                    'label' => false
                ])
                ->add('addresse', TextareaType::class, [
                    'attr' => [
                        'class' => 'w3-input w3-border',
                        'placeholder' => 'Adresse'
                    ],
                    'label' => false
                ]);
                /*->add('enfants', CollectionType::class,[
                    'entry_type' => EnfantType::class,
                    'allow_add'  => true,
                    'allow_delete' => true,
                    'by_reference' => false
                ]);
                /*->add('submit', SubmitType::class, [
                    'attr' => ['class' => 'btn btn-primary'],
                    'label' => 'Enregistrer'
                ]);*/
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InscriptionBundle\Entity\Parents'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'inscriptionbundle_parents';
    }


}
