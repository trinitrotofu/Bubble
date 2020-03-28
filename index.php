<?php
/**
 * Typecho 极简风格响应式主题
 * 
 * @package Bubble
 * @author TriNitroTofu and Boshi
 * @version 2.2.2
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
				<?php printAricle($this); ?>
			<?php endwhile; ?>
			<!-- Toggle page -->
			<?php printToggleButton($this); ?>
		</div>

<?php $this->need('footer.php'); ?>