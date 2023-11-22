<?php

namespace App\Form;

use App\Entity\Offre;
use App\Entity\Cours;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class Offre1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('date')
        ->add('prix',MoneyType::class)
        ->add('date_fin')
        
        ->add('image',FileType::class,
        [
            'data_class' => null,
            'attr' => ['class' => 'form-control mt-2'],
            'constraints'=> new File(
                [
                    'mimeTypes'=>[
                        'image/jpeg',
                        'image/jpg',
                        'image/png',
                    ]
                ]
            )
        ]
                    );
       
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offre::class,
        ]);
    }
}
