<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function themeConfig($form) {
	$logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO'));
	$form->addInput($logoUrl);
	$avatarUrl = new Typecho_Widget_Helper_Form_Element_Text('avatarUrl', NULL, NULL, _t('站点头像地址'), _t('在这里填入一个图片 URL 地址, 以在网站首页上加上一个头像'));
	$form->addInput($avatarUrl);
	$footerText = new Typecho_Widget_Helper_Form_Element_Text('footerText', NULL, 'Powered by <a href="http://typecho.org/">Typecho</a> | Theme by <a href="https://github.com/trinitrotofu/Bubble">Bubble</a>', _t('页脚左下角文字'), _t('在这里填入页脚左下角的说明文字，如 Copyright 和 备案信息'));
	$form->addInput($footerText);
	$footerWidget = new Typecho_Widget_Helper_Form_Element_Radio('footerWidget', array('0' => _t('不显示'), '1' => _t('显示')), '1', _t('页脚小工具'), _t('选择是否在页面底部显示“最新评论”、“最新文章”等栏目'));
	$form->addInput($footerWidget);
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
				<?php $that->content('...'); ?>
				<br/>
				<a href="<?php $that->permalink() ?>">
					<button class="btn btn-icon btn-3 btn-primary" type="button">
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
				<div class="row justify-content-md-center">
					<div class="col col-md-auto">
						<?php $that->pageLink('
							<button class="btn btn-icon btn-3 btn-default" type="button">
								<span class="btn-inner--icon"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
								<span class="btn-inner--text">上一页</span>
							</button>
						'); ?>
					</div>
					<div class="col col-md-auto">
						<?php $that->pageLink('
							<button class="btn btn-icon btn-3 btn-default" type="button">
								<span class="btn-inner--text">下一页</span>
								<span class="btn-inner--icon"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
							</button>
						','next'); ?>
					</div>
				</div>
			</div>
		</section>
	<?php }
}