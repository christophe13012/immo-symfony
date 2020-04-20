<?php

namespace App\Form;

use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $heatChoices = $options['heatChoices'];
        $output = [];
        foreach ($heatChoices as $key => $value) {
            $output[$value] = $key;
        }

        $builder
            ->add('title')
            ->add('description',  TextareaType::class)
            ->add('surface')
            ->add('price')
            ->add('heat', ChoiceType::class, [
                'choices'  => $output
            ])
            ->add('postal_code')
            ->add('city')
            ->add('sold');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
            'heatChoices' => []
        ]);
    }
}
