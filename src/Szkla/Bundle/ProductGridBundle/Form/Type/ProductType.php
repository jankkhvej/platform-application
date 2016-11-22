<?php

namespace Szkla\Bundle\ProductGridBundle\Form\Type;

//use Doctrine\Common\Persistence\ManagerRegistry;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


/**
 * Class ProductType
 */
class ProductType extends AbstractType
{
    /**
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     *
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'sku',
                'text',
                [
                    'required' => true,
                    'label'    => 'szkla.products.sku.label',
                ]
            )
            ->add(
                'isActive',
                'choice',
                [
                    'label' => 'Active?',
                    'required' => true,
                    'choices' => ['Inactive', 'Active'],
                    'empty_value' => 'Please select',
                    'empty_data' => '',
                    'auto_initialize' => false,
                ]
            )
            ->add(
                'integerValues',
                'oro_collection',
                [
                    'required' => false,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                ]
            )
            ->add(
                'decimalValues',
                'oro_collection',
                [
                    'required' => false,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                ]
            )
            ->add(
                'datetimeValues',
                'oro_collection',
                [
                    'required' => false,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                ]
            )
            ->add(
                'varcharValues',
                'oro_collection',
                [
                    'required' => false,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                ]
            )
            ->add(
                'textValues',
                'oro_collection',
                [
                    'required' => false,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                ]
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class'            => 'Szkla\Bundle\ProductGridBundle\Entity\Product',
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'szkla_products';
    }
}