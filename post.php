<?php
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
				<div class="col px-0 text-center">
					<div class="row align-items-center justify-content-center">
						<h1 class="text-white"><?php $this->title() ?></h1>
					</div>
					<div class="row align-items-center justify-content-center">
						<h5 class="text-white">于 <time datetime="<?php $this->date('c'); ?>"><?php $this->date(); ?></time> 由 <?php $this->author(); ?> 发布</h5>
					</div>
				</div>
			</div>
		</section>
		<div class="card shadow content-card content-card-head">
			<!-- Article content -->
			<section class="section">
				<div class="container">
					<div class="content">
						<?php $this->content(); ?>
						<hr/>
						<ul>
							<li>分类：<span class="list-tag">
								<?php print($this->widget('Widget_Metas_Category_List')->parse('<a href="{permalink}" class="badge badge-info badge-pill">{name}</a>')) ?>
								</span>
							</li>
							<li>
								标签：<span class="list-tag">
								<?php if (count($this->tags)>0): ?>
									<?php foreach( $this->tags as $tags): ?>
									<a href="<?php print($tags['permalink']) ?>" class="badge badge-success badge-pill"><?php print($tags['name']) ?></a>
									<?php endforeach;?>
								<?php else: ?>
									<a class="badge badge-default badge-pill text-white">无标签</a>
								<?php endif;?>
								</span>
							</li>
						</ul>
						<?php if($this->user->hasLogin()) : ?>
							<a href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid;?>"><button class="btn btn-sm btn-primary" type="button"><i class="fa fa-pencil" aria-hidden="true"></i> 修改文章</button></a>
						<?php endif; ?>
					</div>
				</div>
			</section>
			<!-- Comment -->
			<?php $this->need('comments.php'); ?>
		</div>
<?php $this->need('footer.php'); ?>