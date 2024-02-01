<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Equipements;
use App\Entity\House;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('name')
            ->add('imagePath')
            ->add('numberRooms')
            ->add('numberGuest')
            ->add('Price')
            ->add('address')
            ->add('fileName')
            ->add('updateAt')
            ->add('category', EntityType::class, [
                'class' => Category::class,
'choice_label' => 'id',
            ])
            ->add('equipements', EntityType::class, [
                'class' => Equipements::class,
'choice_label' => 'id',
'multiple' => true,
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => House::class,
        ]);
    }
}
