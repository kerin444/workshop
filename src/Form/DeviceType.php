<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Device;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeviceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if($options['step']==0)
        {
            $builder
                ->add('client', EntityType::class, [
                    'class' => Client::class,
                    'choice_label' => function (Client $client) {
                        return $client->getName() . " / " . $client->getContact(). " / " . $client->getEmail(). " / " . $client->getPhone();
                    }
                ])

                ->add('client2', CollectionType::class, [
                    'mapped' => false,
                'entry_type' => ClientType::class,
                'label' => 'Créer un nouveau client',
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            ] );
        }
        else
        {
        $builder
            ->add('client')
            ->add('description')
            ->add('brand')
            ->add('serialNumber')
            ->add('dateAdded')
            ->add('dateBuy')
            ->add('problem')
            ->add('diagnosis')
            ->add('solution')
            ->add('quoteNumber')
            ->add('quoteDate')
            ->add('quoteAmount')
            ->add('repairDelay')
            ->add('repairDate')
            ->add('returnDate')
            ->add('clientFeedback')
            ->add('clientFeedbackDate')
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
