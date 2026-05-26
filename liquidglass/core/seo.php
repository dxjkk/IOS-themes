<?php
if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

function liquidglassRenderSeo($archive): void
{
    $title = $archive->is('index') ? $archive->options->title : $archive->title;
    echo '<title>' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</title>';
    echo '<meta name="description" content="Apple Liquid Glass Typecho Theme">';
    echo '<meta name="keywords" content="Typecho,Liquid Glass,iOS 26,visionOS">';
    echo '<meta property="og:type" content="website">';
    echo '<meta property="og:title" content="' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '">';
    echo '<meta name="twitter:card" content="summary_large_image">';
}
