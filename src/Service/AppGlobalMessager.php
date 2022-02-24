<?php

namespace App\Service;

class AppGlobalMessager
{
    public function getCallActions(): array{
        return [
            "a_renouveller" => 'Appel à renouveller',
            "non_joignable" => 'Client non joiagnable',
            "accepte" => 'Réparation acceptée par le client',
            "refuse" => 'Réparation refusée par le client',
        ];
    }
}