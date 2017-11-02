<?php

namespace InscriptionBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraint as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;

class MatiereType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('libelle', TextType::class, [
                'attr' => array(
                    'class' => 'w3-input w3-border',
                    'placeholder' => 'Libellé'
                ),
                'label' => false,
                'constraints' => [
                    new NotBlank(
                        array('message' => 'Il faut choisir un libellé')
                    )
                ],
                ])
                ->add('description', TextareaType::class, [
                    'attr' => array(
                        'class' => 'w3-input w3-border',
                        'placeholder' => 'Description'
                    )
                 ])
                ->add('coefficient', TextType::class, [
                    'constraints' => array(
                        new NotBlank(
                            array('message' => 'Il faut choisir un libellé')
                        )
                    ),
                    'attr' => array(
                        'class' => 'w3-input w3-border',
                        'placeholder' => 'Coefficient'
                    ),
                    'label' => false
                ]);
                //->add('niveau');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InscriptionBundle\Entity\Matiere'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'inscriptionbundle_matiere';
    }


}
