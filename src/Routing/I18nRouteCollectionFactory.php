<?php

namespace Umpirsky\I18nRoutingBundle\Routing;

use Symfony\Component\Routing\RouteCollection;

class I18nRouteCollectionFactory implements I18nRouteCollectionFactoryInterface
{
    private $i18nRouteFactory;
    private $routeNameSuffix;

    public function __construct(I18nRouteFactoryInterface $i18nRouteFactory, string $routeNameSuffix)
    {
        $this->i18nRouteFactory = $i18nRouteFactory;
        $this->routeNameSuffix = $routeNameSuffix;
    }

    public function create(RouteCollection $routeCollection)
    {
        foreach ($routeCollection->all() as $name => $route) {
            $routeCollection->add($name.$this->routeNameSuffix, $this->i18nRouteFactory->create($route));
        }

        return $routeCollection;
    }
}
