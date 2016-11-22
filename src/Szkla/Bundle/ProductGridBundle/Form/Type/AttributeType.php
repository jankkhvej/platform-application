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
 * Class AttributeType
 */
class AttributeType extends AbstractType
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
                'attributeName',
                'text',
                [
                    'required' => true,
                    'label'    => 'szkla.attributes.name.label'
                ]
            )
            ->add(
                'attributeType',
                'choice',
                [
                    'label' => 'Type',
                    'required' => true,
                    'choices' => [
                        'integer' => 'integer',
                        'decimal' => 'decimal',
                        'datetime' => 'datetime',
                        'varchar' => 'varchar',
                        'text' => 'text',
                    ],
                    'empty_value' => 'Please select',
                    'empty_data' => '',
                    'auto_initialize' => false
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
                'data_class'            => 'Szkla\Bundle\ProductGridBundle\Entity\Attributes',
            ]
        );
    }

    public function getName()
    {
        return 'szkla_attributes';
    }
}