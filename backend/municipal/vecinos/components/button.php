<?php
/**
 * Componente Botón Moderno
 */
function renderButton($text, $icon = '', $type = 'primary', $full = false, $onclick = '') {
    $base = "flex items-center justify-center gap-2 px-6 py-3 rounded-2xl font-bold text-sm transition-all active:scale-95 shadow-lg ";
    $styles = [
        'primary' => "bg-primary text-white hover:bg-blue-600 shadow-primary/20",
        'outline' => "border-2 border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800",
        'danger'  => "bg-danger text-white hover:bg-rose-600 shadow-danger/20",
        'ghost'   => "text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-slate-800 dark:hover:text-white shadow-none",
    ];
    $style = $styles[$type] ?? $styles['primary'];
    $width = $full ? 'w-full' : '';
    ?>
    <button onclick="<?php echo $onclick; ?>" class="<?php echo $base . $style . ' ' . $width; ?>">
        <?php if ($icon): ?>
            <span class="material-symbols-outlined text-lg"><?php echo $icon; ?></span>
        <?php endif; ?>
        <?php echo $text; ?>
    </button>
    <?php
}
?>
