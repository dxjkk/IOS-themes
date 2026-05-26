<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('components/navbar.php'); ?>
<div class="lg-shell">
  <article class="lg-glass lg-card"><?php $this->content(); ?></article>
</div>
<?php $this->need('components/footer.php'); ?>
