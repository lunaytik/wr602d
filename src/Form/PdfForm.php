<?php

namespace App\Form;

use App\Entity\Pdf;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Url;

class PdfForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'constraints' => [
                    new Length(['min' => 1]),
                    new NotBlank()
                ],
                'attr' => [
                    'placeholder' => 'Title',
                    'class' => 'border sm:text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 
                    placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500',
                ],
                'label_attr' => [
                    'class' => 'block mb-2 text-sm font-medium text-white'
                ],
            ])
            ->add('url', UrlType::class, [
                'mapped' => false,
                'constraints' => [
                    new Url(),
                    new NotBlank()
                ],
                'attr' => [
                    'placeholder' => 'https://example.com',
                    'class' => 'border sm:text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 
                    placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500',
                ],
                'label_attr' => [
                    'class' => 'block mb-2 text-sm font-medium text-white'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pdf::class,
        ]);
    }
}
