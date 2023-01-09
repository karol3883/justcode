<?php

namespace App\Service\Navgiation;

interface NavigationServiceInterface
{
//    public function generateNavigation(string $currentNavigationElement, string $currentLocale): array;
    public function generateNavigation(string $currentNavigationElement, string $currentLocale): \Generator;
}