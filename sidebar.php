<!-- Left Sidebar -->
<aside class="sidebar sidebar-left" id="sidebarLeft">
    <!-- iPadOS-style Navigation -->
    <nav class="sidebar-nav liquid-glass">
        <a href="<?php $this->options->siteUrl(); ?>" class="sidebar-nav-item active" data-nav="home">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
            <span>首页</span>
        </a>
        <a href="#categories" class="sidebar-nav-item" data-nav="categories">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
                <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
            </svg>
            <span>分类</span>
        </a>
        <a href="<?php $this->options->siteUrl(); ?>" class="sidebar-nav-item" data-nav="featured">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
            </svg>
            <span>精选</span>
        </a>

        <div class="sidebar-nav-divider"></div>

        <a href="#" class="sidebar-nav-item" data-nav="ai">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M12 2a4 4 0 0 1 4 4v2a4 4 0 0 1-8 0V6a4 4 0 0 1 4-4z"/>
                <path d="M8 14v-2a4 4 0 0 1 4-4h.01"/><path d="M4 22h16"/><path d="M10 14h4"/>
            </svg>
            <span>AI 工具</span>
        </a>
        <a href="#" class="sidebar-nav-item" data-nav="tutorials">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
            </svg>
            <span>教程</span>
        </a>
        <a href="#" class="sidebar-nav-item" data-nav="resources">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/>
            </svg>
            <span>资源</span>
        </a>

        <div class="sidebar-nav-divider"></div>

        <a href="#" class="sidebar-nav-item" data-nav="timeline">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
            </svg>
            <span>时间线</span>
        </a>
        <a href="#" class="sidebar-nav-item" data-nav="guestbook">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
            </svg>
            <span>留言板</span>
        </a>

        <div class="sidebar-nav-divider"></div>

        <a href="#" class="sidebar-nav-item" data-nav="theme" onclick="App._toggleTheme();return false;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <circle cx="12" cy="12" r="5"/>
                <path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>
            </svg>
            <span>切换主题</span>
        </a>
        <a href="<?php $this->options->siteUrl(); ?>feed/" class="sidebar-nav-item" data-nav="rss">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M4 11a9 9 0 0 1 9 9"/><path d="M4 4a16 16 0 0 1 16 16"/><circle cx="5" cy="19" r="1"/>
            </svg>
            <span>RSS</span>
        </a>
        <a href="https://github.com" target="_blank" rel="noopener" class="sidebar-nav-item" data-nav="github">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/>
            </svg>
            <span>GitHub</span>
        </a>
    </nav>

    <!-- Ad Card -->
    <div class="sidebar-card ad-card glass-card" id="adCardLeft">
        <span class="card-label">广告</span>
        <?php if ($this->options->adLeft): ?>
        <div class="ad-content"><?php echo $this->options->adLeft; ?></div>
        <?php else: ?>
        <div class="ad-placeholder">
            <div class="ad-placeholder-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                    <rect x="2" y="7" width="20" height="15" rx="2"/><path d="M17 2H7a2 2 0 0 0-2 2v3h14V4a2 2 0 0 0-2-2z"/>
                </svg>
            </div>
            <p>广告位 — 左侧栏</p>
        </div>
        <?php endif; ?>
    </div>

    <!-- Site Stats -->
    <?php $stats = getSiteStats(); ?>
    <div class="sidebar-card stats-card glass-card">
        <h4 class="card-title">站点统计</h4>
        <div class="stats-grid">
            <div class="stat-item">
                <span class="stat-value"><?php echo number_format($stats['posts']); ?></span>
                <span class="stat-label">文章</span>
            </div>
            <div class="stat-item">
                <span class="stat-value"><?php echo number_format($stats['comments']); ?></span>
                <span class="stat-label">评论</span>
            </div>
            <div class="stat-item">
                <span class="stat-value"><?php echo number_format($stats['categories']); ?></span>
                <span class="stat-label">分类</span>
            </div>
            <div class="stat-item">
                <span class="stat-value"><?php echo number_format($stats['tags']); ?></span>
                <span class="stat-label">标签</span>
            </div>
        </div>
    </div>

    <!-- Tag Cloud -->
    <div class="sidebar-card tags-card glass-card">
        <h4 class="card-title">热门标签</h4>
        <div class="tag-cloud">
            <?php
            Typecho_Widget::widget('Widget_Metas_Tag_Cloud', 'sort=count&ignoreZeroCount=1&limit=20')->to($tags);
            while ($tags->next()):
            ?>
            <a href="<?php $tags->permalink(); ?>" class="tag-item"><?php $tags->name(); ?> (<?php $tags->count(); ?>)</a>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Custom Widget -->
    <div class="sidebar-card widget-card glass-card">
        <h4 class="card-title">公告</h4>
        <div class="widget-content">
            <p class="widget-text"><?php echo nl2br(htmlspecialchars($this->options->widgetText ?? '')); ?></p>
        </div>
    </div>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
        <span class="status-dot"></span>
        在线 · <span id="sidebarTime">--:--</span>
    </div>
</aside>
