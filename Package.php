<?php

namespace CMW\Package\SitemapExplorer;

use CMW\Manager\Lang\LangManager;
use CMW\Manager\Package\IPackageConfigV2;
use CMW\Manager\Package\PackageMenuType;
use CMW\Manager\Package\PackageSubMenuType;

/**
 * Class: Package
 * @package SitemapExplorer
 * @link https://craftmywebsite.fr/docs/fr/technical/creer-un-package/packagephp
 */
class Package implements IPackageConfigV2
{
    public function name(): string
    {
        return 'SitemapExplorer';
    }

    public function version(): string
    {
        return '1.0.0';
    }

    public function cmwVersion(): string
    {
        return "alpha-10";
    }

    public function imageLink(): ?string
    {
        return null;
    }

    public function author(): ?string
    {
        return "OverheatStudio";
    }

    public function authors(): array
    {
        return ['OverheatStudio'];
    }

    public function isGame(): bool
    {
        return false;
    }

    public function isCore(): bool
    {
        return false;
    }

    public function menus(): ?array
    {
        return [
            new PackageMenuType(
                icon: 'fas fa-sitemap',
                title: LangManager::translate('SitemapExplorer.menu.title'),
                url: null,
                permission: null,
                subMenus: [
                    new PackageSubMenuType(
                        title: LangManager::translate('SitemapExplorer.menu.list'),
                        permission: 'SitemapExplorer.manage',
                        url: 'sitemapexplorer/list',
                    ),
                    new PackageSubMenuType(
                        title: LangManager::translate('SitemapExplorer.menu.add'),
                        permission: 'SitemapExplorer.create',
                        url: 'sitemapexplorer/add',
                    ),
                ]
            ),
        ];
    }

    public function compatiblesPackages(): array
    {
        return [];
    }

    public function requiredPackages(): array
    {
        return ['Core'];
    }

    public function uninstall(): bool
    {
        // Return true, we don't need other operations for uninstall.
        return true;
    }
}
