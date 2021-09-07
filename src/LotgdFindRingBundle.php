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

namespace Lotgd\Bundle\FindRingBundle;

use Lotgd\Bundle\Contract\LotgdBundleInterface;
use Lotgd\Bundle\Contract\LotgdBundleTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class LotgdFindRingBundle extends Bundle implements LotgdBundleInterface
{
    use LotgdBundleTrait;

    public const TRANSLATION_DOMAIN = 'bundle_find_ring';

    /**
     * {@inheritDoc}
     */
    public function getLotgdName(): string
    {
        return 'Find Ring';
    }

    /**
     * {@inheritDoc}
     */
    public function getLotgdVersion(): string
    {
        return '0.1.1';
    }

    /**
     * {@inheritDoc}
     */
    public function getLotgdIcon(): string
    {
        return 'ring';
    }

    /**
     * {@inheritDoc}
     */
    public function getLotgdDescription(): string
    {
        return 'Special Event that can Find Ring in forest or when travelling.';
    }

    /**
     * {@inheritDoc}
     */
    public function getLotgdDownload(): string
    {
        return 'https://github.com/lotgd-core/find-ring-bundle';
    }
}
