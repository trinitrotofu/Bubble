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
				</div>
			</div>
			<!-- SVG separator -->
			<div class="separator separator-bottom separator-skew zindex-100">
				<svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
				<polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
				</svg>
			</div>
		</section>
		<!-- Page content -->
		<section class="section">
			<div class="container">
				<div class="content">
					<?php $this->content(); ?>
					<hr/>
					<?php if($this->user->hasLogin()) : ?>
						<a href="<?php $this->options->adminUrl(); ?>write-page.php?cid=<?php echo $this->cid;?>"><button class="btn btn-sm btn-primary" type="button">修改页面</button></a>
					<?php endif; ?>
				</div>
			</div>
		</section>
		<!-- Comment -->
		<?php if($this->allow('comment')): 
			$this->need('comments.php');
			endif;
		?>
<?php $this->need('footer.php'); ?>