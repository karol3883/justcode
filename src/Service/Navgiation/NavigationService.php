<?php

namespace App\Service\Navgiation;

use App\Service\Navgiation\Traits\NavigationTrait;
use Symfony\Component\Routing\RouterInterface;

class NavigationService implements NavigationServiceInterface
{
    use NavigationTrait;

    private const AVAILABLE_NAVIGATION_ELEMENTS = [

    ];
    public function __construct(private RouterInterface $router)
    {
    }

//    public function generateNavigation(string $currentNavigationElement, string $currentLocale): array
    public function generateNavigation(string $currentNavigationElement, string $currentLocale): \Generator
    {
        $currentPath = $currentNavigationElement;
        if ($currentLocale !== 'pl') {
            $currentPath = "/$currentLocale$currentNavigationElement";
        }


        $availablePaths = [];
        foreach ($this->router->getRouteCollection()->all() as $routeName => $singleRoute) {
            $availablePaths [$singleRoute->getPath()] = $routeName;
        }

        foreach (NavigationElementsEnum::cases() as $navigationEnum) {
            if (!empty($availablePaths[$navigationEnum->localeUrl($currentLocale)])) {
                yield [
                    'route_name' => $availablePaths[$navigationEnum->localeUrl($currentLocale)],
                    'navigation_title' => $this->getNavigationTitleByEnum($navigationEnum),
                    'is_active' => $navigationEnum->localeUrl($currentLocale) === $currentPath,
                ];
            }
        }

    }
}