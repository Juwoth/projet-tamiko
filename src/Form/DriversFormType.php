<?php

namespace App\Form;

use App\Entity\Drivers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class DriversFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => array(
                    'class' =>'bg-transparent block m-10 border-b-2 w-full h-10 text-3xl outline-none',
                    'placeholder' => 'Nom du conducteur'
                ),
                'label' => false,
                'required' => true
            ])
            ->add('workDays', IntegerType::class, [
                'attr' => array(
                    'class' =>'bg-transparent block m-10 border-b-2 w-full h-10 text-3xl outline-none',
                    'placeholder' => 'Nombre de jours'
                ),
                'label' => false,
                'required' => true
            ])
            ->add('vehicle', TextType::class, [
                'attr' => array(
                    'class' =>'bg-transparent block m-10 border-b-2 w-full h-10 text-3xl outline-none',
                    'placeholder' => 'Marque du véhicule'
                ),
                'label' => false,
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Drivers::class,
        ]);
    }
}
