<?php

namespace AppBundle\Form;

use AppBundle\Entity\Photo;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class PhotoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        if ($options['modifier']) {
            $builder->add('id', HiddenType::class);
        }
        $builder->add('nomServeur', TextType::class, array(
            'label' => 'Image',
            'attr' => array(
                'title' => 'Le nom de l\'image',
                'readonly' => true,
            ),
        ));
        $builder->add('file', \Symfony\Component\Form\Extension\Core\Type\FileType::class, array(
            'label' => false,
            'required' => false,
            'attr' => array(
                'style' => 'display:none'
            )
        ));
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Photo::class,
            'modifier' => false,
        ));
    }

    public function getBlockPrefix() {
        return 'oeuvre_photo';
    }

}
