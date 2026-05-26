<?php
if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

function liquidglassRenderAd(string $position): void
{
    $widget = Typecho_Widget::widget('Widget_Options');
    $html = $position === 'right' ? $widget->adsRight : $widget->adsLeft;
    echo $html ?: '<div class="lg-glass lg-card">广告位</div>';
}
