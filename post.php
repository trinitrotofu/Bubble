<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<main>

	<?php if ($this->options->toc) : ?>
		<div class="card shadow border-0 bg-secondary toc-container">
			<a class="carousel-control-prev" id="toc-nomiao">
				<i class="fa fa-chevron-left" aria-hidden="true"></i>
			</a>
			<div class="card-img container container-lg py-5 toc">
				<strong>文章目录</strong>
				<div class="toc-list">
					<?php getCatalog(); ?>
				</div>
			</div>
		</div>
		<script>
			var onshow = false;

			function tocshow() {
				if (onshow) {
					$(".toc-container").css("right", '-175px')
					$(".toc-container i").removeClass("fa-chevron-right").addClass("fa-chevron-left")
				} else {
					$(".toc-container").css("right", '-5px')
					$(".toc-container i").removeClass("fa-chevron-left").addClass("fa-chevron-right")
				}
				onshow = !onshow
			}

			function jumpto(num) {
				$('html,body').animate({
					scrollTop: $('[name="cl-' + num + '"]').offset().top - 120
				}, 500)
			}
			$("#toc-nomiao").click(tocshow)
			var nowtoc = "cl-1"
			$(document).ready(function() {
				<?php if ($this->options->toc_enable) : ?>
					tocshow()
				<?php endif; ?>
				$(document).scroll(function() {
					for (var ele of $("*[name*='cl-']").get().reverse()) {
						if ($(document).scrollTop() + 121 > $(ele).offset().top) {
							if (nowtoc != ele.name) {
								var tocele = $("*[name*='dl-" + nowtoc.replace("cl-", "") + "']")
								tocele.removeClass("located")


								tocele = $("*[name*='dl-" + ele.name.replace("cl-", "") + "']")
								tocele.addClass("located")
								$(".toc-list").animate({
									scrollTop: $(".toc-list").scrollTop() - 50 + tocele.position().top
								}, 80)
								nowtoc = ele.name
							}
							break
						}
					}
					//
				})
			});
		</script>
	<?php endif; ?>
	<section class="section section-lg section-hero section-shaped">
		<?php printBackground(($this->fields->pic ? $this->fields->pic : getRandomImage($this->options->randomImage)), $this->options->bubbleShow); ?>
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
	<section class="section section-components bg-secondary content-card-container">
		<div class="container container-lg py-5 align-items-center content-card-container">
			<div class="card shadow content-card content-card-head">
				<!-- Article content -->
				<section class="section">
					<div class="container">
						<div class="content">
							<? if($this->hidden){ ?>
							<div class="container text-center">
								<form class="protected" id="protected" action="<?php $this->permalink() ?>" method="post">
									<textarea name="text" style="display:none;"></textarea>
									<p class="lead">写一下密码啦</p>
									<div class="row justify-content-md-center">
										<div class="col col-10">
											<input class="form-control" type="password" name="protectPassword" id="protectPassword" placeholder="请输入密码">
										</div>
										<div class="col-md-auto">
											<button type="submit" class="btn btn-info" id="protectButton">确认</button>
										</div>
									</div>
								</form>
								<script>
									$("#protectPassword").on('focus', function() {
										$(this).removeClass("is-invalid")
									})
									$("#protected").submit(function() {
										var secr = <?php echo Typecho_Common::shuffleScriptVar($this->security->getToken(clear_urlcan($this->request->getRequestUrl()))); ?>
										$("#protectButton").attr("disabled", true);
										$.ajax({
											url: $(this).attr("action") + "?_=" + secr,
											type: $(this).attr("method"),
											data: $(this).serializeArray(),
											complete: function() {
												$("#protectButton").attr("disabled", false);
											},
											error: function() {

											},
											success: function(data) {
												if (data) {
													var parser = new DOMParser()
													var htmlDoc = parser.parseFromString(data, "text/html")
													if (htmlDoc.title == "Error") {
														$("#protectPassword").addClass("is-invalid")

													} else {
														$("#protectPassword").addClass("is-valid")
														$("#protected").fadeOut();
														setTimeout(function() {
															$("title").html(htmlDoc.title)
															$("#pjax-container").html(htmlDoc.getElementById("pjax-container").innerHTML)
														}, 1000)

													}
												}
											}
										})
										return false
									})
								</script>
							</div>
							<? }else{ ?>
							<?php
							$content = preg_replace('/<img(.*?)src=[\'"]([^\'"]+)[\'"](.*?)>/i', "<noscript>\$0</noscript><img\$1data-src=\"\$2\" \$3>", $this->content);
							echo $content
							?>
							<hr>
							<ul>
								<li>分类：<?php printCategory($this); ?></li>
								<li>标签：<?php printTag($this); ?></li>
							</ul>
							<? } ?>
						</div>
					</div>
				</section>
			</div>
			<div class="card shadow content-card">
				<!-- Comment -->
				<?php if (!$this->hidden && $this->allow('comment')) $this->need('comments.php'); ?>
			</div>
		</div>
	</section>
	<?php $this->need('footer.php'); ?>