<?php function threadedComments($comments, $options) {
		$commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-parent';
?>
 
<li id="li-<?php $comments->theId(); ?>">
	<div id="<?php $comments->theId(); ?>">
		<div  class="comment-item">
			<div class="<?php 
				if ($comments->_levels > 0) {
						echo 'comment-child';
				} else {
						echo 'comment-parent';
				}
			?>">
				<?php $comments->gravatar(80, ''); ?>
			</div>
			<div class="comment-body">
				<div class="comment-head">
					<h5><?php $comments->author(); ?> · <small><?php $comments->date('Y-m-d H:i'); ?></small><?php
					if ($comments->authorId) {
						if ($comments->authorId == $comments->ownerId) {
							_e(' <span class="badge badge-pill badge-primary"><i class="fa fa-user-o" aria-hidden="true"></i> 作者</span>');
						}
					}
					?></h5>
				</div>
				<?php $comments->content(); ?>
				<div style="float: right;">
					<?php $comments->reply('<i class="fa fa-reply" aria-hidden="true"></i> 回复'); ?>
				</div>
			</div>
		</div>
	</div>
	<?php if ($comments->children) { ?>
	<div class="comment-children">
		<?php $comments->threadedComments($options); ?>
	</div>
	<?php } ?>
</li>
 
<?php } ?>

<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<section class="section">
	<div class="container" id="comments">
		<div class="content">
			<div class="row align-items-center justify-content-center">
				<h3><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('%d 条评论')); ?></h3>
			</div>
			<?php $this->comments()->to($comments); ?>
			<?php if ($comments->have()): ?>
				<?php $comments->listComments(); ?>
				<div class="row align-items-center justify-content-center"><nav class="comment-nav"><?php $comments->pageNav('<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>', 2, '...', array('wrapTag' => 'ul', 'wrapClass' => 'pagination', 'currentClass' => 'active', 'prevClass' => '', 'nextClass' => '')); ?></nav></div>
			<?php endif; ?>
			<div class="comment-card">
				<?php if($this->allow('comment')): ?>
				<div id="<?php $this->respondId(); ?>" class="comment-reply">
					<div class="row align-items-center justify-content-center">
						<h3 id="response"><?php _e('发表评论'); ?></h3>
					</div>
					<div class="row align-items-center justify-content-center">
						<?php $comments->cancelReply(); ?>
					</div>
					<br/>
					<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
						<?php if($this->user->hasLogin()): ?>
						<p><?php _e('已登录为'); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>。<a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('注销？'); ?></a></p>
						<?php else: ?>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<div class="input-group mb-4">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fa fa-user-o" aria-hidden="true"></i></span>
										</div>
										<input type="text" name="author" id="author" class="form-control" placeholder="名称" value="<?php $this->remember('author'); ?>" required />
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<div class="input-group mb-4">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
										</div>
										<input type="email" name="mail" id="mail" class="form-control" placeholder="Email" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<div class="input-group mb-4">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fa fa-globe" aria-hidden="true"></i></span>
										</div>
										<input type="url" name="url" id="url" class="form-control" placeholder="网站" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
									</div>
								</div>
							</div>
						</div>
						<?php endif; ?>
						<p>
							<textarea rows="8" cols="50" name="text" id="textarea" class="form-control" required ><?php $this->remember('text'); ?></textarea>
						</p>
						<p>
							<button type="submit" class="btn btn-outline-success" style="float: right;"><?php _e('提交评论'); ?></button>
						</p>
					</form>
				</div>
				<?php else: ?>
				<div class="row align-items-center justify-content-center"><h3 id="response"><h3><?php _e('评论已关闭'); ?></h3></div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
