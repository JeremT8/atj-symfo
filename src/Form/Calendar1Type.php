<?php

namespace App\Form;

use App\Entity\Calendar;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Calendar1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de l\'évenement'
            ])
            ->add('start', DateTimeType::class, [
                'date_widget' => 'single_text',
                'label' => 'Date du début de l\'évenement'
            ])
            ->add('end', DateTimeType::class, [
                'date_widget' => 'single_text',
                'label' => 'Date de fin de l\'évenement'
            ])
            ->add('description', TextType::class, [
                'label' => 'Descritpion de l\'évenement'
            ])
            ->add('all_day', CheckboxType::class, [
                'label' => 'Journée complète ?'
            ])
            ->add('background_color', ColorType::class, [
                'label' => 'Couleur de fond'
            ])
            ->add('border_color', ColorType::class, [
                'label' => 'Couleur de la bordure'
            ])
            ->add('text_color', ColorType::class, [
                'label' => 'Couleur du texte'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
        ]);
    }
}
