<!-- Right Sidebar -->
<aside class="sidebar sidebar-right" id="sidebarRight">
    <!-- Ad Card -->
    <div class="sidebar-card ad-card glass-card">
        <span class="card-label">广告</span>
        <?php if ($this->options->adRight): ?>
        <div class="ad-content"><?php echo $this->options->adRight; ?></div>
        <?php else: ?>
        <div class="ad-placeholder">
            <div class="ad-placeholder-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                    <rect x="2" y="7" width="20" height="15" rx="2"/><path d="M17 2H7a2 2 0 0 0-2 2v3h14V4a2 2 0 0 0-2-2z"/>
                </svg>
            </div>
            <p>广告位 — 右侧栏</p>
        </div>
        <?php endif; ?>
    </div>

    <!-- Promo Card -->
    <?php if ($this->options->promoTitle): ?>
    <a href="<?php echo $this->options->promoUrl ?: '#'; ?>" class="sidebar-card promo-card glass-card" target="_blank" rel="noopener">
        <div class="promo-icon"><?php echo $this->options->promoIcon ?: '🚀'; ?></div>
        <div class="promo-title"><?php echo $this->options->promoTitle; ?></div>
        <?php if ($this->options->promoDesc): ?>
        <div class="promo-desc"><?php echo $this->options->promoDesc; ?></div>
        <?php endif; ?>
        <span class="promo-cta"><?php echo $this->options->promoCta ?: '了解更多'; ?></span>
    </a>
    <?php endif; ?>

    <!-- Latest Posts -->
    <div class="sidebar-card latest-card glass-card">
        <h4 class="card-title">最新文章</h4>
        <ul class="latest-list">
            <?php
            Typecho_Widget::widget('Widget_Contents_Post_Recent', 'pageSize=5')->to($recent);
            while ($recent->next()):
            ?>
            <li class="latest-item">
                <a href="<?php $recent->permalink(); ?>" class="latest-item-link">
                    <span class="latest-item-thumb" style="
                        background:linear-gradient(135deg, <?php echo randomGradient(); ?>);
                    "></span>
                    <span class="latest-item-info">
                        <span class="latest-item-title"><?php $recent->title(); ?></span>
                        <span class="latest-item-date"><?php $recent->date('Y-m-d'); ?></span>
                    </span>
                </a>
            </li>
            <?php endwhile; ?>
        </ul>
    </div>

    <!-- Weather -->
    <?php if ($this->options->weatherEnable != '0'): ?>
    <div class="sidebar-card weather-card glass-card" id="weatherCard">
        <h4 class="card-title">天气</h4>
        <div class="weather-body">
            <div class="weather-main">
                <span class="weather-temp" id="weatherTemp">--°</span>
                <span class="weather-icon" id="weatherIcon">☀️</span>
            </div>
            <p class="weather-desc" id="weatherDesc">加载中...</p>
            <p class="weather-location" id="weatherLocation"></p>
        </div>
    </div>
    <?php endif; ?>
</aside>
