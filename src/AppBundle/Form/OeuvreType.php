<?php

namespace AppBundle\Form;

use AppBundle\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\OeuvreTemp;
use AppBundle\Form\GroupImagesType;
use Symfony\Component\Validator\Constraints\File;

class OeuvreType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
            'label' => 'titre',
            'required' => false,
            ])
            ->add('descriptif', TextareaType::class, [
                'label' => 'description',
                'required' => false,
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'placeholder' => 'Veuillez choisir une catégorie',
                'required' => false,
                'choice_label' => 'nom',
                'invalid_message' => 'La catégorie sélectionnée n\'existe pas (ou plus).',
            ])
            ->add('photoPrincipale', FileType::class, [
                'multiple' => false,
                'data_class' => null,
                'required' => false,
                'mapped' => false,
                'label' => 'Changer photo principale',
                'constraints' => [
                    new File(array('mimeTypes' => array('image/png', 'image/jpeg', 'image/jpg'), 'mimeTypesMessage' => 'L\'image principale n\'est pas dans un format autorisé')),
                ],
            ]);

        if ($options['modifier']) {
            $builder->add('supprimerPhotoPrincipale', CheckboxType::class, [
                'label' => 'pas de photo principale',
                'data' => false,
                'mapped' => false,
                'required' => false,
            ]);
        }

        $builder
            ->add('groupsImages', CollectionType::class, array(
                'entry_type' => GroupImagesType::class,
                'entry_options' => array(
                    'label' => false,
                    'required' => false,
                    'modifier' => $options['modifier'],
                ),
                'label' => false,
                'allow_add' => true,
                'prototype' => true,
                'prototype_name' => '__group__',
                'allow_delete' => true,
                'delete_empty' => true,
                'by_reference' => false,
                'error_bubbling' => true,
            ))
            ->add('auteurs', TextType::class, [
                'required' => false,
            ])
            ->add('datePublication', DateType::class, [
                'required' => false,
                'html5' => false,
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'invalid_message' => 'la date de publication est invalide'
            ])
            ->add('addGroup', FileType::class, array(
                'label' => 'Photos secondaires',
                'mapped' => false,
                'required' => false,
                'multiple' => true
            ))
            ->add('save', SubmitType::class, array(
                'label' => $options['texte_bouton']
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OeuvreTemp::class,
            'modifier' => false,
            'texte_bouton' => 'Ajouter',
        ]);
    }

}
