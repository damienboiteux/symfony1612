<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('object', TextType::class, [
                'label'     => 'Sujet',
                // 'required'  => false,
                'help'      => 'Texte d\'aide',
                'attr'      => [
                    'placeholder' => 'L\'objet du message',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Champ obligatoire']),
                    new Length([
                        'min' => 4,
                        'minMessage' => '{{ limit }} caractères minimum'
                    ])
                ]
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Champ obligatoire']),
                ]
            ])
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Champ obligatoire',]),
                    new Length([
                        'max'           => 64,
                        'maxMessage'    => '{{ limit }} caractères maximum'
                    ])
                ]
            ])
            ->add('message', TextareaType::class, [
                'help' => '5 à 200 caractères',
                'constraints' => [
                    new NotBlank(['message' => 'Champ obligatoire',]),
                    new Length([
                        'min'           => 5,
                        'minMessage'    => '{{ limit }} caractères minimum',
                        'max'           => 200,
                        'maxMessage'    => '{{ limit }} caractères maximum'
                    ])
                ]
            ])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
