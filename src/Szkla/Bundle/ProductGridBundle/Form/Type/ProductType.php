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
                    'label'    => 'szkla.products.sku.label'
                ]
            )
        ;
    }

    /**
     *M-BM- {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class'            => 'Szkla\Bundle\ProductGridBundle\Entity\Products',
            ]
        );
    }

    public function getName()
    {
        return 'szkla_products';
    }
}