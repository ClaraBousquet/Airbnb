<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Equipements;
use App\Entity\House;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HouseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('name')
            ->add('imagePath')
            ->add('numberRooms')
            ->add('numberGuest')
            ->add('category', EntityType::class, [
                'class' => Category::class,
'choice_label' => 'id',
            ])
            ->add('equipements', EntityType::class, [
                'class' => Equipements::class,
'choice_label' => 'id',
'multiple' => true,
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
