<?php

namespace App\Form;

use App\Entity\Intern;
use App\Entity\Session;
use App\Entity\Trainer;
use App\Entity\Training;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelleSession', TextType::class, [
                'label' => 'Nom de la session',
            ])

            ->add('nbPlace', IntegerType::class, [
                'label' => 'Nombre de place',
            ])
            ->add('dateBegin', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Début',
            ])
            ->add('dateEnd', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Fin',
            ])
            ->add('training', EntityType::class, [
                'class' => Training::class,
                'choice_label' => 'libelleTraining',
                'label' => 'Formation',
            ])
            ->add('trainer', EntityType::class, [
                'class' => Trainer::class,
                'choice_label' => 'nameTrainer',
                'label' => 'Formateur',
            ])
            ->add('interns', EntityType::class, [
                'class' => Intern::class,
                'choice_label' => 'nameIntern',
                'multiple' => true,
                'label' => 'Stagiaires',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
