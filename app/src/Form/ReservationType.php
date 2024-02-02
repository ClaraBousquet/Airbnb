<?php

namespace App\Form;

use App\Entity\House;
use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('house', EntityType::class, [
                'class' => House::class,
                'choice_label' => 'name',
                'label' => 'Maison',
                'attr' => [
                    'style' => 'width: 200px; margin-bottom: 10px; margin-right: 10px; margin-left: 10px; margin-top: 10px;',
                ]
            ])
            ->add('startDate', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date de début',
                'attr' => [
                    'style' => 'width: 200px; margin-bottom: 10px; margin-right: 10px; margin-left: 10px;margin-top: 10px;',
                ]
            ])
            ->add('endDate', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date de fin',
                'attr' => [
                    'style' => 'width: 200px; margin-bottom: 10px; margin-right: 10px; margin-left: 10px;margin-top: 10px;',
                ]
            ])
            ->add('userName', TextareaType::class, [
                'label' => 'Nom et Prénom',
                'required' => false,
                'attr' => [
                    'style' => 'width: 200px; height: 50px; margin-bottom: 10px; margin-right: 10px; margin-left: 10px;margin-top: 10px;',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
