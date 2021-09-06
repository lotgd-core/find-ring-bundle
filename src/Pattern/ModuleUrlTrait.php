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

namespace Lotgd\Bundle\FindRingBundle\Pattern;

use Lotgd\Bundle\FindRingBundle\Controller\FindRingController;

trait ModuleUrlTrait
{
    public function getModuleUrl(string $method, string $query = '')
    {
        return "runmodule.php?method={$method}&controller=".urlencode(FindRingController::class).$query;
    }
}
