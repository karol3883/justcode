<?php

namespace App\Service\Navgiation;

enum NavigationElementsEnum: string
{
    case HOMEPAGE = '/';
    case CONTACT = '/contact';
    case OFFER = '/oferta';

    public function localeUrl(string $locale): string
    {
        return match ($locale) {
//            'pl' => $this->value,
//            default => "/$locale{$this->value}",
            default => $this->value
        };
    }
}