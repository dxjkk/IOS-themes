<?php
/**
 * LiquidGlass — Apple Liquid Glass Design Theme for Typecho 1.3+
 * PHP 8.0+
 */

// -----------------------------------------------------------
// Theme config — admin panel options
// -----------------------------------------------------------
function themeConfig(Typecho_Widget_Helper_Form $form): void
{
    // -- Nav links (JSON array of {icon, label, url})
    $navLinks = new Typecho_Widget_Helper_Form_Element_Textarea(
        'navLinks', null,
        '[{"icon":"📱","label":"Apple","url":"https://apple.com"},{"icon":"💻","label":"GitHub","url":"https://github.com"},{"icon":"🎨","label":"设计","url":"#"},{"icon":"📚","label":"文档","url":"#"},{"icon":"🔧","label":"工具","url":"#"},{"icon":"🤖","label":"AI","url":"#"},{"icon":"📰","label":"资讯","url":"#"},{"icon":"🎵","label":"音乐","url":"#"}]',
        _t('导航链接'), _t('JSON格式，每项包含 icon(emoji)、label、url')
    );
    $form->addInput($navLinks);

    // -- Extra nav links
    $navLinksExtra = new Typecho_Widget_Helper_Form_Element_Textarea(
        'navLinksExtra', null,
        '[{"icon":"📷","label":"摄影","url":"#"},{"icon":"🎮","label":"游戏","url":"#"},{"icon":"✈️","label":"旅行","url":"#"},{"icon":"📊","label":"数据","url":"#"}]',
        _t('更多导航链接'), _t('展开面板中的额外链接')
    );
    $form->addInput($navLinksExtra);

    // -- Ad slots
    $adLeft = new Typecho_Widget_Helper_Form_Element_Textarea(
        'adLeft', null, '',
        _t('左侧广告位'), _t('支持HTML代码')
    );
    $form->addInput($adLeft);

    $adRight = new Typecho_Widget_Helper_Form_Element_Textarea(
        'adRight', null, '',
        _t('右侧广告位'), _t('支持HTML代码')
    );
    $form->addInput($adRight);

    $adInline = new Typecho_Widget_Helper_Form_Element_Textarea(
        'adInline', null, '',
        _t('文章流内嵌广告'), _t('每3篇文章显示一次，支持HTML')
    );
    $form->addInput($adInline);

    // -- Promo card
    $promoIcon = new Typecho_Widget_Helper_Form_Element_Text(
        'promoIcon', null, '🚀',
        _t('推荐卡片图标'), _t('emoji 图标')
    );
    $form->addInput($promoIcon);

    $promoTitle = new Typecho_Widget_Helper_Form_Element_Text(
        'promoTitle', null, '',
        _t('推荐卡片标题'), _t('留空则不显示推荐卡片')
    );
    $form->addInput($promoTitle);

    $promoDesc = new Typecho_Widget_Helper_Form_Element_Text(
        'promoDesc', null, '',
        _t('推荐卡片描述')
    );
    $form->addInput($promoDesc);

    $promoCta = new Typecho_Widget_Helper_Form_Element_Text(
        'promoCta', null, '了解更多',
        _t('推荐卡片按钮文字')
    );
    $form->addInput($promoCta);

    $promoUrl = new Typecho_Widget_Helper_Form_Element_Text(
        'promoUrl', null, '',
        _t('推荐卡片链接')
    );
    $form->addInput($promoUrl);

    // -- Weather widget
    $weatherEnable = new Typecho_Widget_Helper_Form_Element_Radio(
        'weatherEnable',
        ['1' => _t('开启'), '0' => _t('关闭')],
        '1',
        _t('天气小组件'), _t('是否显示天气卡片')
    );
    $form->addInput($weatherEnable);

    $weatherCity = new Typecho_Widget_Helper_Form_Element_Text(
        'weatherCity', null, '北京',
        _t('天气城市')
    );
    $form->addInput($weatherCity);

    // -- SEO
    $seoKeywords = new Typecho_Widget_Helper_Form_Element_Text(
        'seoKeywords', null, '',
        _t('SEO关键词'), _t('多个关键词用英文逗号分隔')
    );
    $form->addInput($seoKeywords);

    $seoDescription = new Typecho_Widget_Helper_Form_Element_Textarea(
        'seoDescription', null, '',
        _t('SEO描述')
    );
    $form->addInput($seoDescription);

    // -- Custom widget text
    $widgetText = new Typecho_Widget_Helper_Form_Element_Textarea(
        'widgetText', null,
        '欢迎来到 ' . Helper::options()->title . '。这里汇集了科技、AI、设计等领域的最新内容。',
        _t('公告栏内容')
    );
    $form->addInput($widgetText);

    // -- Footer links
    $footerLinks = new Typecho_Widget_Helper_Form_Element_Textarea(
        'footerLinks', null,
        '[{"label":"关于","url":"#"},{"label":"归档","url":"#"},{"label":"友链","url":"#"},{"label":"RSS","url":"#"}]',
        _t('页脚链接'), _t('JSON格式')
    );
    $form->addInput($footerLinks);
}

// -----------------------------------------------------------
// Theme init — fired before routing
// -----------------------------------------------------------
function themeInit(): void
{
    // nothing needed at init
}

// -----------------------------------------------------------
// Helper: Get nav links from options
// -----------------------------------------------------------
function getNavLinks(): array
{
    $json = Helper::options()->navLinks ?? '[]';
    $links = json_decode($json, true);
    return is_array($links) ? $links : [];
}

function getNavLinksExtra(): array
{
    $json = Helper::options()->navLinksExtra ?? '[]';
    $links = json_decode($json, true);
    return is_array($links) ? $links : [];
}

function getFooterLinks(): array
{
    $json = Helper::options()->footerLinks ?? '[]';
    $links = json_decode($json, true);
    return is_array($links) ? $links : [];
}

// -----------------------------------------------------------
// Helper: Get post thumbnail URL
// -----------------------------------------------------------
function getPostThumb(Widget_Archive $post): string
{
    // Check custom fields
    if ($post->fields->thumb) {
        return $post->fields->thumb;
    }
    if ($post->fields->image) {
        return $post->fields->image;
    }

    // Check first attachment
    if ($post->attachments(1)->attachment) {
        $attach = $post->attachments(1)->attachment;
        if (preg_match('/\.(jpg|jpeg|png|gif|webp|svg)/i', $attach['path'] ?? '')) {
            return $attach['url'] ?? '';
        }
    }

    // Check first img in content
    if (preg_match('/<img[^>]+src=["\']([^"\']+)["\']/', $post->text ?? '', $m)) {
        return $m[1];
    }

    return '';
}

// -----------------------------------------------------------
// Helper: Random gradient for placeholder thumbnails
// -----------------------------------------------------------
function randomGradient(): string
{
    $gradients = [
        '#667eea,#764ba2',
        '#f093fb,#f5576c',
        '#4facfe,#00f2fe',
        '#43e97b,#38f9d7',
        '#fa709a,#fee140',
        '#a18cd1,#fbc2eb',
        '#fccb90,#d57eeb',
        '#e0c3fc,#8ec5fc',
    ];
    return $gradients[array_rand($gradients)];
}

// -----------------------------------------------------------
// Helper: Category icon
// -----------------------------------------------------------
function categoryIcon(string $category): string
{
    $map = [
        '科技' => '💻', '技术' => '💻',
        'AI'   => '🤖', '人工智能' => '🤖',
        '教程' => '📖', '教学' => '📖',
        '设计' => '🎨',
        '分享' => '✨',
    ];
    return $map[$category] ?? '📄';
}

// -----------------------------------------------------------
// Helper: Get total site stats
// -----------------------------------------------------------
function getSiteStats(): array
{
    $db = Typecho_Db::get();
    return [
        'posts'      => (int) $db->fetchObject($db->select('COUNT(*) as num')->from('table.contents')
            ->where('type = ?', 'post')->where('status = ?', 'publish'))->num,
        'comments'   => (int) $db->fetchObject($db->select('COUNT(*) as num')->from('table.comments')
            ->where('status = ?', 'approved'))->num,
        'categories' => (int) $db->fetchObject($db->select('COUNT(*) as num')->from('table.metas')
            ->where('type = ?', 'category'))->num,
        'tags'       => (int) $db->fetchObject($db->select('COUNT(*) as num')->from('table.metas')
            ->where('type = ?', 'tag'))->num,
    ];
}
