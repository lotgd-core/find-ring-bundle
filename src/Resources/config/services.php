<?php

/**
 * This file is part of "LoTGD Bundle Find Ring".
 *
 * @see https://github.com/lotgd-core/find-ring-bundle
 *
 * @license https://github.com/lotgd-core/find-ring-bundle/blob/master/LICENSE.txt
 * @author IDMarinas
 *
 * @since 0.1.0
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Lotgd\Bundle\FindRingBundle\Controller\FindRingController;
use Lotgd\Bundle\FindRingBundle\OccurrenceSubscriber\FindRingSubscriber;
use Lotgd\Core\Http\Response;
use Lotgd\Core\Lib\Settings;
use Lotgd\Core\Navigation\Navigation;

return static function (ContainerConfigurator $container)
{
    $container->services()
        //-- Controller
        ->set(FindRingController::class)
            ->args([
                new ReferenceConfigurator(Navigation::class),
                new ReferenceConfigurator(Response::class),
                new ReferenceConfigurator(Settings::class)
            ])
            ->call('setContainer', [
                new ReferenceConfigurator('service_container'),
            ])
            ->tag('controller.service_arguments')

        //-- Occurrence Subscribers
        ->set(FindRingSubscriber::class)
            ->args([
                new ReferenceConfigurator(Response::class),
                new ReferenceConfigurator('twig'),
                new ReferenceConfigurator(Navigation::class),
            ])
            ->tag('lotgd_core.occurrence_subscriber')
    ;
};
