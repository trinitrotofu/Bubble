<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title><?php $this->archiveTitle(array(
		'category'  =>  _t('%s下的文章'),
		'search'    =>  _t('包含关键字 %s 的文章'),
		'tag'       =>  _t('标签 %s 下的文章'),
		'author'    =>  _t('%s 的文章')
	), '', ' - '); ?><?php $this->options->title(); ?></title>

	<!-- Favicon -->
	<link href="<?php
		if ($this->options->logoUrl == '') {
			$this->options->themeUrl("images/logo.png");
		} else {
			$this->options->logoUrl();
		}
	?>" rel="icon" type="image/png">

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

	<!-- FontAwesome -->
	<link href="<?php $this->options->themeUrl("assets/vendor/font-awesome/css/font-awesome.min.css"); ?>" rel="stylesheet">

	<!-- Main CSS -->
	<link type="text/css" href="<?php $this->options->themeUrl("assets/css/main.min.css"); ?>" rel="stylesheet">

	<!-- Custom CSS -->
	<link type="text/css" href="<?php $this->options->themeUrl("style.css"); ?>" rel="stylesheet">
	
	<!-- KaTeX CSS -->
	<?php if($this->options->katex=="1"): ?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.10.0-beta/dist/katex.min.css">
	<?php endif; ?>
	
	<!-- Jquery JS -->
	<script src="<?php $this->options->themeUrl("assets/vendor/jquery/jquery.min.js"); ?>"></script>
	
	<!-- Typecho header -->
	<?php $this->header(); ?>
</head>
<body>
	
	<header class="header-global">
		<nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light headroom">
			<div class="container">
				<a class="navbar-brand" href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title() ?></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbar-default">
					<div class="navbar-collapse-header">
						<div class="row">
							<div class="col-6 collapse-brand">
								<a href="<?php $this->options->siteUrl(); ?>"><h5><?php $this->options->title() ?></h5></a>
							</div>
							<div class="col-6 collapse-close">
								<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
									<span></span>
									<span></span>
								</button>
							</div>
						</div>
					</div>
					<ul class="navbar-nav ml-lg-auto align-items-lg-center">
						<li class="nav-item">
							<a class="nav-link" href="<?php $this->options->siteUrl(); ?>">首页</a>
						</li>
						<li class="nav-item">
						<?php
							$this->widget('Widget_Contents_Page_List')->to($pages);
							while($pages->next()):
						?>
							<li class="nav-item">
								<a class="nav-link" href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
							</li>
						<?php endwhile; ?>
						<li class="nav-item" style="margin-left:1rem;">
							<form method="post" action="" id="search">
								<div class="row">
									<div class="input-group">
										<input type="text" name="s" class="form-control" placeholder="Search" type="text">
										<div class="input-group-append">
											<button type="submit" class="btn btn-icon btn-2 btn-primary" style="box-shadow: none;" type="button">
												<span class="btn-inner--icon"><i class="fa fa-search" aria-hidden="true"></i></span>
											</button>
										</div>
									</div>
								</div>
							</form>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	
	<div id="pjax-container">