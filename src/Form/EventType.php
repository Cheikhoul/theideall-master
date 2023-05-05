<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use App\Entity\Activity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('startDate', DateTimeType::class, [
                'date_label' => false,
                'widget' => 'single_text',
            ])
            ->add('durationMinute')
            ->add('language', ChoiceType::class, [
                'choices'  => [
                    'Anglais' => 'english',
                    'Français' => 'french',
                ],
            ])
            ->add('requiredUser')
            ->add('customer')
            ->add('activity', EntityType::class, [
                'placeholder' => '',
                'class' => Activity::class,
                'choice_label' => 'name',
                'mapped' => false,
            ])
            ->add('address')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
