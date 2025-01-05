<?php

namespace App\Form;

use App\Entity\Image;
use App\Entity\Interests;
use App\Entity\Profile;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('location')
            ->add('city')
            ->add('birthdate', DateType::class, [
                'widget' => 'single_text', // Use a single input field (e.g., an HTML5 date picker)
                'html5' => true,          // Ensure HTML5 compatibility
                'input' => 'datetime_immutable', // Transform into a DateTimeImmutable
                // 'data' => new \DateTimeImmutable('midnight'), // Optionally set default value
                'mapped' => false,
                'required' => true,
            ])
            ->add('status')
            ->add('bio', TextareaType::class, [
                'mapped' => false,
                'required' => false,
            ])
    // I want to make the interests classes first
            // ->add('interests', EntityType::class, [
            //     'class' => Interests::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
            // ->add('cover', EntityType::class, [
            //     'class' => Image::class,
            //     'choice_label' => 'id',
            // ])
            ->add('save', SubmitType::class, [
                'label' => 'Save', // Text displayed on the button
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Profile::class,
        ]);
    }
}
