<?php

namespace InscriptionBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\IsTrue;

class EnfantType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', TextType::class, [
                    'attr' => array(
                        'class' => 'w3-input w3-border',
                        'placeholder' => 'Nom'
                    ),
                    'label' => false
                ])
                ->add('prenom',TextType::class, [
                    'attr' => array(
                        'class' => 'w3-input w3-border',
                        'placeholder' => 'Prenom'
                    ),
                    'label' => false
                ])
                ->add('dateNaissance', BirthdayType::class, [
                    'widget' =>'single_text',
                    'format' => 'dd-MM-yyyy',
                    'html5' => false,
                    'attr'  => [
                      //  'class' => 'form-control input-inline datepicker',
                      //  'data-provide' => 'datepicker',
                     //   'data-date-format' => 'dd-mm-yyyy',
                        'placeholder' => 'Date de naissance'
                    ],
                    'label' => false
                ])
                ->add('genre', ChoiceType::class, [
                    'choices' => [
                        'Garçon' => 'Garçon',
                        'Fille' => 'Fille'
                    ],
                 //   'constraints' => new IsTrue(['message'=>'Needs to be clicked']),
                    'label_attr' => ['class' =>'radio-inline'],
                    'multiple' => false,
                    'expanded' => true,
                    'label' => false
                ]);
              /*  ->add('niveau', EntityType::class, [
                    'class' => 'InscriptionBundle\Entity\Niveau',
                    'choice_label' => 'classe',
                    'placeholder' => 'Classe',
                    'label' => false
                ]);*/
                //->add('parentId', HiddenType::class)
    //            ->add('submit', SubmitType::class, [
    //                'attr' => ['class' => 'btn btn-primary'],
    //                'label' => 'Enregistrer'
    //            ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InscriptionBundle\Entity\Enfant'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'inscriptionbundle_enfant';
    }


}
