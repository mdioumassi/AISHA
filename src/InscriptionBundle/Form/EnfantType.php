<?php

namespace InscriptionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;

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
                    )
                ])
                ->add('prenom',TextType::class, [
                    'attr' => array(
                        'class' => 'w3-input w3-border',
                        'placeholder' => 'Prenom'
                    )
                ])
                ->add('dateNaissance', BirthdayType::class, [
                    'widget' =>'single_text',
                    'html5' => false,
                    'attr'  => [
                        'class' => 'js-datepicker',
                        'placeholder' => 'Date de naissance'
                    ]
                ])
                ->add('genre', ChoiceType::class, [
                    'choices' => [
                        'Garçon' => 'Garçon',
                        'Fille' => 'Fille'
                    ]
                ]);
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
