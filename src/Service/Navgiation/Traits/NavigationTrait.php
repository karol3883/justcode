<?php

namespace App\Service\Navgiation\Traits;

use App\Service\Navgiation\NavigationElementsEnum;

trait NavigationTrait
{
    public function getNavigationTitleByEnum(NavigationElementsEnum $navigationElementsEnum): string {
        return match ($navigationElementsEnum) {
            NavigationElementsEnum::HOMEPAGE => 'Strona głowna',
            NavigationElementsEnum::CONTACT => 'Kontakt',
            NavigationElementsEnum::OFFER => 'Oferta',
            default => throw new \Exception('Navigation element not exists')
        };
    }
}