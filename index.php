<?php
/**
 * Typecho 极简风格响应式主题
 * 
 * @package Bubble
 * @author TriNitroTofu and Boshi
 * @version 1.1
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
							<img src="<?php $this->options->themeUrl("images/avatar.png"); ?>" class="avatar" style="margin-bottom: 1rem; height: 100px; width: 100px;">
							<h1 class="text-white"><?php $this->options->title() ?></h1>
							<hr/>
							<p class="lead text-white"><?php $this->options->description() ?></p>
						</div>
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
					<div class="content">
						<h1><a class="text-default" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
						<hr/>
						<span class="badge badge-pill badge-danger text-uppercase"><a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a></span> &nbsp;&nbsp;
						<span class="badge badge-pill badge-info text-uppercase"><time datetime="<?php $this->date('c'); ?>"><?php $this->date(); ?></time></span> &nbsp;&nbsp;
						<span class="badge badge-pill badge-success text-uppercase"><?php $this->category('d'); ?></span>
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