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

namespace Lotgd\Bundle\FindRingBundle\Controller;

use Lotgd\Bundle\FindRingBundle\LotgdFindRingBundle;
use Lotgd\Bundle\FindRingBundle\Pattern\ModuleUrlTrait as PatternModuleUrlTrait;
use Lotgd\Core\Http\Request;
use Lotgd\Core\Http\Response as HttpResponse;
use Lotgd\Core\Lib\Settings;
use Lotgd\Core\Navigation\Navigation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class FindRingController extends AbstractController
{
    use PatternModuleUrlTrait;

    public const TRANSLATION_DOMAIN = LotgdFindRingBundle::TRANSLATION_DOMAIN;

    private $navigation;
    private $response;
    private $settings;

    public function __construct(Navigation $navigation, HttpResponse $response, Settings $settings)
    {
        $this->navigation = $navigation;
        $this->response   = $response;
        $this->settings   = $settings;
    }

    public function nope(Request $request): Response
    {
        $this->response->pageTitle('title.nope', [], self::TRANSLATION_DOMAIN);

        $nav = $request->query->get('navigation_method', '');

        if (method_exists($this->navigation, $nav))
        {
            $this->navigation->{$nav}($request->query->get('translation_domain_navigation', ''));
        }

        return $this->render('@LotgdFindRing/nope.html.twig', $this->addParameters([]));
    }

    public function pick(Request $request): Response
    {
        global $session;

        $this->response->pageTitle('title.pick', [], self::TRANSLATION_DOMAIN);

        $nav = $request->query->get('navigation_method', '');

        if (method_exists($this->navigation, $nav))
        {
            $this->navigation->{$nav}($request->query->get('translation_domain_navigation', ''));
        }

        $dk = \max(1, $session['user']['dragonkills']);

        $dkchance = \max(5, (\ceil($dk / 5)));

        $params['chance'] = false;

        if (mt_rand(0, $dkchance) <= 1)
        {
            $params['chance'] = true;

            ++$session['user']['charm'];
        }
        else
        {
            $amt = \round($session['user']['hitpoints'] * 0.05, 0);
            $session['user']['hitpoints'] -= $amt;
            $session['user']['hitpoints'] = \max(1, $session['user']['hitpoints']);
        }

        return $this->render('@LotgdFindRing/pick.html.twig', $this->addParameters($params));
    }

    private function addParameters(array $params): array
    {
        $params['translation_domain'] = self::TRANSLATION_DOMAIN;

        return $params;
    }
}
