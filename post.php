<?php
	if (!defined('__TYPECHO_ROOT_DIR__')) exit;
	$this->need('header.php');
?>

	<main>

	<div class="card shadow border-0 bg-secondary toc-container">
    	<a class="carousel-control-prev" id="toc-nomiao">
              <span class="ni ni-bold-left" id="toc-miao"></span>
            </a>
        	<div class="card-img tu container container-lg py-5 toc">
        		<strong>文章目录</strong>
        		<div class="toc-list">
        		<? getCatalog(); ?>
        		</div>
        </div>
    </div>
    <script>
    	var onshow = false;
    	function tocshow(){
    		if(onshow){
    			$(".toc-container").css("right",'-175px')
    			$("#toc-miao").removeClass("ni-bold-right").addClass("ni-bold-left")
    		}else{
    			$(".toc-container").css("right",'-5px')
    			$("#toc-miao").removeClass("ni-bold-left").addClass("ni-bold-right")
    		}
    		onshow = !onshow
    	}
    	function jumpto(num){
    		$('html,body').animate({ scrollTop: $('[name="cl-'+num+'"]').offset().top-100 }, 500)
    	}
    	$("#toc-nomiao").click(tocshow)
    	<?php if($this->options->toc=="able"): ?>
    	$(document).ready(function() {     
			tocshow()
		}); 
    	<?php endif; ?>
    </script>
		<section class="section section-lg section-hero section-shaped">
			<?php printBackground(getRandomImage($this->options->randomImage), $this->options->bubbleShow); ?>
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
						<?php if (!$this->hidden) { ?>
						<hr/>
						<ul>
							<li>分类：<?php printCategory($this); ?></li>
							<li>标签：<?php printTag($this); ?></li>
						</ul>
						<?php } ?>
					</div>
				</div>
			</section>
			<!-- Comment -->
			<?php if (!$this->hidden && $this->allow('comment')) $this->need('comments.php'); ?>
		</div>
<?php $this->need('footer.php'); ?>