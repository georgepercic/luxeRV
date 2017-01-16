<?php

namespace EmployeeBundle\Form;

use EmployeeBundle\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('dob', TextType::class)
            ->add('ssn')
            ->add('addressCity')
            ->add('addressState')
            ->add('addressZip')
            ->add('addressStreet')
            ->add('addressSuiteNo')
            ->add('addressCountry')
            ->add('role', ChoiceType::class, [
                'choices' => [
                    Employee::ROLE_DRIVER => Employee::ROLE_DRIVER,
                    Employee::ROLE_ADMINISTRATOR => Employee::ROLE_ADMINISTRATOR,
                    Employee::ROLE_MANAGER => Employee::ROLE_MANAGER,
                ],
                'label' => 'Role',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EmployeeBundle\Entity\Employee',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'employeebundle_employee';
    }
}
