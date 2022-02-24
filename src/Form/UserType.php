<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('name', TextType::class,[
                'required' => true,
                'attr' => [
                    "class" => "form-control"
                ],
            ])
            ->add('email', EmailType::class,[
                'required' => true,
                'attr' => [
                    "class" => "form-control"
                ],
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Technician' => 'ROLE_USER',
                    'Manager' => 'ROLE_MANAGER',
                    'Administrator' => 'ROLE_ADMIN'
                ],
                'expanded' => true,
                'multiple' => true,
            ]);
        if($options['data']->getId()==null)
            $builder->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => "Les mots de passes ne sont pas identiques",
                'required' => true,
                'first_options' => [ 'label' => "Password"],
                'second_options' => [ 'label' => "Repeat password"],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
