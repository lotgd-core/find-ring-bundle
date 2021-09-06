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

namespace Lotgd\Bundle\FindRingBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

class LotgdFindRingExtension extends Extension
{
    public function load(array $config, ContainerBuilder $container)
    {
        $loader = new PhpFileLoader($container, new FileLocator(\dirname(__DIR__).'/Resources/config'));

        $loader->load('services.php');
    }
}
