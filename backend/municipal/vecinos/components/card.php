<?php
/**
 * Componente Tarjeta
 */
function renderCard($title = '', $content = '', $footer = '', $icon = '') {
    ?>
    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden flex flex-col h-full transition-all hover:shadow-xl hover:shadow-slate-200/50 dark:hover:shadow-none hover:-translate-y-1">
        <?php if ($title || $icon): ?>
        <div class="px-6 py-5 border-b border-slate-50 dark:border-slate-800 flex items-center justify-between">
            <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2">
                <?php if ($icon): ?>
                    <span class="material-symbols-outlined text-primary text-xl"><?php echo $icon; ?></span>
                <?php endif; ?>
                <?php echo $title; ?>
            </h3>
        </div>
        <?php endif; ?>
        
        <div class="p-6 flex-1">
            <?php echo $content; ?>
        </div>

        <?php if ($footer): ?>
        <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-800">
            <?php echo $footer; ?>
        </div>
        <?php endif; ?>
    </div>
    <?php
}
?>
