<?php

namespace App\Form;

use App\Entity\Trainer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TrainerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameTrainer', TextType::class , [
                'label' => "Nom",
            ])
            ->add('firstname', TextType::class , [
                'label' => "Prénom",
            ])
            ->add('email', EmailType::class , [
                'label' => "Email",
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Valider",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trainer::class,
        ]);
    }
}
