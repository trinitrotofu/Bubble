<?php
	if (!defined('__TYPECHO_ROOT_DIR__')) exit;
	$this->need('header.php');
?>

	<main>
		<section class="section section-lg section-hero section-shaped">
		<?php printBackground(getRandomImage($this->options->randomImage), $this->options->bubbleShow); ?>
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
		</section>
		<div class="card shadow content-card list-card content-card-head">
			<!-- Article list -->
			<?php if ($this->have()): ?>
				<?php while($this->next()): ?>
					<?php printAricle($this); ?>
				<?php endwhile; ?>
				<!-- Toggle page -->
				<?php printToggleButton($this); ?>
			<?php else: ?>
			<section class="section">
				<div class="container">
					<div class="content">
						<h1>这里空空如也</h1>
						<hr/>
						<p>不如换个地方看看吧？</p>
					</div>
				</div>
			</div>
			<?php endif; ?> 
		</div>

<?php $this->need('footer.php'); ?>