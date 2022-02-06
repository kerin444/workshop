<?php

namespace App\Controller\Admin;

use App\Entity\Device;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;

class DeviceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Device::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()->hideOnIndex(),
            DateTimeField::new('dateAdded'),
            AssociationField::new('client', 'Client'),
            TextField::new('description', 'Description du matériel (marque, modèle, caractéristiques)'),
            TextField::new('serialNumber', 'Numéro de série'),
            DateField::new('dateBuy', 'Date d\'achat'),
            TextEditorField::new('problem', 'Problème déclaré'),
            TextEditorField::new('diagnosis', 'Diagnostic'),
            TextEditorField::new('solution', 'Solution'),
            TextField::new('quoteNumber', 'Numéro de devis'),
            DateField::new('quoteDate', 'Date de devis'),
            IntegerField::new('quoteAmount', 'Montant du devis'),
            IntegerField::new('repairDelay', 'Délai de réparation estimé'),
            TextField::new('clientFeedback', 'Retour du client'),
            DateField::new('clientFeedbackDate', 'Date de retour client'),
            DateField::new('repairDate', 'Date de réparation'),
            DateField::new('returnDate', 'Date de retour au client')


            
        ];
    }
    
}
