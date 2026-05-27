<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php if ($this->is('search')): ?>
    <?php $this->need('header.php'); ?>
    <main class="main-content">
        <div class="layout-grid">
            <div class="content-area">
                <div class="archive-header liquid-glass" style="padding:24px 32px;margin-bottom:24px;">
                    <h2 style="font-size:1.25rem;font-weight:600;">搜索: "<?php $this->archiveTitle('', '', ''); ?>"</h2>
                    <p style="color:var(--color-text-secondary);margin-top:4px;font-size:0.875rem;">
                        找到 <?php $this->getTotal(); ?> 个结果
                    </p>
                </div>
                <div class="article-feed">
                    <?php while ($this->next()): ?>
                    <article class="article-card no-image glass-card reveal" data-post-id="<?php $this->cid(); ?>">
                        <a href="<?php $this->permalink(); ?>" class="article-content">
                            <div class="article-tags">
                                <span><?php $this->category(','); ?></span>
                            </div>
                            <h2><?php $this->title(); ?></h2>
                            <p class="article-excerpt"><?php $this->excerpt(120, '...'); ?></p>
                            <div class="article-meta">
                                <span class="article-meta-item">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                                    </svg>
                                    <?php $this->date('Y-m-d'); ?>
                                </span>
                                <span class="article-meta-item">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                                    </svg>
                                    <?php $this->commentsNum('0', '1', '%d'); ?>
                                </span>
                            </div>
                        </a>
                    </article>
                    <?php endwhile; ?>
                </div>
                <nav class="pagination">
                    <?php $this->pageNav('<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="15 18 9 12 15 6"/></svg>', '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="9 18 15 12 9 6"/></svg>', 1, '...', ['wrapTag' => '', 'itemTag' => 'span', 'textTag' => 'span', 'currentClass' => 'active', 'prevClass' => 'page-btn', 'nextClass' => 'page-btn']); ?>
                </nav>
            </div>
        </div>
    </main>
    <?php $this->need('footer.php'); ?>

<?php else: ?>
    <?php
    // For category, tag, author — reuse index.php which has the listing logic
    $this->need('index.php');
    ?>
<?php endif; ?>
