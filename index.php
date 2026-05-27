<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<!-- Main Content -->
<main class="main-content">
    <div class="layout-grid">
        <!-- Left Sidebar -->
        <?php $this->need('sidebar.php'); ?>

        <!-- Center Content -->
        <div class="content-area">
            <?php if ($this->is('index') && (empty($this->_currentPage) || $this->_currentPage <= 1)): ?>
            <!-- Featured Article — first post on page 1 -->
            <?php if ($this->have()): $this->next(); ?>
            <div class="featured-spot" id="featuredSpot">
                <article class="article-card featured glass-card reveal-scale">
                    <a href="<?php $this->permalink(); ?>" class="article-content">
                        <div class="article-tags">
                            <span><?php $this->category(','); ?></span>
                            <span class="tag-featured">精选</span>
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
                                <?php $this->commentsNum('%d 评论'); ?>
                            </span>
                        </div>
                    </a>
                    <a href="<?php $this->permalink(); ?>" class="article-cover">
                        <?php $thumb = getPostThumb($this); ?>
                        <?php if ($thumb): ?>
                        <img src="<?php echo $thumb; ?>" alt="<?php $this->title(); ?>" loading="lazy">
                        <?php else: ?>
                        <div class="article-cover-placeholder" style="background:linear-gradient(135deg, <?php echo randomGradient(); ?>);">📄</div>
                        <?php endif; ?>
                    </a>
                </article>
            </div>
            <?php endif; ?>

            <!-- Article Feed -->
            <div class="article-feed" id="articleFeed">
                <?php $postIndex = 0; ?>
                <?php while ($this->next()): ?>
                <?php $thumb = getPostThumb($this); ?>
                <article class="article-card glass-card reveal<?php echo $thumb ? '' : ' no-image'; ?>" data-post-id="<?php $this->cid(); ?>">
                    <a href="<?php $this->permalink(); ?>" class="article-content">
                        <div class="article-tags">
                            <span><?php $this->category(','); ?></span>
                        </div>
                        <h2><?php $this->title(); ?></h2>
                        <p class="article-excerpt"><?php $this->excerpt(100, '...'); ?></p>
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
                    <?php if ($thumb): ?>
                    <a href="<?php $this->permalink(); ?>" class="article-cover">
                        <img src="<?php echo $thumb; ?>" alt="<?php $this->title(); ?>" loading="lazy">
                    </a>
                    <?php endif; ?>
                </article>
                <?php $postIndex++; ?>
                <?php if ($postIndex % 3 === 0 && $this->options->adInline): ?>
                <div class="article-inline-ad glass-card">
                    <div class="ad-content"><?php echo $this->options->adInline; ?></div>
                </div>
                <?php endif; ?>
                <?php endwhile; ?>
            </div>
            <?php else: ?>
            <!-- Non-homepage listing (archive, category, search, etc.) -->
            <div class="article-feed" id="articleFeed">
                <?php $postIndex = 0; ?>
                <?php while ($this->next()): ?>
                <?php $thumb = getPostThumb($this); ?>
                <article class="article-card glass-card reveal<?php echo $thumb ? '' : ' no-image'; ?>" data-post-id="<?php $this->cid(); ?>">
                    <a href="<?php $this->permalink(); ?>" class="article-content">
                        <div class="article-tags">
                            <span><?php $this->category(','); ?></span>
                        </div>
                        <h2><?php $this->title(); ?></h2>
                        <p class="article-excerpt"><?php $this->excerpt(100, '...'); ?></p>
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
                    <?php if ($thumb): ?>
                    <a href="<?php $this->permalink(); ?>" class="article-cover">
                        <img src="<?php echo $thumb; ?>" alt="<?php $this->title(); ?>" loading="lazy">
                    </a>
                    <?php endif; ?>
                </article>
                <?php $postIndex++; ?>
                <?php if ($postIndex % 3 === 0 && $this->options->adInline): ?>
                <div class="article-inline-ad glass-card">
                    <div class="ad-content"><?php echo $this->options->adInline; ?></div>
                </div>
                <?php endif; ?>
                <?php endwhile; ?>
            </div>
            <?php endif; ?>

            <!-- Pagination -->
            <nav class="pagination" id="pagination">
                <?php $this->pageNav('<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="15 18 9 12 15 6"/></svg>', '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="9 18 15 12 9 6"/></svg>', 1, '...', [
                    'wrapTag'   => '',
                    'itemTag'   => 'span',
                    'textTag'   => 'span',
                    'currentClass' => 'active',
                    'prevClass' => 'page-btn',
                    'nextClass' => 'page-btn',
                ]); ?>
            </nav>
        </div>

        <!-- Right Sidebar -->
        <?php $this->need('sidebar-right.php'); ?>
    </div>
</main>

<?php $this->need('footer.php'); ?>
