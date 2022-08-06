<?php

namespace App\Form;

use App\Entity\Event;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\FormBuilderInterface;


class EventType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
      $builder
          ->add('name', TextType::class, [
              'attr' => ['class' => 'form-control   ', 'style' => 'margin-bottom:25px']
          ])
          ->add('image', TextType::class, [
              'attr' => ['class' => 'form-control  ', 'style' => 'margin-bottom:25px']
          ])
          ->add('description', TextType::class, [
              'attr' => ['class' => 'form-control  ', 'style' => 'margin-bottom:25px']
          ])
          ->add('capacity', IntegerType::class, [
              'attr' => ['class' => 'form-control  ', 'style' => 'margin-bottom:25px']
          ])
          ->add('date', DateType::class, [
            'attr' => [ 'style' => 'margin-bottom:25px']
            ])
          ->add('contact_email', EmailType::class, [
            'attr' => ['class' => 'form-control  ', 'style' => 'margin-bottom:25px']
            ])
          ->add('contact_phone', IntegerType::class, [
            'attr' => ['class' => 'form-control  ', 'style' => 'margin-bottom:25px']
        ])
         ->add('address', TextType::class, [
              'attr' => ['class' => 'form-control  ', 'style' => 'margin-bottom:25px']
          ])
          ->add('url', TextType::class, [
            'attr' => ['class' => 'form-control  ', 'style' => 'margin-bottom:25px']
        ])
        ->add('type', TextType::class, [
            'attr' => ['class' => 'form-control ', 'style' => 'margin-bottom:25px']
        ]);
     
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
      $resolver->setDefaults([
          'data_class' => Event::class,
      ]);
  }
}