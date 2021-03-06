<?php

namespace VehicleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use VehicleBundle\Entity\Vehicle;

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
            ->add('vehicleStatus', ChoiceType::class, [
                'choices' => [
                    Vehicle::STATUS_AVAILABLE => Vehicle::STATUS_AVAILABLE,
                    Vehicle::STATUS_IN_USE => Vehicle::STATUS_IN_USE,
                    Vehicle::STATUS_NEED_MAINTENANCE => Vehicle::STATUS_NEED_MAINTENANCE,
                    Vehicle::STATUS_AT_MECHANIC => Vehicle::STATUS_AT_MECHANIC,
                    Vehicle::STATUS_AT_BODY_SHOP => Vehicle::STATUS_AT_BODY_SHOP,
                    Vehicle::STATUS_NOT_AVAILABLE => Vehicle::STATUS_NOT_AVAILABLE,
                ],
                'label' => 'State',
            ])
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
