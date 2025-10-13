<?php

namespace CMW\Permissions\SitemapExplorer;

use CMW\Manager\Lang\LangManager;
use CMW\Manager\Permission\IPermissionInit;
use CMW\Manager\Permission\PermissionInitType;

/**
 * Class: Permissions
 * @package SitemapExplorer
 * @link https://craftmywebsite.fr/docs/fr/technical/creer-un-package/initialisation-init
 */
class Permissions implements IPermissionInit
{
    public function permissions(): array
    {
        return [
            new PermissionInitType(
                code: 'SitemapExplorer.manage',
                description: LangManager::translate('SitemapExplorer.permissions.manage'),
            ),
            new PermissionInitType(
                code: 'SitemapExplorer.create',
                description: LangManager::translate('SitemapExplorer.permissions.create'),
            ),
            new PermissionInitType(
                code: 'SitemapExplorer.edit',
                description: LangManager::translate('SitemapExplorer.permissions.edit'),
            ),
            new PermissionInitType(
                code: 'SitemapExplorer.delete',
                description: LangManager::translate('SitemapExplorer.permissions.delete'),
            ),
        ];
    }
}
