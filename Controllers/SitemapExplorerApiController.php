<?php

namespace CMW\Controller\SitemapExplorer;

use CMW\Controller\OverApi\OverApi;
use CMW\Controller\Users\UsersController;
use CMW\Manager\Lang\LangManager;
use CMW\Manager\Package\AbstractController;
use CMW\Manager\Router\Link;
use CMW\Manager\Xml\SitemapManager;
use JetBrains\PhpStorm\NoReturn;
use function base64_decode;
use function date;
use function strtotime;

/**
 * Class: @SitemapExplorerApiController
 * @package SitemapExplorer
 * @link https://craftmywebsite.fr/docs/fr/technical/creer-un-package/controllers
 */
class SitemapExplorerApiController extends AbstractController
{
    #[NoReturn] #[Link("/refresh/:slug", Link::GET, ['slug' => '.*?'], '/cmw-admin/sitemapexplorer/api')]
    private function refresh(string $slug): void
    {
        UsersController::redirectIfNotHavePermissions('core.dashboard', 'SitemapExplorer.manage');

        $slug = base64_decode($slug);

        $item = SitemapManager::getInstance()->getBySlug($slug);

        if (!$item) {
            OverApi::returnData(['status' => 0, 'message' => LangManager::translate('SitemapExplorer.api.errors.sitemap_not_found')]);
        }

        if (!SitemapManager::getInstance()->update($item->getSlug(), $item->getPriority())) {
            OverApi::returnData(['status' => 0, 'message' => LangManager::translate('SitemapExplorer.api.errors.sitemap_update_failed')]);
        }

        OverApi::returnData([
            'status' => 1,
            'date' => date('d/m/Y', strtotime($item->getLastmod())),
            'hour' => date('H:i', strtotime($item->getLastmod())),
            'message' => LangManager::translate('SitemapExplorer.api.success.sitemap_updated'),
        ]);
    }
}
