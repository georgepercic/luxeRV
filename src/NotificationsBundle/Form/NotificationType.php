<?php

namespace NotificationsBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NotificationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class)
            ->add('phone', TextType::class)
            ->add('events', ChoiceType::class, array(
                'choices'  => array(
                    '' => '',
                    'Booking Opened' => 'opened',
                    'Booking Completed' => 'completed',
                    'Booking Pending' => 'pending',
                    'Customer Request' => 'request',
                ),
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NotificationsBundle\Entity\Notification',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'notificationsbundle_notification';
    }
}
