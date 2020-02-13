<?php function threadedComments($comments, $options) {
		$commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-parent';	//评论层数大于0为子级，否则是父级
?>
 
<li id="li-<?php $comments->theId(); ?>" class="
	<?php 
		if ($comments->_levels > 0) {
				echo ' comment-child';
		} else {
				echo ' comment-parent';
		}
	?>">
	<div id="<?php $comments->theId(); ?>">
		<div class="d-flex">
			<div>
				<?php $comments->gravatar(100, ''); ?>
			</div>
			<div class="pl-4">
				<div class="row comment-head">
					<h6><?php $comments->author(); ?> · <small><?php $comments->date('Y-m-d H:i'); ?></small></h6>
				</div>
				<?php $comments->content(); ?>
			</div>
		</div>
		<div style="float: right;">
			<?php $comments->reply(); ?>
		</div>
		<?php if ($comments->children) { ?>
		<div class="comment-children">
				<?php $comments->threadedComments($options); ?>
		</div>
		<?php } ?>
	</div>
</li>
 
<?php } ?>

<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<section class="comment-section">
	<div class="container" id="comments">
			<?php $this->comments()->to($comments); ?>
			<?php if ($comments->have()): ?>
		<h3><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></h3>
			
			<?php $comments->listComments(); ?>

			<nav class="comment-nav"><?php $comments->pageNav('&laquo;', '&raquo;', 2, '...', array('wrapTag' => 'ul', 'wrapClass' => 'pagination', 'currentClass' => 'active', 'prevClass' => '', 'nextClass' => '')); ?></nav>
			
			<?php endif; ?>

			<?php if($this->allow('comment')): ?>
			<div id="<?php $this->respondId(); ?>" class="container">
				<?php $comments->cancelReply(); ?>
				<h3 id="response"><?php _e('添加新评论'); ?></h3>
				<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
							<?php if($this->user->hasLogin()): ?>
					<p><?php _e('登录身份: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></p>
							<?php else: ?>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" name="author" id="author" class="form-control" placeholder="名称" value="<?php $this->remember('author'); ?>" required />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="email" name="mail" id="mail" class="form-control" placeholder="Email" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="url" name="url" id="url" class="form-control" placeholder="网站" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
							</div>
						</div>
					</div>
							<?php endif; ?>
					<p>
									<textarea rows="8" cols="50" name="text" id="textarea" class="form-control" required ><?php $this->remember('text'); ?></textarea>
							</p>
					<p>
									<button type="submit" class="btn btn-success"><?php _e('提交评论'); ?></button>
							</p>
				</form>
			</div>
			<?php else: ?>
			<h3><?php _e('评论已关闭'); ?></h3>
			<?php endif; ?>
	</div>
</section>
