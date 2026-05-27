    <!-- Footer -->
    <footer class="footer">
        <div class="footer-inner">
            <div class="footer-brand">
                <span class="footer-logo"><?php $this->options->title(); ?></span>
                <p class="footer-tagline"><?php $this->options->description(); ?></p>
            </div>
            <div class="footer-links">
                <?php foreach (getFooterLinks() as $link): ?>
                <a href="<?php echo htmlspecialchars($link['url'] ?? '#'); ?>">
                    <?php echo htmlspecialchars($link['label'] ?? ''); ?>
                </a>
                <?php endforeach; ?>
            </div>
            <p class="footer-copy">&copy; <?php echo date('Y'); ?> <?php $this->options->title(); ?>. Powered by <a href="https://typecho.org">Typecho</a>.</p>
        </div>
    </footer>

    <!-- Mobile Bottom Dock -->
    <nav class="mobile-dock liquid-glass" id="mobileDock">
        <a href="<?php $this->options->siteUrl(); ?>" class="dock-item active" data-dock="home">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
            <span>首页</span>
        </a>
        <a href="#" class="dock-item" data-dock="categories">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
                <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
            </svg>
            <span>分类</span>
        </a>
        <a href="#" class="dock-item" data-dock="nav">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
            </svg>
            <span>导航</span>
        </a>
        <a href="#" class="dock-item" data-dock="search">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
            </svg>
            <span>搜索</span>
        </a>
        <a href="#" class="dock-item" data-dock="more">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <circle cx="12" cy="5" r="1"/><circle cx="12" cy="12" r="1"/><circle cx="12" cy="19" r="1"/>
            </svg>
            <span>更多</span>
        </a>
    </nav>

    <!-- Bottom Sheet (mobile) -->
    <div class="bottom-sheet" id="bottomSheet">
        <div class="sheet-backdrop" id="sheetBackdrop"></div>
        <div class="sheet-container liquid-glass" id="sheetContainer">
            <div class="sheet-handle"></div>
            <div class="sheet-content" id="sheetContent"></div>
        </div>
    </div>

    <?php $this->footer(); ?>

    <script>
    // Pass theme data to JS
    window.LIQUIDGLASS = {
        themeUrl: <?php echo json_encode($this->options->themeUrl); ?>,
        siteUrl: <?php echo json_encode($this->options->siteUrl); ?>,
        navLinks: <?php echo json_encode(getNavLinks()); ?>,
        navLinksExtra: <?php echo json_encode(getNavLinksExtra()); ?>,
        categories: <?php echo json_encode(array_map(function($cat) {
            return ['id' => $cat['mid'], 'name' => $cat['name'], 'slug' => $cat['slug']];
        }, Typecho_Widget::widget('Widget_Metas_Category_List')->stack ?? [])); ?>,
        weather: <?php echo json_encode([
            'enable' => $this->options->weatherEnable == '1',
            'city' => $this->options->weatherCity ?? '北京',
        ]); ?>
    };
    </script>
</body>
</html>
