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
						<h1 class="text-white">
							<?php $this->archiveTitle(array(
								'category'=>_t('%s'),
								'search'=>_t('%s的搜索结果'),
								'tag' =>_t('%s'),
								'author'=>_t('%s的文章')
								), '');
							?>
						</h1>
					</div>
				</div>
			</div>
			<!-- SVG separator -->
			<div class="separator separator-bottom separator-skew zindex-100">
				<svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
				<polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
				</svg>
			</div>
		</section>
		<!-- Article list -->
		<?php while($this->next()): ?>
			<section class="section">
				<div class="container">
					<h1><a class="text-default" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
					<hr/>
					<h5>
						<span class="badge badge-pill badge-danger text-uppercase"><a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a></span> &nbsp;&nbsp;
						<span class="badge badge-pill badge-info text-uppercase"><time datetime="<?php $this->date('c'); ?>"><?php $this->date(); ?></time></span> &nbsp;&nbsp;
						<span class="badge badge-pill badge-success text-uppercase"><?php $this->category('d'); ?></span>
					</h5>
					<div class="lead">
						<?php $content = $this->content('...'); ?>
					</div>
					<hr/>
					<a href="<?php $this->permalink() ?>">
						<button class="btn btn-icon btn-3 btn-primary" type="button">
							<span class="btn-inner--icon"><i class="ni ni-button-play"></i></span>
							<span class="btn-inner--text">继续阅读</span>
						</button>
					</a>
				</div>
			</section>
		<?php endwhile; ?>
		<!-- Toggle page -->
		<section class="section">
			<div class="container">
				<div class="row justify-content-md-center">
					<div class="col col-md-auto">
						<?php $this->pageLink('
							<button class="btn btn-icon btn-3 btn-default" type="button">
								<span class="btn-inner--icon"><i class="ni ni-bold-left"></i></span>
								<span class="btn-inner--text">上一页</span>
							</button>
						'); ?>
					</div>
					<div class="col col-md-auto">
						<?php $this->pageLink('
							<button class="btn btn-icon btn-3 btn-default" type="button">
								<span class="btn-inner--text">下一页</span>
								<span class="btn-inner--icon"><i class="ni ni-bold-right"></i></span>
							</button>
						','next'); ?>
					</div>
				</div>
			</div>
		</section>

<?php $this->need('footer.php'); ?>