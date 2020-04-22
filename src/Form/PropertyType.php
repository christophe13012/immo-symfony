<?php

namespace App\Form;

use App\Entity\Option;
use App\Entity\Property;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

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
            ->add('options', EntityType::class, [
                'class' => Option::class,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('imageFile', FileType::class, ['required' => false])
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
