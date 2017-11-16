<?php

namespace InscriptionBundle\Form;

use InscriptionBundle\InscriptionBundle;
use InscriptionBundle\Repository\EnfantRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscritType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('enfant', EntityType::class,[
                'class' => 'InscriptionBundle\Entity\Enfant',
                'multiple' => false,
                'expanded' => true,
                'query_builder' => function (EnfantRepository $er){
                    return $er->createQueryBuilder('e');
                },
                'attr' => [
                    'class' => 'w3-radio'
                ]
            ])
            ->add('niveau', EntityType::class, [
                'class' => 'InscriptionBundle\Entity\Niveau',
                'choice_label' => 'classe',
                'multiple' => false,
                'expanded' => true
            ])
            ->add('submit', SubmitType::class, [
               'attr' => [
                   'classe' => 'btn btn-primary',
                   'label' => 'Enregistrer'
               ]
            ]);
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
