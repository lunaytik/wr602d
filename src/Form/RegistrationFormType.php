<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'john.doe@mail.com',
                    'class' => 'border sm:text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 
                    placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500',
                ],
                'label_attr' => [
                    'class' => 'block mb-2 text-sm font-medium text-white'
                ],
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Doe',
                    'class' => 'border sm:text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 
                    placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500',
                ],
                'label_attr' => [
                    'class' => 'block mb-2 text-sm font-medium text-white'
                ],
            ])
            ->add('firstname', TextType::class, [
                'attr' => [
                    'placeholder' => 'John',
                    'class' => 'border sm:text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 
                    placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500',
                ],
                'label_attr' => [
                    'class' => 'block mb-2 text-sm font-medium text-white'
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
                'label_attr' => [
                    'class' => 'order-last ms-2 text-sm font-medium text-gray-300'
                ],
                'attr' => [
                    'class' => 'w-4 h-4 text-blue-600 rounded focus:ring-blue-600 ring-offset-gray-800 ring-2 
                    bg-gray-700 border-gray-600',
                ],
                'row_attr' => [
                    'class' => 'flex items-center gap-1'
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'class' => 'border sm:text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 
                    placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500',
                    'placeholder' => '••••••••',
                ],
                'label_attr' => [
                    'class' => 'block mb-2 text-sm font-medium text-white'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
