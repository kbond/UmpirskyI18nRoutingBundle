<?php

namespace Umpirsky\I18nRoutingBundle\Routing\Loader;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\Routing\RouteCollection;
use Umpirsky\I18nRoutingBundle\Routing\Strategy\StrategyInterface;

class I18nRouteLoader implements LoaderInterface
{
    private $innerLoader;
    private $strategy;

    public function __construct(LoaderInterface $innerLoader, StrategyInterface $strategy)
    {
        $this->innerLoader = $innerLoader;
        $this->strategy = $strategy;
    }

    public function load($resource, $type = null): RouteCollection
    {
        $routeCollection = $this->innerLoader->load($resource, $type);

        $i18nRouteCollection = $this->cloneCollection($routeCollection);

        foreach ($routeCollection->all() as $name => $route) {
            $i18nRouteCollection->addCollection($this->strategy->generate($name, $route));
        }

        return $i18nRouteCollection;
    }

    public function supports($resource, $type = null): bool
    {
        return $this->innerLoader->supports($resource, $type);
    }

    public function getResolver()
    {
        return $this->innerLoader->getResolver();
    }

    public function setResolver(LoaderResolverInterface $resolver)
    {
        $this->innerLoader->setResolver($resolver);
    }

    private function cloneCollection(RouteCollection $routeCollection): RouteCollection
    {
        $routeCollectionClone = new RouteCollection();
        foreach ($routeCollection->getResources() as $resource) {
            $routeCollectionClone->addResource($resource);
        }

        return $routeCollectionClone;
    }
}
