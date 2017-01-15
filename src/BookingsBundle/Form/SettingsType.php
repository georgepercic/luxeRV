<?php

namespace BookingsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dailyMiles')
            ->add('defaultPickUpTime', TimeType::class, [
                'label' => 'Delivery Time',
                'widget' => 'single_text',
            ])
            ->add('defaultDropOffTime', TimeType::class, [
                'label' => 'Return Time',
                'widget' => 'single_text',
            ])
            ->add('defaultMinRentDays', null, [
                'label' => 'Min. Rental Days',
            ])
            ->add('taxRate', null, [
                'label' => 'Tax Rate (%)',
            ])
            ->add('depositAmountRate', null, [
                'label' => 'Deposit Amount (%)',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BookingsBundle\Entity\Settings',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bookingsbundle_settings';
    }
}
