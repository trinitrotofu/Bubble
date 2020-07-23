<?php
	if (!defined('__TYPECHO_ROOT_DIR__')) exit;
	$this->need('header.php');
?>

	<main>
		<section class="section section-lg section-hero section-shaped">
			<!-- Background circles -->
			<?php printBackground(getRandomImage($this->options->randomImage), $this->options->bubbleShow); ?>
			<div class="container shape-container d-flex align-items-center py-lg">
				<div class="col px-0 text-center">
					<div class="row align-items-center justify-content-center">
						<h1 class="text-white"><?php $this->title() ?></h1>
					</div>
				</div>
			</div>
		</section>
		<section class="section section-components bg-secondary content-card-container">
			<div class="container container-lg py-5 align-items-center content-card-container">
				<div class="card shadow content-card content-card-head">
					<!-- Page content -->
					<section class="section">
						<div class="container">
							<div class="content">
								<?php $this->content(); ?>
							</div>
						</div>
					</section>
				</div>
				<!-- Comment -->
				<?php if (!$this->hidden && $this->allow('comment')): ?>
				<div class="card shadow content-card">
					<?php $this->need('comments.php'); ?>
				</div>
				<?php endif; ?>
			</div>
		</section>
<?php $this->need('footer.php'); ?>