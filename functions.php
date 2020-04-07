<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function themeConfig($form) {
	$logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, '', _t('站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址，以在网站标题前加上一个 LOGO'));
	$form->addInput($logoUrl);
	$avatarUrl = new Typecho_Widget_Helper_Form_Element_Text('avatarUrl', NULL, '', _t('站点头像地址'), _t('在这里填入一个图片 URL 地址，以在网站首页上加上一个头像'));
	$form->addInput($avatarUrl);
	$indexImage = new Typecho_Widget_Helper_Form_Element_Text('indexImage', NULL, '', _t('首页背景图像地址'), _t('在这里填入一个图片 URL 地址, 以设定网站首页背景图片，留空则使用默认紫色渐变背景'));
	$form->addInput($indexImage);
	$randomImage = new Typecho_Widget_Helper_Form_Element_Textarea('randomImage', NULL, '', _t('随机背景图像地址'), _t('在这里填入一个或多个图片 URL 地址，每行一个，<strong>请勿包含多余字符</strong>，以设定网站文章页、独立页面以及其他页面的头图，设定后将随机显示，留空则使用默认紫色渐变背景'));
	$form->addInput($randomImage);
	$bubbleShow = new Typecho_Widget_Helper_Form_Element_Radio('bubbleShow', array('0' => _t('不显示'), '1' => _t('显示')), '1', _t('背景气泡'), _t('选择是否在首页以及文章页顶部背景处显示半透明气泡'));
	$form->addInput($bubbleShow);
	$footerText = new Typecho_Widget_Helper_Form_Element_Text('footerText', NULL, 'Powered by <a href="http://typecho.org/" class="footer-link">Typecho</a> | Theme by <a href="https://github.com/trinitrotofu/Bubble" class="footer-link">Bubble</a>', _t('页脚左下角文字'), _t('在这里填入页脚左下角的说明文字，如 Copyright 和 备案信息，可添加 HTML 标签'));
	$form->addInput($footerText);
	$footerWidget = new Typecho_Widget_Helper_Form_Element_Radio('footerWidget', array('0' => _t('不显示'), '1' => _t('显示')), '1', _t('页脚小工具'), _t('选择是否在页面底部显示“最新评论”、“最新文章”等栏目'));
	$form->addInput($footerWidget);
	$customCss = new Typecho_Widget_Helper_Form_Element_Textarea('customCss', NULL, '', _t('自定义 css'), _t('在这里填入所需要的 css，以实现自定义页面样式，如调整字体大小等'));
	$form->addInput($customCss);
	$Pjax = new Typecho_Widget_Helper_Form_Element_Radio('Pjax', array('0' => _t('关闭'), '1' => _t('打开')), '1', _t('开启全站 pjax 模式'), _t('选择是否启用全站 pjax 模式提升用户访问体验。注意：启用该项可能带来页面加载问题，请仔细阅读主题说明文档。'));
	$form->addInput($Pjax);
	$pjaxcomp = new Typecho_Widget_Helper_Form_Element_Textarea('pjaxcomp', NULL, '', _t('pjax 回调代码'), _t('在这里填入 pjax 渲染完毕后需执行的 JS 代码，具体使用方法请仔细阅读主题说明文档'));
	$form->addInput($pjaxcomp);
	$katex = new Typecho_Widget_Helper_Form_Element_Radio('katex', array('0' => _t('关闭'), '1' => _t('打开')), '0', _t('开启 katex 数学公式渲染'), _t('选择是否启用 katex 数学公式渲染'));
	$form->addInput($katex);
	$prismjs = new Typecho_Widget_Helper_Form_Element_Radio('prismjs', array('0' => _t('关闭'), '1' => _t('打开')), '0', _t('开启 prism.js 代码高亮'), _t('选择是否启用 prism.js 代码高亮'));
	$form->addInput($prismjs);
	$prismLine = new Typecho_Widget_Helper_Form_Element_Radio('prismLine', array('0' => _t('关闭'), '1' => _t('打开')), '0', _t('开启 prism.js 行号显示'), _t('选择是否显示 prism.js 代码高亮左侧行号'));
	$form->addInput($prismLine);
	$prismTheme = new Typecho_Widget_Helper_Form_Element_Select('prismTheme',
		array('prism' => _t('default'),
			'prism-coy' => _t('coy'),
			'prism-dark' => _t('dark'),
			'prism-funky' => _t('funky'),
			'prism-okaidia' => _t('okaidia'),
			'prism-solarizedlight' => _t('solarizedlight'),
			'prism-tomorrow' => _t('tomorrow'),
			'prism-twilight' => _t('twilight')
		),
	'prism', _t('prism.js 高亮主题'), _t('选择 prism.js 代码高亮的主题配色'));
	$form->addInput($prismTheme);
}

function printCategory($that, $icon = 0) { ?>
	<span class="list-tag">
		<?php if ($icon) { ?><i class="fa fa-folder-o" aria-hidden="true"></i><?php } ?>
		<?php foreach( $that->categories as $categories): ?>
		<a href="<?php print($categories['permalink']) ?>" class="badge badge-info badge-pill"><?php print($categories['name']) ?></a>
		<?php endforeach;?>
	</span>
<?php }

function printTag($that, $icon = 0) { ?>
	<span class="list-tag">
		<?php if ($icon) { ?><i class="fa fa-tags" aria-hidden="true"></i><?php } ?>
		<?php if (count($that->tags) > 0): ?>
			<?php foreach( $that->tags as $tags): ?>
			<a href="<?php print($tags['permalink']) ?>" class="badge badge-success badge-pill"><?php print($tags['name']) ?></a>
			<?php endforeach;?>
		<?php else: ?>
			<a class="badge badge-default badge-pill text-white">无标签</a>
		<?php endif;?>
	</span>
<?php }

function printAricle($that) { ?>
	<section class="section">
		<div class="container">
			<div class="content">
				<h1><a class="text-default" href="<?php $that->permalink() ?>"><?php $that->title() ?></a></h1>
				<div class="list-object">
					<span class="list-tag"><i class="fa fa-calendar-o" aria-hidden="true"></i> <time datetime="<?php $that->date('c'); ?>"><?php $that->date();?></time></span>
					<span class="list-tag"><i class="fa fa-comments-o" aria-hidden="true"></i> <?php $that->commentsNum('%d');?> 条评论</span>
					<?php printCategory($that, 1); ?>
					<?php printTag($that, 1); ?>
					<span class="list-tag"><i class="fa fa-user-o" aria-hidden="true"></i> <a class="badge badge-warning badge-pill" href="<?php $that->author->permalink(); ?>"><?php $that->author();?></a></span>
				</div>
				<?php $that->content(''); ?>
				<br/>
				<a href="<?php $that->permalink() ?>">
					<button class="btn btn-icon btn-3 btn-outline-primary" type="button">
						<span class="btn-inner--icon"><i class="fa fa-play" aria-hidden="true"></i></span>
						<span class="btn-inner--text">继续阅读</span>
					</button>
				</a>
			</div>
		</div>
	</section>
<?php }

function printToggleButton($that) {
	if ($that->getTotal() > $that->parameter->pageSize) { ?>
		<section class="section">
			<div class="container">
				<nav class="page-nav"><?php $that->pageNav('<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>', 1, '...', array('wrapTag' => 'ul', 'wrapClass' => 'pagination justify-content-center', 'textTag' => 'a', 'currentClass' => 'active', 'prevClass' => '', 'nextClass' => '')); ?></nav>
			</div>
		</section>
	<?php }
}

function printBackground($url, $show) {
	_e('<div ');
	if ($url == '') _e('class="shape shape-style-1 shape-primary"');
	else _e('class="shape shape-style-1 shape-image" style="background-image: url(' . "$url" . ')"');
	_e('>');
	if ($show)
		_e('<span class="span-150"></span>
			<span class="span-50"></span>
			<span class="span-50"></span>
			<span class="span-75"></span>
			<span class="span-100"></span>
			<span class="span-75"></span>
			<span class="span-50"></span>
			<span class="span-100"></span>
			<span class="span-50"></span>
			<span class="span-100"></span>');
	_e('</div>');
}

function getRandomImage($str)
{
	if ($str == '') return '';
	$arr = explode(PHP_EOL, $str);
	return $arr[rand(0, sizeof($arr) - 1)];
}

function clear_urlcan($url)
{
    $rstr='';
    $tmparr=parse_url($url);
    $rstr=empty($tmparr['scheme'])?'http://':$tmparr['scheme'].'://';
    $rstr.=$tmparr['host'].$tmparr['path'];
    return $rstr;
}