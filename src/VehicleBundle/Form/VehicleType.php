<?php

namespace VehicleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehicleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vin')
            ->add('brand')
            ->add('model')
            ->add('productionYear')
            ->add('mileage')
            ->add('weekDayPrice')
            ->add('weekEndPrice')
            ->add('color')
            ->add('unitNumber')
            ->add('licencePlateNumber')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'VehicleBundle\Entity\Vehicle',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'vehiclebundle_vehicle';
    }
}
