<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Gregwar\CaptchaBundle\Type\CaptchaType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, [
                'label' => 'Votre nom',
            ])
            ->add('email',EmailType::class, [
                'label' => 'Votre adresse e-mail'
            ])
            ->add('message', CKEditorType::class, [
                'label' => 'Votre message',
                'attr' => ['rows' => 8],
            ])
            ->add('captcha', CaptchaType::class, [
                'attr' => [
                    'style' => 'width: 200px'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}