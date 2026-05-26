<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<article class="lg-glass lg-card">
  <h2><a href="<?php $this->permalink(); ?>"><?php $this->title(); ?></a></h2>
  <p><?php echo $this->fields->liquidSummary ?: $this->excerpt(100, '...'); ?></p>
  <small><?php $this->date('Y-m-d'); ?> · <?php $this->author(); ?></small>
</article>
