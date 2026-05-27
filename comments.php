<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<div id="comments" class="comments-section">
    <?php $this->comments()->to($comments); ?>

    <!-- Comments List -->
    <?php if ($comments->have()): ?>
    <h3 class="comments-title"><?php $this->commentsNum('暂无评论', '1 条评论', '%d 条评论'); ?></h3>

    <ol class="comments-list">
        <?php while ($comments->next()): ?>
        <li class="comment-item liquid-glass" id="<?php $comments->theId(); ?>">
            <div class="comment-avatar">
                <?php $comments->gravatar(48, '', '', '', 'comment-avatar-img'); ?>
            </div>
            <div class="comment-body">
                <div class="comment-meta">
                    <cite class="comment-author">
                        <?php $comments->author(); ?>
                        <?php if ($comments->mail == $this->authorId): ?>
                        <span class="comment-badge">作者</span>
                        <?php endif; ?>
                    </cite>
                    <time class="comment-time" datetime="<?php $comments->date('c'); ?>">
                        <?php $comments->date('Y-m-d H:i'); ?>
                    </time>
                    <span class="comment-reply-link">
                        <?php $comments->reply('回复'); ?>
                    </span>
                </div>
                <div class="comment-content">
                    <?php $comments->content(); ?>
                </div>
            </div>

            <!-- Nested replies -->
            <?php if ($comments->children): ?>
            <ol class="comment-children">
                <?php while ($comments->children()): ?>
                <li class="comment-item liquid-glass" id="<?php $comments->theId(); ?>">
                    <div class="comment-avatar">
                        <?php $comments->gravatar(40, '', '', '', 'comment-avatar-img'); ?>
                    </div>
                    <div class="comment-body">
                        <div class="comment-meta">
                            <cite class="comment-author">
                                <?php $comments->author(); ?>
                                <?php if ($comments->mail == $this->authorId): ?>
                                <span class="comment-badge">作者</span>
                                <?php endif; ?>
                            </cite>
                            <time class="comment-time" datetime="<?php $comments->date('c'); ?>">
                                <?php $comments->date('Y-m-d H:i'); ?>
                            </time>
                            <span class="comment-reply-link">
                                <?php $comments->reply('回复'); ?>
                            </span>
                        </div>
                        <div class="comment-content">
                            <?php $comments->content(); ?>
                        </div>
                    </div>
                </li>
                <?php endwhile; ?>
            </ol>
            <?php endif; ?>
        </li>
        <?php endwhile; ?>
    </ol>
    <?php endif; ?>

    <!-- Comment Form -->
    <?php if ($this->allow('comment')): ?>
    <div class="comment-form-wrap liquid-glass" id="<?php $this->respondId(); ?>">
        <h3 class="comment-form-title">
            <?php $comments->cancelReply('取消回复', '发表评论'); ?>
        </h3>

        <form method="post" action="<?php $this->commentUrl(); ?>" id="comment-form" class="comment-form">
            <?php if (!$this->user->hasLogin()): ?>
            <div class="comment-form-row">
                <input type="text" name="author" id="author" class="comment-input" placeholder="昵称 *" value="<?php $this->remember('author'); ?>" required>
                <input type="email" name="mail" id="mail" class="comment-input" placeholder="邮箱 *" value="<?php $this->remember('mail'); ?>" <?php if ($this->options->commentsRequireMail): ?>required<?php endif; ?>>
                <input type="url" name="url" id="url" class="comment-input" placeholder="网站" value="<?php $this->remember('url'); ?>">
            </div>
            <?php else: ?>
            <p class="comment-logged-in">
                已登录: <strong><?php $this->user->screenName(); ?></strong> ·
                <a href="<?php $this->options->logoutUrl(); ?>">退出</a>
            </p>
            <?php endif; ?>

            <div class="comment-form-textarea">
                <textarea name="text" id="textarea" class="comment-textarea" placeholder="写下你的评论..." required><?php $this->remember('text'); ?></textarea>
            </div>

            <button type="submit" class="comment-submit">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                    <line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/>
                </svg>
                提交评论
            </button>
        </form>
    </div>
    <?php else: ?>
    <p class="comments-closed">评论已关闭。</p>
    <?php endif; ?>
</div>
