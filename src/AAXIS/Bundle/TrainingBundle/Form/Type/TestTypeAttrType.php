<?php

namespace AAXIS\Bundle\TrainingBundle\Form\Type;

use AAXIS\Bundle\TrainingBundle\Entity\TestTypeAttr;
use Oro\Bundle\FormBundle\Form\Type\CollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for Test entity.
 */
class TestTypeAttrType extends AbstractType
{
    public const NAME = 'aaxis_training_test_type_attr';

    /**
     * {@inheritdoc}
     */
    public function getParent(): ?string
    {
        return CollectionType::class;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'name',
                TextType::class,
                ['label' => 'aaxis.training.testtypeattr.name.label', 'required' => true]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TestTypeAttr::class
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->getBlockPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return self::NAME;
    }
}
