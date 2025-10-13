<?php

use CMW\Manager\Env\EnvManager;
use CMW\Manager\Lang\LangManager;
use CMW\Manager\Security\SecurityManager;
use CMW\Utils\Website;

Website::setTitle(LangManager::translate('SitemapExplorer.add.title'));
Website::setDescription(LangManager::translate('SitemapExplorer.add.subtitle'));
?>

<div class="flex items-center justify-between mb-6">
    <div class="flex items-center space-x-4">
        <div class="flex items-center space-x-2 text-gray-500 dark:text-gray-400">
            <i class="fas fa-sitemap"></i>
            <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>cmw-admin/sitemapexplorer/list"><?= LangManager::translate('SitemapExplorer.breadcrumb.sitemap_explorer') ?></a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span
                class="text-gray-900 dark:text-gray-100"><?= LangManager::translate('SitemapExplorer.add.title') ?></span>
        </div>
    </div>
</div>

<div class="mb-8">
    <h2 class="text-3xl font-bold flex items-center text-gray-900 dark:text-gray-100">
        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-900/30 mr-4">
            <i class="fas fa-plus text-blue-600 dark:text-blue-400"></i>
        </div>
        <?= LangManager::translate('SitemapExplorer.add.title') ?>
    </h2>
    <p class="text-gray-600 dark:text-gray-400 mt-2"><?= LangManager::translate('SitemapExplorer.add.subtitle') ?></p>
</div>

<div class="grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="card">
            <div class="card-title">
                <h5 class="flex items-center font-semibold">
                    <i class="fas fa-edit mr-2"></i>
                    <?= LangManager::translate('SitemapExplorer.sections.url_info') ?>
                </h5>
            </div>

            <form method="post" class="space-y-6">
                <?php (new SecurityManager())->insertHiddenToken() ?>
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-hashtag mr-2"></i><?= LangManager::translate('SitemapExplorer.form.slug') ?>
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="slug"
                           name="slug"
                           placeholder="<?= LangManager::translate('SitemapExplorer.form.slug_placeholder') ?>"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                           required>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        <?= LangManager::translate('SitemapExplorer.instructions.slug_format') ?>
                    </p>
                </div>

                <div>
                    <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-star mr-2"></i><?= LangManager::translate('SitemapExplorer.form.priority') ?>
                    </label>
                    <div class="flex items-center space-x-4">
                        <input type="range"
                               id="priority"
                               name="priority"
                               min="0"
                               max="1"
                               value="0.5"
                               step="0.1"
                               class="flex-1 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                        <span
                            class="bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 px-3 py-1 rounded-full text-sm font-medium min-w-[60px] text-center"
                            id="priorityDisplay">
                            0.5
                        </span>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        <?= LangManager::translate('SitemapExplorer.form.priority_help') ?>
                    </p>
                </div>

                <div>
                    <label for="lastmod" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-calendar-alt mr-2"></i><?= LangManager::translate('SitemapExplorer.form.lastmod') ?>
                    </label>
                    <input type="datetime-local"
                           id="lastmod"
                           name="lastmod"
                           value="<?= date('Y-m-d\TH:i') ?>"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                </div>

                <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200 dark:border-gray-600">
                    <button type="submit" class="btn-primary flex-1 sm:flex-initial">
                        <i class="fas fa-save mr-2"></i><?= LangManager::translate('SitemapExplorer.actions.save') ?>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="space-y-6">
        <div class="card bg-blue-50 dark:bg-blue-900/20 border-blue-200 dark:border-blue-800">
            <h6 class="font-semibold mb-3 flex items-center text-blue-800 dark:text-blue-300">
                <i class="fas fa-info-circle mr-2"></i>
                <?= LangManager::translate('SitemapExplorer.help.title') ?>
            </h6>
            <div class="space-y-3 text-sm">
                <div class="flex items-center justify-between">
                    <span class="badge-success">0.8 - 1.0</span>
                    <span
                        class="text-gray-600 dark:text-gray-400"><?= LangManager::translate('SitemapExplorer.priority_levels.high') ?></span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="badge-warning">0.5 - 0.7</span>
                    <span
                        class="text-gray-600 dark:text-gray-400"><?= LangManager::translate('SitemapExplorer.priority_levels.medium') ?></span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="badge">0.0 - 0.4</span>
                    <span
                        class="text-gray-600 dark:text-gray-400"><?= LangManager::translate('SitemapExplorer.priority_levels.low') ?></span>
                </div>
            </div>
            <div class="mt-4 p-3 alert-info rounded-lg">
                <p class="text-xs text-blue-800 dark:text-blue-300">
                    <i class="fas fa-lightbulb mr-1"></i>
                    <?= LangManager::translate('SitemapExplorer.instructions.priority_help_detailed') ?>
                </p>
            </div>
        </div>

        <div class="card bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-800">
            <h6 class="font-semibold mb-3 flex items-center text-green-800 dark:text-green-300">
                <i class="fas fa-search mr-2"></i>
                <?= LangManager::translate('SitemapExplorer.sections.seo_tips') ?>
            </h6>
            <div class="space-y-3 text-sm text-gray-600 dark:text-gray-400">
                <div class="flex items-start">
                    <i class="fas fa-check text-green-500 mt-1 mr-2 flex-shrink-0"></i>
                    <span><?= LangManager::translate('SitemapExplorer.help_messages.seo_tip_1') ?></span>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check text-green-500 mt-1 mr-2 flex-shrink-0"></i>
                    <span><?= LangManager::translate('SitemapExplorer.help_messages.seo_tip_2') ?></span>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check text-green-500 mt-1 mr-2 flex-shrink-0"></i>
                    <span><?= LangManager::translate('SitemapExplorer.help_messages.seo_tip_3') ?></span>
                </div>
            </div>
        </div>

        <div class="card bg-gray-50 dark:bg-gray-800/50">
            <h6 class="font-semibold mb-3 flex items-center">
                <i class="fas fa-file-code mr-2 text-gray-600 dark:text-gray-400"></i>
                <?= LangManager::translate('SitemapExplorer.sections.generated_file') ?>
            </h6>
            <div class="text-xs text-gray-600 dark:text-gray-400">
                <p class="mb-2"><?= LangManager::translate('SitemapExplorer.help_messages.generated_location') ?></p>
                <a href="<?= EnvManager::getInstance()->getValue('PATH_URL') ?>sitemap.xml"
                   target="_blank"
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 hover:underline">
                    <i class="fas fa-external-link-alt mr-1"></i>
                    sitemap.xml
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('priority').addEventListener('input', function () {
        document.getElementById('priorityDisplay').textContent = this.value;
    });
</script>
