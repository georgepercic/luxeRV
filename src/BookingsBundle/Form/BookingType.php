<?php

namespace BookingsBundle\Form;

use BookingsBundle\Entity\Booking;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pickUpDate', DateTimeType::class, [
                'widget' => 'single_text',
                'format' => 'MM/DD/YYYY HH:mm',
                'label' => 'Delivery Date',
            ])
            ->add('dropOffDate', DateTimeType::class, [
                'widget' => 'single_text',
                'format' => 'MM/DD/YYYY HH:mm',
                'label' => 'Return Date',
            ])
            ->add('pickUpLocation', TextType::class, [
                'label' => 'Delivery Location',
            ])
            ->add('dropOffLocation', TextType::class, [
                'label' => 'Return Location',
            ])
            ->add('customer', EntityType::class, [
                'class' => 'CustomerBundle\Entity\Customer',
                'choice_label' => 'name',
                'label' => 'Services Requested',
            ])
            ->add('vehicle', EntityType::class, [
                'class' => 'VehicleBundle\Entity\Vehicle',
                'choice_label' => 'vinBrandModel',
                'label' => 'Vehicle',
            ])
            ->add('servicesRequested', null, [
                'label' => 'Services Requested',
            ])
            ->add('specialRequirements', null, [
                'label' => 'Special Requirements',
            ])
            ->add('bookingStatus', ChoiceType::class, [
                'choices' => [
                    Booking::STATUS_RESERVED => Booking::STATUS_RESERVED,
                    Booking::STATUS_ACCEPTED => Booking::STATUS_ACCEPTED,
                    Booking::STATUS_COMPLETED => Booking::STATUS_COMPLETED,
                    Booking::STATUS_CLOSED => Booking::STATUS_CLOSED,
                    Booking::STATUS_DISPUTE => Booking::STATUS_DISPUTE,
                ],
                'label' => 'Booking State',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BookingsBundle\Entity\Booking',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bookingsbundle_booking';
    }
}
