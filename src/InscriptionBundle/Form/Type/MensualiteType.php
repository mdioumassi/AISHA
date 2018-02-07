<?php

namespace InscriptionBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MensualiteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('mois', ChoiceType::class, [
                    'placeholder' => 'Le mois',
                     'choices' => [
                         'Janvier' => 'janvier',
                         'Février' => 'fevrier',
                         'Mars'    => 'mars',
                     ],
                     'label' => false
                 ])
                ->add('paye')
                ->add('commentaire', TextareaType::class, [
                    'attr' => ['placeholder' => 'Commentaire'],
                    'label' => false,
                    'required' => false
                ]);
               // ->add('enfant', EnfantType::class, [
               //     'label' => false
                //])
               //->add('niveau', NiveauType::class, [
                 //  'label' => false
               //]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InscriptionBundle\Entity\Mensualite'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'inscriptionbundle_mensualite';
    }


}
