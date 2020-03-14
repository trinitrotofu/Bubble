<?php
/**
 * Typecho 极简风格响应式主题
 * 
 * @package Bubble
 * @author TriNitroTofu and Boshi
 * @version 2.2
 * @link https://github.com/trinitrotofu/Bubble
 */

	if (!defined('__TYPECHO_ROOT_DIR__')) exit;
	$this->need('header.php');
?>

	<main>
		<section class="section section-lg section-hero section-shaped">
			<!-- Background circles -->
			<div class="shape shape-style-1 shape-primary">
				<span class="span-150"></span>
				<span class="span-50"></span>
				<span class="span-50"></span>
				<span class="span-75"></span>
				<span class="span-100"></span>
				<span class="span-75"></span>
				<span class="span-50"></span>
				<span class="span-100"></span>
				<span class="span-50"></span>
				<span class="span-100"></span>
			</div>
			<div class="container shape-container d-flex align-items-center py-lg">
				<div class="col px-0">
					<div class="row align-items-center justify-content-center">
						<div class="col-lg-6 text-center">
							<img src="<?php
								if ($this->options->avatarUrl) {
									$this->options->avatarUrl();
								} else {
									$this->options->themeUrl("images/avatar.png");
								}
							?>" class="avatar" style="margin-bottom: 1rem; height: 100px; width: 100px;">
							<h1 class="text-white"><?php $this->options->title() ?></h1>
							<hr/>
							<p class="lead text-white"><?php $this->options->description() ?></p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<div class="card shadow content-card list-card content-card-head">
			<!-- Article list -->
			<?php while($this->next()): ?>
			<section class="section">
				<div class="container">
					<div class="content">
						<h1><a class="text-default" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
						<div class="list-object">
							<span class="list-tag"><i class="fa fa-calendar-o" aria-hidden="true"></i> <time datetime="<?php $this->date('c'); ?>"><?php $this->date();?></time></span>
							<span class="list-tag"><i class="fa fa-comments-o" aria-hidden="true"></i> <?php $this->commentsNum('%d');?> 条评论</span>
							<span class="list-tag"><i class="fa fa-folder-o" aria-hidden="true"></i>
								<?php print($this->widget('Widget_Metas_Category_List')->parse('<a href="{permalink}" class="badge badge-info badge-pill">{name}</a>')) ?>
							</span>
							<span class="list-tag">
							<?php if (count($this->tags)>0): ?>
								<i class="fa fa-tags" aria-hidden="true"></i> 
								<?php foreach( $this->tags as $tags): ?>
								<a href="<?php print($tags['permalink']) ?>" class="badge badge-success badge-pill"><?php print($tags['name']) ?></a>
								<?php endforeach;?>
							<?php else: ?>
								<i class="fa fa-tags" aria-hidden="true"></i> <a class="badge badge-default badge-pill text-white">无标签</a>
							<?php endif;?>
							</span>
							<span class="list-tag"><i class="fa fa-user-o" aria-hidden="true"></i> <a class="badge badge-warning badge-pill" href="<?php $this->author->permalink(); ?>"><?php $this->author();?></a></span>
						</div>
						<?php $content = $this->content('...'); ?>
						<br/>
						<a href="<?php $this->permalink() ?>">
							<button class="btn btn-icon btn-3 btn-primary" type="button">
								<span class="btn-inner--icon"><i class="fa fa-play" aria-hidden="true"></i></span>
								<span class="btn-inner--text">继续阅读</span>
							</button>
						</a>
					</div>
				</div>
			</section>
			<?php endwhile; ?>
			<!-- Toggle page -->
			<?php if ($this->getTotal() > $this->parameter->pageSize) { ?>
			<section class="section">
				<div class="container">
					<div class="row justify-content-md-center">
						<div class="col col-md-auto">
							<?php $this->pageLink('
								<button class="btn btn-icon btn-3 btn-default" type="button">
									<span class="btn-inner--icon"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
									<span class="btn-inner--text">上一页</span>
								</button>
							'); ?>
						</div>
						<div class="col col-md-auto">
							<?php $this->pageLink('
								<button class="btn btn-icon btn-3 btn-default" type="button">
									<span class="btn-inner--text">下一页</span>
									<span class="btn-inner--icon"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
								</button>
							','next'); ?>
						</div>
					</div>
				</div>
			</section>
			<?php } ?>
		</div>

<?php $this->need('footer.php'); ?>