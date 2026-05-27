<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<main class="main-content">
    <div class="layout-grid single-post-layout">
        <!-- Left Sidebar -->
        <?php $this->need('sidebar.php'); ?>

        <!-- Center Content -->
        <div class="content-area">
            <article class="post-full liquid-glass" itemscope itemtype="http://schema.org/BlogPosting">
                <!-- Post Header -->
                <header class="post-full-header">
                    <span class="post-card-category"><?php $this->category(','); ?></span>
                    <h1 class="post-full-title" itemprop="name headline"><?php $this->title(); ?></h1>
                    <div class="post-full-meta">
                        <span class="post-full-meta-item" itemprop="author" itemscope itemtype="http://schema.org/Person">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                            </svg>
                            <span itemprop="name"><?php $this->author(); ?></span>
                        </span>
                        <span class="post-full-meta-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date('Y-m-d'); ?></time>
                        </span>
                        <span class="post-full-meta-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                            </svg>
                            <?php $this->commentsNum('暂无评论', '1 条评论', '%d 条评论'); ?>
                        </span>
                    </div>
                </header>

                <!-- Featured Image -->
                <?php $thumb = getPostThumb($this); ?>
                <?php if ($thumb): ?>
                <div class="post-full-thumb">
                    <img src="<?php echo $thumb; ?>" alt="<?php $this->title(); ?>" itemprop="image">
                </div>
                <?php endif; ?>

                <!-- Post Content -->
                <div class="post-full-content" itemprop="articleBody">
                    <?php $this->content(); ?>
                </div>

                <!-- Tags -->
                <?php if ($this->tags): ?>
                <div class="post-full-tags">
                    <span class="tags-label">标签:</span>
                    <?php $this->tags(' ', true, ''); ?>
                </div>
                <?php endif; ?>

                <!-- Copyright -->
                <div class="post-full-copyright">
                    <p>本文作者: <?php $this->author(); ?></p>
                    <p>本文链接: <a href="<?php $this->permalink(); ?>"><?php $this->permalink(); ?></a></p>
                    <p>版权声明: 如无特别说明，本站文章均为原创，转载请注明出处。</p>
                </div>

                <!-- Prev / Next -->
                <nav class="post-full-nav">
                    <span class="post-nav-prev">
                        <?php $this->thePrev('%s', '上一篇: 暂无'); ?>
                    </span>
                    <span class="post-nav-next">
                        <?php $this->theNext('%s', '下一篇: 暂无'); ?>
                    </span>
                </nav>
            </article>

            <!-- Related Posts -->
            <?php
            $relatedPosts = null;
            $db = Typecho_Db::get();
            $tags = $this->tags;
            if ($tags):
                $tagIds = [];
                while ($tags->next()) {
                    $tagIds[] = $tags->mid;
                }
                if ($tagIds):
                    $relatedPosts = $db->fetchAll(
                        $db->select()->from('table.contents')
                            ->join('table.relationships', 'table.contents.cid = table.relationships.cid')
                            ->where('table.relationships.mid IN (?)', implode(',', $tagIds))
                            ->where('table.contents.cid != ?', $this->cid)
                            ->where('table.contents.type = ?', 'post')
                            ->where('table.contents.status = ?', 'publish')
                            ->group('table.contents.cid')
                            ->order('table.contents.created', Typecho_Db::SORT_DESC)
                            ->limit(3)
                    );
                endif;
            endif;
            ?>
            <?php if ($relatedPosts): ?>
            <section class="related-posts">
                <h3 class="related-title">相关文章</h3>
                <div class="related-grid">
                    <?php foreach ($relatedPosts as $rp): ?>
                    <a href="<?php
                        $rpPath = Typecho_Router::url('post', ['cid' => $rp['cid'], 'slug' => $rp['slug']]);
                        echo Typecho_Common::url($rpPath, Helper::options()->siteUrl);
                    ?>" class="related-item liquid-glass">
                        <span class="related-item-title"><?php echo $rp['title']; ?></span>
                        <span class="related-item-date"><?php echo date('Y-m-d', $rp['created']); ?></span>
                    </a>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endif; ?>

            <!-- Comments -->
            <?php $this->need('comments.php'); ?>
        </div>

        <!-- Right Sidebar -->
        <?php $this->need('sidebar-right.php'); ?>
    </div>
</main>

<?php $this->need('footer.php'); ?>
