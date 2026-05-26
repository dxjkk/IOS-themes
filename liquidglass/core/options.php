<?php
if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

function liquidglassThemeOptions(Typecho_Widget_Helper_Form $form): void
{
    $blur = new Typecho_Widget_Helper_Form_Element_Text('blurAmount', null, '40', _t('模糊强度'), _t('建议 20-60')); 
    $radius = new Typecho_Widget_Helper_Form_Element_Text('radiusAmount', null, '28', _t('圆角大小'), _t('单位 px'));
    $adsLeft = new Typecho_Widget_Helper_Form_Element_Textarea('adsLeft', null, '<div>Liquid Glass 广告位</div>', _t('左侧广告 HTML'));
    $adsRight = new Typecho_Widget_Helper_Form_Element_Textarea('adsRight', null, '<div>Liquid Glass 广告位</div>', _t('右侧广告 HTML'));
    $form->addInput($blur);
    $form->addInput($radius);
    $form->addInput($adsLeft);
    $form->addInput($adsRight);
}
