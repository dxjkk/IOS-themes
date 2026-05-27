<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<main class="main-content">
    <div class="layout-grid">
        <div class="content-area" style="text-align:center;padding:80px 0;">
            <div class="not-found-card liquid-glass" style="padding:60px 40px;max-width:500px;margin:0 auto;">
                <div style="font-size:72px;margin-bottom:16px;">🔍</div>
                <h1 style="font-size:2rem;font-weight:700;margin-bottom:12px;">404</h1>
                <p style="color:var(--color-text-secondary);margin-bottom:24px;">抱歉，你访问的页面不存在。</p>
                <a href="<?php $this->options->siteUrl(); ?>" class="not-found-btn"
                   style="display:inline-flex;align-items:center;gap:8px;padding:12px 24px;background:linear-gradient(135deg, var(--color-accent), var(--color-accent-secondary));color:#fff;border-radius:var(--radius-full);font-weight:var(--weight-medium);">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    返回首页
                </a>
            </div>
        </div>
    </div>
</main>

<?php $this->need('footer.php'); ?>
