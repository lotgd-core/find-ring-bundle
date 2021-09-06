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

namespace Lotgd\Bundle\FindRingBundle\OccurrenceSubscriber;

use Lotgd\Bundle\FindRingBundle\LotgdFindRingBundle;
use Lotgd\Bundle\FindRingBundle\Pattern\ModuleUrlTrait as PatternModuleUrlTrait;
use Lotgd\Core\Http\Response;
use Lotgd\Core\Navigation\Navigation;
use Lotgd\CoreBundle\OccurrenceBundle\OccurrenceSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Twig\Environment;

class FindRingSubscriber implements OccurrenceSubscriberInterface
{
    use PatternModuleUrlTrait;

    public const TRANSLATION_DOMAIN = LotgdFindRingBundle::TRANSLATION_DOMAIN;

    private $response;
    private $twig;
    private $navigation;

    public function __construct(
        Response $response,
        Environment $twig,
        Navigation $navigation
    ) {
        $this->response   = $response;
        $this->twig       = $twig;
        $this->navigation = $navigation;
    }

    public function findRing(GenericEvent $event)
    {
        $query = sprintf(
            '&translation_domain=%s&translation_domain_navigation=%s&navigation_method=%s',
            $event->getArgument('translation_domain'),
            $event->getArgument('translation_domain_navigation'),
            $event->hasArgument('navigation_method') ? $event->getArgument('navigation_method') : '',
        );

        $this->navigation->setTextDomain(self::TRANSLATION_DOMAIN);

        $this->navigation->addHeader('navigation.category.ring');
        $this->navigation->addNav('navigation.nav.pick', $this->getModuleUrl('pick', $query));
        $this->navigation->addNav('navigation.nav.leave', $this->getModuleUrl('nope', $query));

        $this->navigation->setTextDomain();

        $this->response->pageAddContent($this->twig->render('@LotgdFindRing/activation.html.twig', [
            'translation_domain' => self::TRANSLATION_DOMAIN,
        ]));

        $event->stopPropagation();
    }

    public static function getSubscribedOccurrences()
    {
        return [
            'travel' => ['findRing', 7500, OccurrenceSubscriberInterface::PRIORITY_ANSWER],
            'forest' => ['findRing', 8000, OccurrenceSubscriberInterface::PRIORITY_ANSWER],
        ];
    }
}
