<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CartRowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('productId', HiddenType::class)
            ->add('quantity', IntegerType::class, [
                'attr' => [
                    'min' => 1,
                ],
            ])
            ->add('size', ChoiceType::class, [
                'choices' => [
                    'Small' => 'S',
                    'Medium' => 'M',
                    'Large' => 'L',
                ],
            ])
            ->add('color', ChoiceType::class, [
                'choices' => [
                    'Red' => 'red',
                    'Blue' => 'blue',
                    'Green' => 'green',
                ],
            ])
            ->add('submit', SubmitType::class, [
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
