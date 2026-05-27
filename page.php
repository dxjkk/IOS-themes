<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<main class="main-content">
    <div class="layout-grid single-post-layout">
        <div class="content-area">
            <article class="post-full liquid-glass" itemscope itemtype="http://schema.org/Article">
                <header class="post-full-header">
                    <h1 class="post-full-title" itemprop="name"><?php $this->title(); ?></h1>
                    <div class="post-full-meta">
                        <span class="post-full-meta-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                            </svg>
                            <?php $this->author(); ?>
                        </span>
                        <span class="post-full-meta-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date('Y-m-d'); ?></time>
                        </span>
                    </div>
                </header>

                <div class="post-full-content" itemprop="articleBody">
                    <?php $this->content(); ?>
                </div>
            </article>

            <?php $this->need('comments.php'); ?>
        </div>
    </div>
</main>

<?php $this->need('footer.php'); ?>
