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
		<section class="section section-components bg-secondary content-card-container">
			<div class="container container-lg py-5 align-items-center content-card-container">
				<!-- Article list -->
				<?php if ($this->have()): ?>
					<?php $first_flag = true; ?>
					<?php while($this->next()): ?>
						<?php printAricle($this, $first_flag); $first_flag = false; ?>
					<?php endwhile; ?>
					<!-- Toggle page -->
					<?php printToggleButton($this); ?>
				<?php else: ?>
					<div class="card shadow content-card list-card content-card-head">
						<section class="section">
							<div class="container">
								<div class="content">
								<h1>这里空空如也</h1>
								<hr/>
								<p>不如换个地方看看吧？</p>
								</div>
							</div>
						</section>
					</div>
				<?php endif; ?>
			</div>
		</section>

<?php $this->need('footer.php'); ?>