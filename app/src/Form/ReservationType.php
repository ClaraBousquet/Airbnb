<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\House;
use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('house', EntityType::class, [
                'class' => House::class,
                'choice_label' => 'description',
            ])
            ->add('startDate', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('endDate', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('totalPrice', MoneyType::class)
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('user_name', TextType::class, [
    'label' => 'User Name',
    'required' => false, 
])
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
