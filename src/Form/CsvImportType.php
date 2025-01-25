<?php

namespace App\Form;

use App\Entity\CsvImport;
use App\Entity\User;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
// use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CsvImportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('importedAt', null, [
            //     'widget' => 'single_text',
            // ])
            ->add('file', FileType::class, [
                'mapped' => false,
                // 'constraints' => [
                //     new File("")
                // ]
            ])
            ->add('filename')
            ->add('importedBy', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'username',
            ])
            // ->add('send', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CsvImport::class,
        ]);
    }
}
