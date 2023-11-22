<?php

namespace App\Form;

use App\Entity\Coach;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;



class CoachType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('domaine_id')
            ->add('salaire')
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
            'data_class' => Coach::class,
        ]);
    }
}
