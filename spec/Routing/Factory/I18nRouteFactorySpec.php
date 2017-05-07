<?php

namespace spec\Umpirsky\I18nRoutingBundle\Routing\Factory;

use PhpSpec\ObjectBehavior;
use Symfony\Component\Routing\Route;
use Umpirsky\I18nRoutingBundle\Routing\Generator\LocaleRequirementGeneratorInterface;

class I18nRouteFactorySpec extends ObjectBehavior
{
    function let(LocaleRequirementGeneratorInterface $localeRequirementGenerator)
    {
        $localeRequirementGenerator->generate()->willReturn('sr|ru|pl');

        $this->beConstructedWith($localeRequirementGenerator, 'en');
    }

    function it_generates_i18n_route_name_based_on_regular_route_name()
    {
        $this->generateName('foo')->shouldReturn('foo');
    }

    function it_creates_i18n_route_based_on_regular_route(Route $route)
    {
        $this->create($route)->shouldReturnAnInstanceOf(Route::class);
    }
}