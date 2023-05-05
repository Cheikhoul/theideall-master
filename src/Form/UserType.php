<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')         
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
            ])
            ->add('firstname')
            ->add('lastname')
            ->add('phonenumber')
            ->add('address')
            ->add('activityType', ChoiceType::class, [
                'placeholder' => '',
                'choices'  => [
                    'Physique' => 'physical',
                    'Virtuel' => 'virtual',
                ],
            ])
            ->add('bilingual', ChoiceType::class, [
                'placeholder' => '',
                'choices'  => [
                    'Bilingue' => true,
                    'Français' => false,
                ],
            ])
            ->add('roles', ChoiceType::class, [
                'placeholder' => '',
                'choices'  => [
                    'Administrateur' => 'ROLE_ADMIN',
                    'Animateur' => 'ROLE_USER',
                ],
                'mapped' => false,
            ])
            ->add('teamName')
            //->add('status')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
