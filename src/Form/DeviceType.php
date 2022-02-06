<?php

namespace App\Form;

use App\Entity\Device;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeviceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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
            ->add('client')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Device::class,
        ]);
    }
}
