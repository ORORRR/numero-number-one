<?php

namespace AppBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AppBundle\Entity\Oeuvre;

class GroupImagesType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('id', HiddenType::class, array(
            'required' => false,
        ));
        $builder->add('files', \Symfony\Component\Form\Extension\Core\Type\FileType::class, array(
            'label' => false,
            'multiple' => true,
            'required' => true,
            'attr' => array(
                'style' => 'display:none'
            )
        ));
        $builder->add('photos', CollectionType::class, array(
            'label' => false,
            'entry_type' => \AppBundle\Form\PhotoType::class,
            'entry_options' => array(
                'label' => false,
                'required' => false,
                'modifier' => $options['modifier'],
            ),
            'allow_add' => true,
            'prototype' => true,
            'prototype_name' => '__file__',
            'allow_delete' => true,
            'delete_empty' => true,
            'by_reference' => false,
            'error_bubbling' => true,
        ));
        /*
          $builder->add('delete', ButtonType::class, array(
          'label' => 'Supprimer',
          'attr' => array(
          'title' => 'Supprimer le(s) fichier(s) de la liste'
          )
          ));
         */
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => \AppBundle\Form\GroupImages::class,
            'modifier' => false
        ));
    }

    public function getBlockPrefix() {
        return 'group_files';
    }

}
