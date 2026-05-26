<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('components/navbar.php'); ?>
<div class="lg-shell">
  <section class="lg-glass lg-header">
    <div class="lg-pill-row">
      <button class="lg-pill is-active">全部</button><button class="lg-pill">生活</button><button class="lg-pill">科技</button><button class="lg-pill">设计</button><button class="lg-pill">教程</button>
    </div>
    <input class="lg-pill" placeholder="搜索文章、标签..." />
  </section>
  <section class="lg-glass lg-card">
    <div class="lg-grid-nav" id="quickNav"></div>
  </section>

  <main class="lg-layout">
    <?php $this->need('components/sidebar.php'); ?>
    <section class="lg-feed">
      <?php while($this->next()): ?>
        <?php $this->need('components/article-card.php'); ?>
      <?php endwhile; ?>
    </section>
    <?php $this->need('components/sidebar.php'); ?>
  </main>
  <?php $this->need('mobile/dock.php'); ?>
</div>
<?php $this->need('components/footer.php'); ?>
