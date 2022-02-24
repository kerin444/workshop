<?php

namespace App\Form;

use App\Entity\Call;
use App\Entity\User;
use App\Service\AppGlobalMessager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CallType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $messager = new AppGlobalMessager();
        $builder
            ->add('technician', EntityType::class, [
                'class' => User::class,
                'row_attr' => [ 'class' => 'mb-3 col-md-8' ],
            ])
            ->add('date',DateTimeType::class, [
                'widget' => 'single_text',
                'row_attr' => [ 'class' => 'mb-3 col-md-4' ],
            ])
            ->add('feedback', TextareaType::class, [
                'row_attr' => [ 'class' => 'mb-3 col-12' ],
            ])
            ->add('action', ChoiceType::class, [
                'choices' => array_flip($messager->getCallActions() ),
                'row_attr' => [ 'class' => 'mb-3 col-12' ],
            ])
            //->add('device')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Call::class,
        ]);
    }
}
