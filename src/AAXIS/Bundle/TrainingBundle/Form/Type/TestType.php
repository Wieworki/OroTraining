<?php

namespace AAXIS\Bundle\TrainingBundle\Form\Type;

use AAXIS\Bundle\TrainingBundle\Entity\Test;
use AAXIS\Bundle\TrainingBundle\Entity\TestTypeAttr;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for Test entity.
 */
class TestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Test::class
        ]);
    }
}
