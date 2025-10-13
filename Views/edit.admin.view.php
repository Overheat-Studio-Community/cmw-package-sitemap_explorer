<?php

use CMW\Manager\Env\EnvManager;
use CMW\Manager\Lang\LangManager;
use CMW\Manager\Security\SecurityManager;
use CMW\Manager\Xml\SitemapItemEntity;
use CMW\Utils\Website;

Website::setTitle(LangManager::translate('SitemapExplorer.edit.title'));
Website::setDescription(LangManager::translate('SitemapExplorer.edit.subtitle'));

/* @var SitemapItemEntity $item */
/* @var $errors */
?>

<div class="flex items-center justify-between mb-6">
    <div class="flex items-center space-x-4">
        <div class="flex items-center space-x-2 text-gray-500 dark:text-gray-400">
            <i class="fas fa-sitemap"></i>
            <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>cmw-admin/sitemapexplorer/list"><?= LangManager::translate('SitemapExplorer.breadcrumb.sitemap_explorer') ?></a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span
                class="text-gray-900 dark:text-gray-100"><?= LangManager::translate('SitemapExplorer.edit.title') ?></span>
        </div>
    </div>

    <div class="flex items-center space-x-2">
        <a href="<?= $item->getLoc() ?>"
           target="_blank"
           class="btn-info-sm">
            <i class="fas fa-external-link-alt mr-2"></i><?= LangManager::translate('SitemapExplorer.quick_actions.preview') ?>
        </a>
        <button type="button"
                class="btn-danger-sm"
                data-modal-target="deleteModal"
                data-modal-toggle="deleteModal">
            <i class="fas fa-trash mr-2"></i><?= LangManager::translate('SitemapExplorer.actions.delete') ?>
        </button>
    </div>
</div>

<div class="mb-8">
    <h2 class="text-3xl font-bold flex items-center text-gray-900 dark:text-gray-100">
        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-amber-100 dark:bg-amber-900/30 mr-4">
            <i class="fas fa-edit text-amber-600 dark:text-amber-400"></i>
        </div>
        <?= LangManager::translate('SitemapExplorer.edit.title') ?>
    </h2>
    <p class="text-gray-600 dark:text-gray-400 mt-2"><?= LangManager::translate('SitemapExplorer.edit.subtitle') ?></p>

    <div class="mt-4 p-4 bg-gray-50 dark:bg-gray-800/50 rounded-lg border">
        <div class="flex items-center">
            <div class="flex-shrink-0 mr-3">
                <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center">
                    <i class="fas fa-link text-blue-600 dark:text-blue-400 text-sm"></i>
                </div>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm text-gray-500 dark:text-gray-400">URL actuelle :</p>
                <p class="font-medium text-gray-900 dark:text-gray-100 truncate">
                    <?= htmlspecialchars($item->getLoc()) ?>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="card">
            <div class="card-title">
                <h5 class="flex items-center font-semibold">
                    <i class="fas fa-edit mr-2"></i>
                    <?= LangManager::translate('SitemapExplorer.sections.modify_info') ?>
                </h5>
            </div>

            <?php if (!empty($errors)): ?>
                <div class="alert-danger mb-6">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <strong><?= LangManager::translate('SitemapExplorer.sections.errors_detected') ?></strong>
                    </div>
                    <ul class="list-disc list-inside space-y-1 ml-6">
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" class="space-y-6">
                <?php (new SecurityManager())->insertHiddenToken() ?>
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-hashtag mr-2"></i><?= LangManager::translate('SitemapExplorer.form.slug') ?>
                    </label>
                    <input type="text"
                           id="slug"
                           name="slug"
                           value="<?= $item->getLoc() ?>"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400"
                           readonly>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        <i class="fas fa-lock mr-1"></i>
                        <?= LangManager::translate('SitemapExplorer.instructions.slug_readonly_help') ?>
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
                               step="0.1"
                               value="<?= $item->getPriority() ?>"
                               class="flex-1 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                        <span
                            class="bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 px-3 py-1 rounded-full text-sm font-medium min-w-[60px] text-center"
                            id="priorityDisplay">
                            <?= $item->getPriority() ?>
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
                           value="<?= date('Y-m-d\TH:i', strtotime($item->getLastmod())) ?>"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        <i class="fas fa-info-circle mr-1"></i>
                        <?= LangManager::translate('SitemapExplorer.instructions.lastmod_auto_help') ?>
                    </p>
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
        <div
            class="card bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/30 border-blue-200 dark:border-blue-800">
            <h6 class="font-semibold mb-4 flex items-center text-blue-800 dark:text-blue-300">
                <i class="fas fa-chart-bar mr-2"></i>
                <?= LangManager::translate('SitemapExplorer.sections.current_info') ?>
            </h6>
            <div class="space-y-3 text-sm">
                <div class="flex items-center justify-between">
                    <span
                        class="text-gray-600 dark:text-gray-400"><?= LangManager::translate('SitemapExplorer.stats.priority') ?> :</span>
                    <?php
                    $priority = $item->getPriority();
                    if ($priority >= 0.8) {
                        $badgeClass = 'badge-success';
                    } elseif ($priority >= 0.5) {
                        $badgeClass = 'badge-warning';
                    } else {
                        $badgeClass = 'badge';
                    }
                    ?>
                    <span class="<?= $badgeClass ?>">
                        <?= number_format($item->getPriority(), 2) ?>
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <span
                        class="text-gray-600 dark:text-gray-400"><?= LangManager::translate('SitemapExplorer.stats.last_modified') ?> :</span>
                    <span class="text-gray-900 dark:text-gray-100 text-xs">
                        <?= date('d/m/Y H:i', strtotime($item->getLastmod())) ?>
                    </span>
                </div>
            </div>
        </div>

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
        </div>

        <div class="card bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-800">
            <h6 class="font-semibold mb-3 flex items-center text-green-800 dark:text-green-300">
                <i class="fas fa-bolt mr-2"></i>
                <?= LangManager::translate('SitemapExplorer.sections.quick_actions') ?>
            </h6>
            <div class="space-y-3">
                <button type="button"
                        onclick="updateLastModToNow()"
                        class="w-full btn-info-sm text-left">
                    <i class="fas fa-clock mr-2"></i>
                    <?= LangManager::translate('SitemapExplorer.quick_actions.update_now') ?>
                </button>
                <button type="button"
                        onclick="setPriorityHigh()"
                        class="w-full btn-success-sm text-left">
                    <i class="fas fa-star mr-2"></i>
                    <?= LangManager::translate('SitemapExplorer.quick_actions.set_high_priority') ?>
                </button>
                <a href="<?= $item->getLoc() ?>"
                   target="_blank"
                   class="w-full btn-primary-sm text-left inline-block">
                    <i class="fas fa-external-link-alt mr-2"></i>
                    <?= LangManager::translate('SitemapExplorer.quick_actions.test_url') ?>
                </a>
            </div>
        </div>

        <div class="card bg-gray-50 dark:bg-gray-800/50">
            <h6 class="font-semibold mb-3 flex items-center">
                <i class="fas fa-file-code mr-2 text-gray-600 dark:text-gray-400"></i>
                <?= LangManager::translate('SitemapExplorer.sections.sitemap_xml') ?>
            </h6>
            <div class="text-xs text-gray-600 dark:text-gray-400">
                <p class="mb-2"><?= LangManager::translate('SitemapExplorer.help_messages.sitemap_complete') ?></p>
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

<div id="deleteModal" class="modal-container">
    <div class="modal">
        <div class="modal-header-danger">
            <h3 class="text-lg font-semibold flex items-center">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                <?= LangManager::translate('SitemapExplorer.delete.confirm_title') ?>
            </h3>
            <button type="button" class="text-white hover:text-gray-200" data-modal-hide="deleteModal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <p class="mb-4"><?= LangManager::translate('SitemapExplorer.delete.confirm_message') ?></p>
            <div class="alert-warning">
                <div class="flex items-center">
                    <i class="fas fa-link mr-2"></i>
                    <strong><?= $item->getLoc() ?></strong>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-secondary" data-modal-hide="deleteModal">
                <i class="fas fa-times mr-2"></i><?= LangManager::translate('SitemapExplorer.actions.cancel') ?>
            </button>
            <form method="post"
                  action="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>cmw-admin/sitemapexplorer/delete/<?= base64_encode($item->getSlug()) ?>"
                  class="inline">
                <button type="submit" class="btn-danger">
                    <i class="fas fa-trash mr-2"></i>
                    <?= LangManager::translate('SitemapExplorer.delete.confirm_button') ?>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('priority').addEventListener('input', function () {
        document.getElementById('priorityDisplay').textContent = this.value;
    });

    function updateLastModToNow() {
        const now = new Date();
        document.getElementById('lastmod').value = now.toISOString().slice(0, 16);
    }

    function setPriorityHigh() {
        const prioritySlider = document.getElementById('priority');
        const priorityDisplay = document.getElementById('priorityDisplay');
        prioritySlider.value = '0.8';
        priorityDisplay.textContent = '0.8';
    }
</script>
