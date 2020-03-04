<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
	</main>

	<!-- Footer -->
	<footer class="footer">
		<div class="container">
			<div class="row align-items-center justify-content-md-between">
				<div class="col-md-6">
					<div class="copyright">
						Copyright © <?php $this->options->title() ?>
					</div>
				</div>
				<div class="col-md-6">
					<ul class="nav nav-footer justify-content-end">
						<li class="nav-item">
							<a class="nav-link" href="<?php $this->options->siteUrl(); ?>">首页</a>
						</li>
						<?php $this->widget('Widget_Contents_Page_List')->to($pages);
							while($pages->next()): ?>
							<li class="nav-item">
								<a class="nav-link" href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a>
							</li>
						<?php endwhile; ?>
						<?php if($this->user->hasLogin()): ?>
							<li class="nav-item"><a class="nav-link" href="<?php $this->options->adminUrl(); ?>">进入后台(<?php $this->user->screenName(); ?>)</a></li>
							<li class="nav-item"><a class="nav-link" href="<?php $this->options->logoutUrl(); ?>">退出</a></li>
						<?php else: ?>
							<li class="nav-item"><a class="nav-link" href="<?php $this->options->adminUrl('login.php'); ?>">登录</a></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<!-- Core -->
	<script src="<?php $this->options->themeUrl("assets/vendor/jquery/jquery.min.js"); ?>"></script>
	<script src="<?php $this->options->themeUrl("assets/vendor/popper/popper.min.js"); ?>"></script>
	<script src="<?php $this->options->themeUrl("assets/vendor/bootstrap/bootstrap.min.js"); ?>"></script>
	<!-- Optional plugins -->
	<script src="<?php $this->options->themeUrl("assets/vendor/headroom/headroom.min.js"); ?>"></script>
	<!-- Theme JS -->
	<script src="<?php $this->options->themeUrl("assets/js/argon.min.js"); ?>"></script>
	<!-- Typecho footer -->
	<?php $this->footer(); ?>
	<!-- Power Mode -->
	<?php if ($this->options->powerMode) { ?>
		<script src="<?php $this->options->themeUrl("assets/js/activate-power-mode.js"); ?>"></script>
		<script>
			POWERMODE.colorful = true; POWERMODE.shake = <?php if ($this->options->powerMode == 2) _e('true'); else _e('false') ?>;
			document.body.addEventListener('input', POWERMODE);
		</script>
	<?php } ?>
	</body>
</html>