<?php

namespace App\Twig;

use App\Service\AppGlobalMessager;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class GlobalMessagerExtension extends AbstractExtension
{
    private AppGlobalMessager $globalMessager;
    public function __construct(AppGlobalMessager $globalMessager)
    {
        $this->globalMessager = $globalMessager;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('callActions', [$this, 'getCallActions']),
        ];
    }

    public function getCallActions(): array
    {
        return $this->globalMessager->getCallActions();
    }

}