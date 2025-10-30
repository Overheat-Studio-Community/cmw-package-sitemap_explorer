<?php

use CMW\Manager\Env\EnvManager;
use CMW\Manager\Lang\LangManager;
use CMW\Manager\Security\SecurityManager;
use CMW\Manager\Xml\SitemapItemEntity;
use CMW\Utils\Website;

Website::setTitle(LangManager::translate('SitemapExplorer.title'));
Website::setDescription(LangManager::translate('SitemapExplorer.description'));

/* @var SitemapItemEntity[] $sitemapItems */
?>

<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold flex items-center">
            <i class="fas fa-sitemap text-blue-600 mr-3"></i>
            <?= LangManager::translate('SitemapExplorer.title') ?>
        </h2>
        <p class="text-gray-600 dark:text-gray-400 mt-1"><?= LangManager::translate('SitemapExplorer.list.subtitle') ?></p>
    </div>
    <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>cmw-admin/sitemapexplorer/add"
       class="btn-primary flex items-center">
        <i class="fas fa-plus mr-2"></i><?= LangManager::translate('SitemapExplorer.add.title') ?>
    </a>
</div>

<div class="grid-4 mb-6">
    <div
        class="card bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/30 border-blue-200 dark:border-blue-800">
        <div class="text-center">
            <div
                class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-800/50 mb-3">
                <i class="fas fa-link text-2xl text-blue-600 dark:text-blue-400"></i>
            </div>
            <h3 class="text-2xl font-bold text-blue-800 dark:text-blue-300"><?= count($sitemapItems) ?></h3>
            <p class="text-sm text-gray-600 dark:text-gray-400"><?= LangManager::translate('SitemapExplorer.info.total') ?></p>
        </div>
    </div>

    <div
        class="card bg-gradient-to-br from-green-50 to-emerald-100 dark:from-green-900/20 dark:to-emerald-900/30 border-green-200 dark:border-green-800">
        <div class="text-center">
            <div
                class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-green-100 dark:bg-green-800/50 mb-3">
                <i class="fas fa-star text-2xl text-green-600 dark:text-green-400"></i>
            </div>
            <h3 class="text-2xl font-bold text-green-800 dark:text-green-300"><?= count(array_filter($sitemapItems, static fn($item) => $item->getPriority() >= 0.8)) ?></h3>
            <p class="text-sm text-gray-600 dark:text-gray-400"><?= LangManager::translate('SitemapExplorer.stats.high_priority') ?></p>
        </div>
    </div>

    <div
        class="card bg-gradient-to-br from-amber-50 to-orange-100 dark:from-amber-900/20 dark:to-orange-900/30 border-amber-200 dark:border-amber-800">
        <div class="text-center">
            <div
                class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-amber-100 dark:bg-amber-800/50 mb-3">
                <i class="fas fa-chart-line text-2xl text-amber-600 dark:text-amber-400"></i>
            </div>
            <h3 class="text-2xl font-bold text-amber-800 dark:text-amber-300"><?= count(array_filter($sitemapItems, static fn($item) => $item->getPriority() >= 0.5 && $item->getPriority() < 0.8)) ?></h3>
            <p class="text-sm text-gray-600 dark:text-gray-400"><?= LangManager::translate('SitemapExplorer.stats.medium_priority') ?></p>
        </div>
    </div>

    <div
        class="card bg-gradient-to-br from-cyan-50 to-teal-100 dark:from-cyan-900/20 dark:to-teal-900/30 border-cyan-200 dark:border-cyan-800">
        <div class="text-center">
            <div
                class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-cyan-100 dark:bg-cyan-800/50 mb-3">
                <i class="fas fa-file-alt text-2xl text-cyan-600 dark:text-cyan-400"></i>
            </div>
            <h3 class="text-xl font-bold text-cyan-800 dark:text-cyan-300">XML</h3>
            <p class="text-sm">
                <a href="<?= EnvManager::getInstance()->getValue('PATH_URL') ?>sitemap.xml"
                   target="_blank"
                   class="text-cyan-600 hover:text-cyan-800 dark:text-cyan-400 dark:hover:text-cyan-300 hover:underline">
                    <?= LangManager::translate('SitemapExplorer.info.file_link') ?>
                </a>
            </p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-title">
        <h5 class="flex items-center font-semibold">
            <i class="fas fa-list mr-2"></i>
            <?= LangManager::translate('SitemapExplorer.list.title') ?>
        </h5>
    </div>

    <?php if (empty($sitemapItems)): ?>
        <div class="text-center py-12">
            <div class="mb-6">
                <i class="fas fa-sitemap text-6xl text-gray-400 dark:text-gray-500"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-400 mb-2">
                <?= LangManager::translate('SitemapExplorer.table.no_data') ?>
            </h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6"><?= LangManager::translate('SitemapExplorer.empty') ?></p>
            <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>cmw-admin/sitemapexplorer/add"
               class="btn-primary inline-flex items-center">
                <i class="fas fa-plus mr-2"></i><?= LangManager::translate('SitemapExplorer.add.title') ?>
            </a>
        </div>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">
                        <i class="fas fa-link mr-2"></i><?= LangManager::translate('SitemapExplorer.table.url') ?>
                    </th>
                    <th class="px-4 py-3 text-center font-semibold text-gray-700 dark:text-gray-300">
                        <i class="fas fa-star mr-2"></i><?= LangManager::translate('SitemapExplorer.table.priority') ?>
                    </th>
                    <th class="px-4 py-3 text-center font-semibold text-gray-700 dark:text-gray-300">
                        <i class="fas fa-clock mr-2"></i><?= LangManager::translate('SitemapExplorer.table.lastmod') ?>
                    </th>
                    <th class="px-4 py-3 text-center font-semibold text-gray-700 dark:text-gray-300">
                        <i class="fas fa-cogs mr-2"></i><?= LangManager::translate('SitemapExplorer.table.actions') ?>
                    </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                <?php foreach ($sitemapItems as $index => $item): ?>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                        <td class="px-4 py-3">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 mr-3">
                                    <div
                                        class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center">
                                        <i class="fas fa-globe text-blue-600 dark:text-blue-400"></i>
                                    </div>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="font-medium text-gray-900 dark:text-gray-100 truncate">
                                        <?= $item->getLoc() ?>
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 flex items-center mt-1">
                                        <i class="fas fa-hashtag mr-1"></i>
                                        <span class="truncate">
                                                <?= $item->getSlug() === '/' ? LangManager::translate('SitemapExplorer.labels.homepage') : $item->getSlug() ?>
                                            </span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <?php
                            if ($item->getPriority() >= 0.8) {
                                $badgeClass = 'badge-success';
                                $icon = 'fas fa-star';
                            } elseif ($item->getPriority() >= 0.5) {
                                $badgeClass = 'badge-warning';
                                $icon = 'fas fa-star-half-alt';
                            } else {
                                $badgeClass = 'badge';
                                $icon = 'fas fa-circle';
                            }
                            ?>
                            <span class="<?= $badgeClass ?> inline-flex items-center px-3 py-1">
                                    <i class="<?= $icon ?> mr-1"></i>
                                    <?= number_format($item->getPriority(), 2) ?>
                                </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="text-sm text-gray-900 dark:text-gray-100">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                <span id="date-<?= $item->getSlugEncoded() ?>">
                                    <?= date('d/m/Y', strtotime($item->getLastmod())) ?>
                                </span>
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                <i class="fas fa-clock mr-1"></i>
                                <span id="hour-<?= $item->getSlugEncoded() ?>">
                                    <?= date('H:i', strtotime($item->getLastmod())) ?>
                                </span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="<?= $item->getLoc() ?>"
                                   target="_blank"
                                   class="btn-info-sm"
                                   title="<?= LangManager::translate('SitemapExplorer.actions.view') ?>">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>cmw-admin/sitemapexplorer/edit/<?= $item->getSlugEncoded() ?>"
                                   class="btn-primary-sm"
                                   title="<?= LangManager::translate('SitemapExplorer.actions.edit') ?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button"
                                        class="btn-success-sm cursor-pointer"
                                        title="<?= LangManager::translate('SitemapExplorer.actions.refresh') ?>"
                                        id="btn-refresh-<?= $item->getSlugEncoded() ?>"
                                        onclick="refreshUrl('<?= $item->getSlugEncoded() ?>')">
                                    <i class="fas fa-arrows-rotate"></i>
                                </button>
                                <button type="button"
                                        class="btn-danger-sm"
                                        data-modal-target="deleteModal<?= $index ?>"
                                        data-modal-toggle="deleteModal<?= $index ?>"
                                        title="<?= LangManager::translate('SitemapExplorer.actions.delete') ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>

                            <div id="deleteModal<?= $index ?>" class="modal-container">
                                <div class="modal">
                                    <div class="modal-header-danger">
                                        <h3 class="text-lg font-semibold flex items-center">
                                            <i class="fas fa-exclamation-triangle mr-2"></i>
                                            <?= LangManager::translate('SitemapExplorer.delete.confirm_title') ?>
                                        </h3>
                                        <button type="button" class="text-white hover:text-gray-200"
                                                data-modal-hide="deleteModal<?= $index ?>">
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
                                        <button type="button" class="btn-secondary"
                                                data-modal-hide="deleteModal<?= $index ?>">
                                            <i class="fas fa-times mr-2"></i><?= LangManager::translate('SitemapExplorer.actions.cancel') ?>
                                        </button>
                                        <form method="post"
                                              action="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>cmw-admin/sitemapexplorer/delete/<?= $item->getSlugEncoded() ?>"
                                              class="inline">
                                            <?php (new SecurityManager())->insertHiddenToken() ?>
                                            <button type="submit" class="btn-danger">
                                                <i class="fas fa-trash mr-2"></i>
                                                <?= LangManager::translate('SitemapExplorer.delete.confirm_button') ?>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<div class="grid-2 mt-6">
    <div class="card bg-gray-50 dark:bg-gray-800/50">
        <h6 class="font-semibold mb-3 flex items-center">
            <i class="fas fa-robot mr-2 text-gray-600 dark:text-gray-400"></i>
            <?= LangManager::translate('SitemapExplorer.info.robots') ?>
        </h6>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
            Le fichier robots.txt référence automatiquement votre sitemap pour les moteurs de recherche.
        </p>
        <a href="<?= EnvManager::getInstance()->getValue('PATH_URL') ?>robots.txt"
           target="_blank"
           class="btn-primary-sm inline-flex items-center">
            <i class="fas fa-external-link-alt mr-2"></i>
            <?= LangManager::translate('SitemapExplorer.info.robots_link') ?>
        </a>
    </div>

    <div class="card bg-blue-50 dark:bg-blue-900/20">
        <h6 class="font-semibold mb-3 flex items-center">
            <i class="fas fa-question-circle mr-2 text-blue-600 dark:text-blue-400"></i>
            <?= LangManager::translate('SitemapExplorer.help.title') ?>
        </h6>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
            <?= LangManager::translate('SitemapExplorer.help.subtitle') ?>
        </p>
        <div class="flex flex-wrap gap-2">
            <span class="badge-success">0.8-1.0</span>
            <span class="badge-warning">0.5-0.7</span>
            <span class="badge">0.0-0.4</span>
        </div>
    </div>
</div>

<!-- Refresh URL SCRIPT -->
<script>
    const refreshUrl = async (slugEncoded) => {
        const btn = document.getElementById(`btn-refresh-${slugEncoded}`);
        const btnIcon = btn.querySelector('i');

        //set button to loading state
        btn.disabled = true;
        btnIcon.classList.add('fa-spin');

        //Fetch the API to refresh the URL
        let res = await fetch(`<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>cmw-admin/sitemapexplorer/api/refresh/${slugEncoded}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })

        let data = await res.json();

        //Reset button state
        btn.disabled = false;
        btnIcon.classList.remove('fa-spin');

        //Update UI + toaster
        if (data.status === 1) {
            const dateElem = document.getElementById(`date-${slugEncoded}`);
            const hourElem = document.getElementById(`hour-${slugEncoded}`);

            dateElem.textContent = data.date;
            hourElem.textContent = data.hour;

            iziToast.show(
                {
                    title: "<?= LangManager::translate('SitemapExplorer.flash.success.title') ?>",
                    message: "<?= LangManager::translate('SitemapExplorer.flash.success.sitemap_refreshed') ?>",
                    color: "green"
                });
        } else {
            iziToast.show(
                {
                    title: "<?= LangManager::translate('SitemapExplorer.flash.error.title') ?>",
                    message: data.message,
                    color: "red"
                });
        }
    }
</script>
