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
                code: 'sitemapexplorer.manage',
                description: LangManager::translate('sitemapexplorer.permissions.manage'),
            ),
            new PermissionInitType(
                code: 'sitemapexplorer.create',
                description: LangManager::translate('sitemapexplorer.permissions.create'),
            ),
            new PermissionInitType(
                code: 'sitemapexplorer.edit',
                description: LangManager::translate('sitemapexplorer.permissions.edit'),
            ),
            new PermissionInitType(
                code: 'sitemapexplorer.delete',
                description: LangManager::translate('sitemapexplorer.permissions.delete'),
            ),
        ];
    }
}
