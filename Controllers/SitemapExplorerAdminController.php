<?php

namespace CMW\Controller\SitemapExplorer;

use CMW\Controller\Users\UsersController;
use CMW\Manager\Filter\FilterManager;
use CMW\Manager\Flash\Alert;
use CMW\Manager\Flash\Flash;
use CMW\Manager\Lang\LangManager;
use CMW\Manager\Package\AbstractController;
use CMW\Manager\Router\Link;
use CMW\Manager\Views\View;
use CMW\Manager\Xml\SitemapManager;
use CMW\Utils\Redirect;
use JetBrains\PhpStorm\NoReturn;

/**
 * Class: @SitemapExplorerAdminController
 * @package SitemapExplorer
 * @link https://craftmywebsite.fr/docs/fr/technical/creer-un-package/controllers
 */
class SitemapExplorerAdminController extends AbstractController
{
    #[Link("/list", Link::GET, scope: '/cmw-admin/sitemapexplorer')]
    private function main(): void
    {
        UsersController::redirectIfNotHavePermissions('core.dashboard', 'SitemapExplorer.manage');

        $sitemapItems = SitemapManager::getInstance()->getAll();

        View::createAdminView('SitemapExplorer', 'main')
            ->addVariableList(['sitemapItems' => $sitemapItems])
            ->view();
    }

    #[Link("/add", Link::GET, scope: '/cmw-admin/sitemapexplorer')]
    private function add(): void
    {
        UsersController::redirectIfNotHavePermissions('core.dashboard', 'SitemapExplorer.create');

        View::createAdminView('SitemapExplorer', 'add')
            ->view();
    }

    #[NoReturn] #[Link("/add", Link::POST, scope: '/cmw-admin/sitemapexplorer')]
    private function addPost(): void
    {
        UsersController::redirectIfNotHavePermissions('core.dashboard', 'SitemapExplorer.create');

        $slug = FilterManager::filterInputStringPost('slug');
        $priority = FilterManager::filterInputStringPost('priority', 4);

        if (!$slug || $priority === false || $priority < 0 || $priority > 1) {
            Flash::send(
                Alert::ERROR,
                LangManager::translate('SitemapExplorer.flash.error.title'),
                LangManager::translate('SitemapExplorer.flash.error.invalid_data')
            );
            Redirect::redirectPreviousRoute();
        }

        if (SitemapManager::getInstance()->getBySlug($slug)) {
            Flash::send(
                Alert::ERROR,
                LangManager::translate('SitemapExplorer.flash.error.title'),
                LangManager::translate('SitemapExplorer.flash.error.url_exists')
            );
            Redirect::redirectPreviousRoute();
        }

        if (SitemapManager::getInstance()->add($slug, $priority)) {
            Flash::send(
                Alert::SUCCESS,
                LangManager::translate('SitemapExplorer.flash.success.title'),
                LangManager::translate('SitemapExplorer.flash.success.url_added')
            );
        } else {
            Flash::send(
                Alert::ERROR,
                LangManager::translate('SitemapExplorer.flash.error.title'),
                LangManager::translate('SitemapExplorer.flash.error.add_failed')
            );
        }

        Redirect::redirectToAdmin('sitemapexplorer/list');
    }

    #[Link("/edit/:slug", Link::GET, ['slug' => '.*?'], '/cmw-admin/sitemapexplorer')]
    private function edit(string $slug): void
    {
        UsersController::redirectIfNotHavePermissions('core.dashboard', 'SitemapExplorer.edit');

        $slug = base64_decode($slug);

        $item = SitemapManager::getInstance()->getBySlug($slug);

        if (!$item) {
            Flash::send(
                Alert::ERROR,
                LangManager::translate('SitemapExplorer.flash.error.title'),
                LangManager::translate('SitemapExplorer.flash.error.url_not_found')
            );
            Redirect::redirectToAdmin('sitemapexplorer/list');
        }

        View::createAdminView('SitemapExplorer', 'edit')
            ->addVariableList(['item' => $item])
            ->view();
    }

    #[Link("/edit/:slug", Link::POST, ['slug' => '.*?'], '/cmw-admin/sitemapexplorer')]
    #[NoReturn]
    private function editPost(string $slug): void
    {
        UsersController::redirectIfNotHavePermissions('core.dashboard', 'SitemapExplorer.edit');

        $slug = base64_decode($slug);

        $newSlug = FilterManager::filterInputStringPost('slug');
        $priority = FilterManager::filterInputStringPost('priority', 4);

        if (!$newSlug || $priority === false || $priority < 0 || $priority > 1) {
            Flash::send(
                Alert::ERROR,
                LangManager::translate('SitemapExplorer.flash.error.title'),
                LangManager::translate('SitemapExplorer.flash.error.invalid_data')
            );
            Redirect::redirectPreviousRoute();
        }

        if (!SitemapManager::getInstance()->update($slug, $priority)) {
            Flash::send(
                Alert::ERROR,
                LangManager::translate('SitemapExplorer.flash.error.title'),
                LangManager::translate('SitemapExplorer.flash.error.update_failed')
            );
        }

        Flash::send(
            Alert::SUCCESS,
            LangManager::translate('SitemapExplorer.flash.success.title'),
            LangManager::translate('SitemapExplorer.flash.success.url_updated')
        );
        Redirect::redirectPreviousRoute();
    }

    #[Link("/delete/:slug", Link::POST, ['slug' => '.*?'], '/cmw-admin/sitemapexplorer')]
    #[NoReturn]
    private function delete(string $slug): void
    {
        UsersController::redirectIfNotHavePermissions('core.dashboard', 'SitemapExplorer.delete');

        $slug = base64_decode($slug);

        if (SitemapManager::getInstance()->delete($slug)) {
            Flash::send(
                Alert::SUCCESS,
                LangManager::translate('SitemapExplorer.flash.success.title'),
                LangManager::translate('SitemapExplorer.flash.success.url_deleted')
            );
        } else {
            Flash::send(
                Alert::ERROR,
                LangManager::translate('SitemapExplorer.flash.error.title'),
                LangManager::translate('SitemapExplorer.flash.error.delete_failed')
            );
        }

        Redirect::redirectPreviousRoute();
    }
}
