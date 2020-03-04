<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
	$logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO'));
	$form->addInput($logoUrl);

	$avatarUrl = new Typecho_Widget_Helper_Form_Element_Text('avatarUrl', NULL, NULL, _t('站点头像地址'), _t('在这里填入一个图片 URL 地址, 以在网站首页上加上一个头像'));
	$form->addInput($avatarUrl);

	$powerMode = new Typecho_Widget_Helper_Form_Element_Radio('powerMode',
		array('0' => _t('禁用'),
			'1' => _t('启用，但不开启抖动特效'),
			'2' => _t('启用，同时开启抖动特效')),
			'0', _t('Power Mode 输入框特效'));
	$form->addItem($powerMode);
}