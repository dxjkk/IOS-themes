<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f5f5f7">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <?php if ($this->options->seoKeywords): ?>
    <meta name="keywords" content="<?php $this->options->seoKeywords() ?>">
    <?php endif; ?>
    <?php if ($this->options->seoDescription): ?>
    <meta name="description" content="<?php $this->options->seoDescription() ?>">
    <?php endif; ?>

    <title><?php $this->archiveTitle(['category' => '%s', 'search' => '搜索: %s', 'tag' => '%s', 'author' => '%s'], '', ' - '); ?><?php $this->options->title(); ?></title>

    <?php $this->header("generator=&template="); ?>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Noto+Sans+SC:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('style.css'); ?>">

    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js" defer></script>

    <!-- Theme JS -->
    <script src="<?php $this->options->themeUrl('app.js'); ?>" defer></script>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><defs><linearGradient id='g' x1='0%25' y1='0%25' x2='100%25' y2='100%25'><stop offset='0%25' style='stop-color:%236684ff'/><stop offset='100%25' style='stop-color:%23a78bfa'/></linearGradient></defs><rect width='100' height='100' rx='28' fill='url(%23g)'/><circle cx='50' cy='50' r='28' fill='white' opacity='0.25'/></svg>">
</head>
<body>
    <!-- Reading Progress Bar -->
    <div class="reading-progress" id="readingProgress"></div>

    <!-- Dynamic Island (Mobile) -->
    <div class="dynamic-island-container" id="dynamicIsland">
        <div class="dynamic-island-pill" id="dynamicIslandPill">
            <span class="island-icon"></span>
            <span class="island-text"></span>
        </div>
    </div>

    <!-- Header -->
    <header class="header" id="header">
        <div class="header-inner liquid-glass">
            <!-- Logo -->
            <a href="<?php $this->options->siteUrl(); ?>" class="header-logo">
                <div class="logo-icon">
                    <svg viewBox="0 0 40 40" fill="none">
                        <rect width="40" height="40" rx="12" fill="url(#logoGrad)"/>
                        <circle cx="20" cy="20" r="11" fill="white" opacity="0.3"/>
                        <defs>
                            <linearGradient id="logoGrad" x1="0" y1="0" x2="40" y2="40">
                                <stop stop-color="#6684ff"/>
                                <stop offset="1" stop-color="#a78bfa"/>
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
                <span class="logo-text"><?php $this->options->title(); ?></span>
            </a>

            <!-- Category Pills -->
            <nav class="category-nav" id="categoryNav">
                <button class="category-pill active" data-category="all" data-id="0">
                    <?php _e('全部'); ?>
                </button>
                <?php
                $categories = Typecho_Widget::widget('Widget_Metas_Category_List')->stack;
                foreach ($categories as $cat):
                ?>
                <button class="category-pill"
                        data-category="<?php echo $cat['slug']; ?>"
                        data-id="<?php echo $cat['mid']; ?>">
                    <?php echo $cat['name']; ?>
                </button>
                <?php endforeach; ?>
            </nav>

            <!-- Right actions -->
            <div class="header-actions">
                <button class="search-trigger liquid-glass" id="searchTrigger" aria-label="Search">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.35-4.35"/>
                    </svg>
                </button>
                <button class="theme-toggle liquid-glass" id="themeToggle" aria-label="Toggle theme">
                    <svg class="icon-sun" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <circle cx="12" cy="12" r="5"/>
                        <path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>
                    </svg>
                    <svg class="icon-moon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Search overlay -->
        <div class="search-overlay" id="searchOverlay">
            <div class="search-backdrop"></div>
            <div class="search-panel liquid-glass">
                <form action="<?php $this->options->siteUrl(); ?>" method="get" id="searchForm">
                    <div class="search-input-wrap">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                            <circle cx="11" cy="11" r="8"/>
                            <path d="m21 21-4.35-4.35"/>
                        </svg>
                        <input type="text" class="search-input" id="searchInput" name="s" placeholder="搜索文章、标签..." autocomplete="off">
                        <kbd class="search-kbd">esc</kbd>
                    </div>
                </form>
                <div class="search-results" id="searchResults">
                    <p class="search-hint">输入关键词开始搜索...</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Rounded Navigation Section -->
    <section class="nav-section" id="navSection">
        <div class="nav-grid" id="navGrid"></div>
        <!-- Expanded panel -->
        <div class="nav-expand-overlay" id="navExpandOverlay">
            <div class="nav-expand-backdrop"></div>
            <div class="nav-expand-panel liquid-glass" id="navExpandPanel">
                <div class="nav-expand-header">
                    <h3>全部导航</h3>
                    <button class="nav-expand-close" id="navExpandClose">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                            <path d="M18 6 6 18M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div class="nav-expand-grid" id="navExpandGrid"></div>
            </div>
        </div>
    </section>
