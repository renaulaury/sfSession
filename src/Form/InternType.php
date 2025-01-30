<?php

namespace App\Form;

use App\Entity\Intern;
use App\Entity\Session;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class InternType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameIntern', TextType::class, [
                'label' => 'Nom',
            ]) 
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
            ]) 
            ->add('dateBirth', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de naissance',
            ])
            ->add('sex', TextType::class, [
            'label' => 'Sexe',
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                ])
            ->add('phone', TextType::class, [
                'label' => 'Téléphone',
                ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
            ])
            
            // ->add('sessions', EntityType::class, [
            //     'class' => Session::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Intern::class,
        ]);
    }
}
