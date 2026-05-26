<?php
if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

require_once __DIR__ . '/core/options.php';
require_once __DIR__ . '/core/seo.php';
require_once __DIR__ . '/core/ads.php';
require_once __DIR__ . '/core/cache.php';

function themeConfig(Typecho_Widget_Helper_Form $form): void
{
    liquidglassThemeOptions($form);
}

function themeFields(Typecho_Widget_Helper_Layout $layout): void
{
    $excerpt = new Typecho_Widget_Helper_Form_Element_Textarea('liquidSummary', null, '', _t('Liquid 摘要'), _t('用于卡片模式的精简摘要。'));
    $layout->addItem($excerpt);
}
