<?php
/**
 * Componente Badge / Estado
 */
function renderBadge($text, $type = 'default') {
    $styles = [
        'default' => 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400',
        'success' => 'bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400',
        'warning' => 'bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400',
        'danger'  => 'bg-rose-50 text-rose-600 dark:bg-rose-500/10 dark:text-rose-400',
        'primary' => 'bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400',
    ];
    $style = $styles[$type] ?? $styles['default'];
    ?>
    <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-[10px] font-black uppercase tracking-wider <?php echo $style; ?>">
        <?php echo $text; ?>
    </span>
    <?php
}
?>
