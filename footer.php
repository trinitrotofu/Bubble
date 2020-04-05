<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
		<?php if ($this->user->hasLogin()) { ?>
			<?php if ($this->is('single')) { ?>
			<a href="<?php $this->options->adminUrl(); ?>write-<?php echo $this->is('post')?'post':'page'; ?>.php?cid=<?php echo $this->cid;?>"><button class="btn btn-icon-only rounded-circle btn-primary admin-btn">
				<span class="btn-inner--icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
			</button></a>
			<?php } else { ?>
			<a href="<?php $this->options->adminUrl(); ?>"><button class="btn btn-icon-only rounded-circle btn-primary admin-btn">
				<span class="btn-inner--icon"><i class="fa fa-cogs" aria-hidden="true"></i></span>
			</button></a>
			<?php } ?>
		<?php } ?>
	</main>

	<!-- Footer -->
	<footer class="footer">
		<div class="container">
			<?php if ($this->options->footerWidget) { ?>
			<div class="row">
				<div class="col-md-4 widget">
					<h5>最新评论</h5>
					<?php $comments_recent = $this->widget('Widget_Comments_Recent', 'pageSize=5');
						if ($comments_recent->have())
						{
							_e('<ul>');
							while($comments_recent->next())
							{
								_e('<li><a href="' . "$comments_recent->permalink" . '" class="footer-link">' . "$comments_recent->author" . ': ');
								$comments_recent->excerpt(35, '...');
								_e('</a></li>');
							}
							_e('</ul>');
						}
						else
						{
							_e('暂无评论');
						}
					?>
				</div>
				<div class="col-md-4 widget">
					<h5>最新文章</h5>
					<ul><?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=6')->parse('<li><a href="{permalink}" class="footer-link">{title}</a></li>'); ?></ul>
				</div>
				<div class="col-md-4 widget">
					<h5>近期归档</h5>
					<ul><?php $this->widget('Widget_Contents_Post_Date', 'limit=6&type=month&format=F Y')->parse('<li><a href="{permalink}" class="footer-link">{date}</a></li>'); ?></ul>
				</div>
			</div>
			<hr/>
			<?php } ?>
			<div class="row">
				<div class="col-md-6">
					<div class="copyright">
						<?php _e($this->options->footerText); ?>
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
	</div>
	<!-- Core -->
	<script src="<?php $this->options->themeUrl("assets/vendor/popper/popper.min.js"); ?>"></script>
	<script src="<?php $this->options->themeUrl("assets/vendor/bootstrap/bootstrap.min.js"); ?>"></script>
	<!-- Optional plugins -->
	<?php if($this->options->Pjax=="1"): ?>
	<script>
		function init(){
			<?php $this->options->pjaxcomp() ?>
			<?php if($this->options->katex=="1"): ?>
			try{
				$('katex-inline').each(function(){t=$(this);katex.render(t.text(),t[0],{displayMode:false})})
				$('katex').each(function(){t=$(this);katex.render(t.text(),t[0],{displayMode:true})})
			}catch{}
			<? endif; ?>
			try{
				window.onload()
			}catch{}
		}
	</script>
	<script src="<?php $this->options->themeUrl("assets/js/jquery.pjax.js"); ?>"></script>
	<script src="<?php $this->options->themeUrl("assets/js/progress.js"); ?>"></script>
	<script>
		var pgid = 0
		$(document).pjax('a[href^="<?php Helper::options()->siteUrl()?>"]:not(a[target="_blank"], a[no-pjax], a[href^="<?php Helper::options()->siteUrl()?>/admin"])',
		{
    		container: '#pjax-container',
    		fragment: '#pjax-container',
    		timeout: 8000
		}).on('pjax:send', function() {
			pgid = start_progress()
			$(".black_cover").fadeIn(400)
			$('html,body').animate({ scrollTop: $('html').offset().top}, 500)
		}).on('pjax:complete', function() {
			$(".black_cover").fadeOut(400)
			stop_progress(pgid)
			init()
			
		})
		$("#search").submit(function() {
			var att = $(this).serializeArray()
			for(var i in att){
				if(att[i].name=="s"){
					$.pjax({url: <? if ($this->options->rewrite): ?>"<?php $this->options->siteUrl(); ?>search/"+att[i].value+"/"<? else: ?>"<?php $this->options->siteUrl(); ?>index.php/search/"+att[i].value+"/"<? endif; ?>, container: '#pjax-container',fragment: '#pjax-container',timeout:8000})
				}
			}
			return false
		})
	</script>
	<div class="black_cover" style="display: none;"></div>
	<?php endif; ?>
	<script src="<?php $this->options->themeUrl("assets/vendor/headroom/headroom.min.js"); ?>"></script>
	<!-- Theme JS -->
	<script src="<?php $this->options->themeUrl("assets/js/argon.min.js"); ?>"></script>
	<!-- KaTeX JS -->
	<?php if($this->options->katex=="1"): ?>
	<script src="https://cdn.jsdelivr.net/npm/katex@0.10.0-beta/dist/katex.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/katex@0.10.0-beta/dist/contrib/auto-render.min.js"></script>
	<script>
		renderMathInElement(document.body,{
			delimiters: [
				{left: "$$", right: "$$", display: true},
				{left: "$", right: "$", display: false}
			]
		});
	</script>
	<?php endif; ?>
	
	<!-- Alert -->
	<div class="modal fade show" id="modal-notification" style="z-index: 102;display: none;">
		<div class="modal-dialog modal-primary modal-dialog-centered modal-" role="document">
			<div class="modal-content bg-gradient-primary">
				<div class="modal-header">
					<h6 class="modal-title" id="modal-title-notification">
						Info from <?php $this->options->title() ?>
					</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">
							×
						</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="py-3 text-center">
						<i class="ni ni-bell-55 ni-3x">
						</i>
						<h4 id="msgMain" class="display-4 mt-4 text-white">
							提示窗口
						</h4>
					</div>
					<p id="msgDetail" class="py-3 text-center">
					</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" onclick="$('#modal-notification').hide('normal');">
						知道了
					</button>
				</div>
			</div>
		</div>
	</div>
	
	<script>
		function alert(main,detail){
			$("#msgMain").html(main)
			if(detail){
				$("#msgDetail").html(detail)
			}else{
				$("#msgDetail").html("")
			}
			$("#modal-notification").show("normal");
		}
	</script>
	
	<!-- Typecho footer -->
	<?php $this->footer(); ?>

	</body>
</html>