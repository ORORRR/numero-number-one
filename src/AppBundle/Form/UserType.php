<?php

namespace AppBundle\Form;

use AppBundle\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login', TextType::class, [
                'required' => false
            ])
            ->add('plainPassword', RepeatedType::class, [
                'invalid_message' => 'Les mots de passes doivent être identiques',
                'type' => PasswordType::class,
                'first_options'  => ['label' => 'mot de passe'],
                'second_options' => ['label' => 'mot de passe'],
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundleuser_type';
    }
}
