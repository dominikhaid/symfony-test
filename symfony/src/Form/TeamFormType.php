<?php

namespace App\Form;

use App\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Dropzone\Form\DropzoneType;

class TeamFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
    'required' => true,
     'attr' => [
         'class' => 'form-control',
         'placeholder' => 'First Name',
         'title' => 'first name',
         'aria-label' => 'first name',
     ],
     'label' => 'First Name',
         'label_attr' => [
             'class' => 'input-group-text',
         ],
])
            ->add('lastName', TextType::class, [
    'required' => true,
     'attr' => [
         'class' => 'form-control',
         'placeholder' => 'Last Name',
         'title' => 'last name',
         'aria-label' => 'Last Name',
     ],
     'label' => 'Last Name',
         'label_attr' => [
             'class' => 'input-group-text',
         ],
])
            ->add('department', TextType::class, [
    'required' => true,
     'attr' => [
         'class' => 'form-control',
         'placeholder' => 'Department',
         'title' => 'Department',
         'aria-label' => 'department',
     ],
     'label' => 'Department',
         'label_attr' => [
             'class' => 'input-group-text',
         ],
])
            ->add('email', EmailType::class, [
    'required' => true,
     'attr' => [
         'class' => 'form-control',
         'placeholder' => 'Description',
         'title' => 'Description',
         'aria-label' => 'Description',
     ],
     'label' => 'Description',
         'label_attr' => [
             'class' => 'input-group-text',
         ],
])
            ->add('role', HiddenType::class, ['data' => '0'])
            ->add('photo', DropzoneType::class, [
    'required' => false,
     'attr' => [
         'class' => 'form-control',
         'placeholder' => false,
         'title' => 'Photo',
         'aria-label' => 'Photo',
     ],
     'label' => 'Photo',
         'label_attr' => [
             'class' => 'input-group-text',
         ],
])
            ->add('description', TextareaType::class, [
    'required' => true,
     'attr' => [
         'class' => 'form-control',
         'style' => 'min-height:250px;',
         'placeholder' => 'Description',
         'title' => 'Description',
         'aria-label' => 'Description',
     ],
     'label' => 'Description',
         'label_attr' => [
             'class' => 'input-group-text',
         ],
]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
        ]);
    }
}
