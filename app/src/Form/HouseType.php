<?php

namespace App\Form;

use App\Entity\House;
use App\Entity\Category;
use App\Entity\Equipements;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class HouseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description', TextareaType::class)
            ->add('name', TextareaType::class)
            ->add('imagePath', FileType::class, [
                'label' => 'Image (JPG, PNG, jpeg, jpg)',
                'mapped' => false,
            ])
            ->add('numberRooms', ChoiceType::class, [
                'choices' => array_combine(range(1, 10), range(1, 10)),

            ])
            ->add('numberGuest', ChoiceType::class, [
                'choices' => array_combine(range(1, 10), range(1, 10)),
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'label',
            ])
            ->add('equipements', EntityType::class, [
                'class' => Equipements::class,
                'choice_label' => 'label',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('price', TextareaType::class)
            ->add('address', TextareaType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => House::class,
        ]);
    }
}
