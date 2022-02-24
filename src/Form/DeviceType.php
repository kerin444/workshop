<?php

namespace App\Form;

use App\Entity\Call;
use App\Entity\Client;
use App\Entity\Device;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class DeviceType extends AbstractType
{
    private $token;
    public function __construct(TokenStorageInterface $token)
    {
        $this->token = $token;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if($options['step'] == 0)
        {
            $builder
                ->add('client', EntityType::class, [
                    'class' => Client::class,
                    'choice_label' => function (Client $client) {
                        return $client->getName() . " / " . $client->getContact(). " / " . $client->getEmail(). " / " . $client->getPhone();
                    }
                ]);
        }
        else if($options['step'] == 1)
        {
            $builder
                ->add('client', EntityType::class, [
                    'row_attr' => [ 'class' => 'mb-3 col-11' ],
                    'class' => Client::class,
                    'choice_label' => function (Client $client) {
                        return $client->getName() . " / " . $client->getContact(). " / " . $client->getEmail(). " / " . $client->getPhone();
                    }
                ])
                ->add('description', TextType::class, [
                    'row_attr' => [ 'class' => 'mb-3 col-md-6' ],
                ])
                ->add('brand', TextType::class, [
                    'row_attr' => [ 'class' => 'mb-3 col-md-3' ],
                ])
                ->add('serialNumber', TextType::class, [
                    'row_attr' => [ 'class' => 'mb-3 col-md-3' ],
                ])
                ->add('dateBuy')
                ->add('problem', TextareaType::class, [
                    'row_attr' => [ 'class' => 'mb-3 col-12' ],
                ])
            ;
        }
        else if($options['step'] ==2)
        {
            $builder
                ->add('technician', EntityType::class, [
                    'class' => User::class
                ])
                ->add('diagnosis', TextareaType::class)
                ->add('solution', TextareaType::class)
                ->add('quoteNumber', TextType::class, [
                    'row_attr' => [ 'class' => 'mb-3 col-md-2' ],
                ])
                ->add('quoteDate', DateType::class, [
                    'widget' => 'single_text',
                    'row_attr' => [ 'class' => 'mb-3 col-md-3' ],
                ])
                ->add('quoteAmount', MoneyType::class, [
                    'grouping' => true,
                    'currency' => 'XAF',
                    'row_attr' => [ 'class' => 'mb-3 col-md-3' ],
                ])
                ->add('repairDelay', TextType::class, [
                    'row_attr' => [ 'class' => 'mb-3 col-md-2' ],
                ])
            ;
        }
        else if($options['step'] == 3)
        {
            $newCall = new Call();
            $newCall->setTechnician($this->token->getToken()->getUser());

            $builder
                ->add('calls', CollectionType::class, [
                    'entry_type' => CallType::class,
                    'allow_delete' => true,
                    'allow_add' => true,
                    'by_reference' => false,
                    'prototype' => true,
                    'prototype_data' => $newCall
                ])
                ->add('clientFeedback', TextareaType::class,[
                ])
                ->add('clientFeedbackDate',DateType::class, [
                    'widget' => 'single_text',
                    'row_attr' => [ 'class' => 'mb-3 col-md-3' ],
                ])
                ->add('repairDate', DateType::class, [
                    'widget' => 'single_text',
                    'row_attr' => [ 'class' => 'mb-3 col-md-3' ],
                ])
            ;
        }
        else if($options['step'] == 4)
        {
            $builder
                ->add('clientFeedback')
                ->add('clientFeedbackDate')
                ->add('repairDate')
                ->add('returnDate')
                ->add('technician', EntityType::class, [
                    'class' => User::class
                ])
                ->add('diagnosis', TextareaType::class)
                ->add('solution', TextareaType::class)
                ->add('quoteNumber', TextType::class, [
                    'row_attr' => [ 'class' => 'mb-3 col-md-2' ],
                ])
                ->add('quoteDate', DateType::class, [
                    'widget' => 'single_text',
                    'row_attr' => [ 'class' => 'mb-3 col-md-3' ],
                ])
                ->add('quoteAmount', MoneyType::class, [
                    'grouping' => true,
                    'currency' => 'XAF',
                    'row_attr' => [ 'class' => 'mb-3 col-md-3' ],
                ])
                ->add('repairDelay', TextType::class, [
                    'row_attr' => [ 'class' => 'mb-3 col-md-2' ],
                ])
            ;
        }
        else
        {
        $builder
            ->add('client')
            ->add('description')
            ->add('brand')
            ->add('serialNumber')
            ->add('dateBuy')
            ->add('problem')
            ->add('diagnosis')
            ->add('solution')
            ->add('quoteNumber')
            ->add('quoteDate')
            ->add('quoteAmount')
            ->add('repairDelay')
        ;
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Device::class,
            'step' => 0,
        ]);
    }
}
