<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function themeConfig($form) {
	Typecho_Widget::widget('Widget_Themes_List')->to($themes);
	foreach ($themes -> stack as $key => $value){
		if($value["activated"]==1){
			break;
		}
	}
	
	if(!file_exists("themeupdater.php")){
		$updater = fopen("themeupdater.php", "w");
		$txt = '
		<html>
			<head>
				<title>Updater</title>
				<meta charset="UTF-8">
				<style>
					html {
						padding: 50px 10px;
						font-size: 16px;
						line-height: 1.4;
						color: #666;
						background: #F6F6F3;
						-webkit-text-size-adjust: 100%;
						-ms-text-size-adjust: 100%;
					}

					html,
					input { font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; }
					body {
						max-width: 500px;
						max-height: 30px;
						padding: 30px 20px;
						margin: 0 auto;
						background: #FFF;
					}
					ul {
						padding: 0 0 0 40px;
					}
					.container {
						max-width: 380px;
						_width: 380px;
						margin: 0 auto;
					}
				</style>
			</head>
			<body>
				<div class="container">
				<?php
				function getJsonRequest($url){
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					$output = curl_exec($ch);
					curl_close($ch);
					$output = json_decode($output,true);
					return $output;
				}
				function deldir($dir) {
					$dh=opendir($dir);
					while ($file=readdir($dh)) {
						if($file!="." && $file!="..") {
							$fullpath=$dir."/".$file;
							if(!is_dir($fullpath)) {
								unlink($fullpath);
							} else {
								deldir($fullpath);
							}
						}
					}
					closedir($dh);
					if(rmdir($dir)) {
						return true;
					} else {
						return false;
					}
				}
				function getRequest($url){
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					$output = curl_exec($ch);
					curl_close($ch);
					return $output;
				}
				$dir = "../usr/themes/Bubble";

				try{
					$version = getJsonRequest("https://data.jsdelivr.com/v1/package/resolve/gh/trinitrotofu/Bubble")["version"];
					$files = getJsonRequest("https://data.jsdelivr.com/v1/package/gh/trinitrotofu/Bubble@" . $version . "/flat")["files"];
					if(file_exists($dir)) deldir($dir);

					foreach ($files as $key => $value){
						$filecontent = getRequest("https://cdn.jsdelivr.net/gh/trinitrotofu/Bubble@" . $version . "/" .$value["name"]);
						if (!file_exists(dirname($dir.$value["name"]))){
							mkdir(dirname($dir.$value["name"]),0755,true);
						}
						$fileobj = fopen($dir.$value["name"], "w");
						fwrite($fileobj, $filecontent);
						fclose($fileobj);
					}
					
					echo "主题更新成功！即将返回主题页面。";
					echo \'<meta http-equiv="refresh" content="3;url=themes.php">\';
					@unlink ("themeupdater.php");  
				}catch(Exception $e){
					echo "更新失败！请查看错误信息或者手动更新。<br>";
					echo $e;
				}
				?>
				</div>
			</body>
		</html>';
		fwrite($updater, $txt);
		fclose($updater);
	}
	
	echo '<script>
		var version = "' . $value["version"] . '"
		function toNum(a){
			var a=a.toString();
			var c=a.split('.');
			var num_place=["","0","00","000","0000"],r=num_place.reverse();
			for (var i=0;i<c.length;i++){ 
				var len=c[i].length;	   
				c[i]=r[len]+c[i];  
			} 
			var res = c.join(""); 
			return res; 
		} 
		
	</script>';
	
	echo 
	'
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
	<ul class="typecho-option typecho-option-submit">
		<li>
			<label class="typecho-label">
				主题更新
			</label>
		</li>
		<li>
			<p class="description" id="update-dec">
				正在检查更新...
			</p>
		</li>
		<li hidden id="update-btn-li">
			<button type="button" class="btn default" id="update-btn">
			</button>
		</li>
	</ul>
	<script>
		$.ajax({
		url: "https://data.jsdelivr.com/v1/package/resolve/gh/trinitrotofu/Bubble",
		dataType: "json",
		timeout: 10000,
		success: function(data) {
			var releaseVersion = data["version"]
			$("#update-btn-li").show()
			$("#update-dec").html("")

			$("#update-btn").html("最新版本号为" + releaseVersion + "，当前版本为" + version + "，" + (toNum(releaseVersion) > toNum(version) ? "你正在使用旧版本主题。点击更新" : "你已更新至最新版本"));
			if (toNum(releaseVersion) > toNum(version)) {
				$("#update-btn").click(function() {
					window.location.href = "themeupdater.php"
				});
			}
		},
		error: function() {
			$("#update-dec").html("检查更新程序出错！")
		}
	});
	</script>';

	$subtitle = new Typecho_Widget_Helper_Form_Element_Text('subtitle', NULL, '', _t('站点副标题'), _t('在这里填入站点副标题，以在网站标题后显示'));
	$form->addInput($subtitle);
	$logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, '', _t('站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址，以在网站标题前加上一个 LOGO'));
	$form->addInput($logoUrl);
	$avatarUrl = new Typecho_Widget_Helper_Form_Element_Text('avatarUrl', NULL, '', _t('站点头像地址'), _t('在这里填入一个图片 URL 地址，以在网站首页上加上一个头像'));
	$form->addInput($avatarUrl);
	$indexImage = new Typecho_Widget_Helper_Form_Element_Text('indexImage', NULL, '', _t('首页背景图像地址'), _t('在这里填入一个图片 URL 地址, 以设定网站首页背景图片，留空则使用默认紫色渐变背景'));
	$form->addInput($indexImage);
	$randomImage = new Typecho_Widget_Helper_Form_Element_Textarea('randomImage', NULL, '', _t('随机背景图像地址'), _t('在这里填入一个或多个图片 URL 地址，每行一个，<strong>请勿包含多余字符</strong>，以设定网站文章页、独立页面以及其他页面的头图，设定后将随机显示，留空则使用默认紫色渐变背景'));
	$form->addInput($randomImage);
	$bubbleShow = new Typecho_Widget_Helper_Form_Element_Radio('bubbleShow', array('0' => _t('不显示'), '1' => _t('显示')), '1', _t('背景气泡'), _t('选择是否在首页以及文章页顶部背景处显示半透明气泡'));
	$form->addInput($bubbleShow);
	$footerText = new Typecho_Widget_Helper_Form_Element_Text('footerText', NULL, 'Powered by <a href="http://typecho.org/" class="footer-link">Typecho</a> | Theme by <a href="https://github.com/trinitrotofu/Bubble" class="footer-link">Bubble</a>', _t('页脚左下角文字'), _t('在这里填入页脚左下角的说明文字，如 Copyright 和 备案信息，可添加 HTML 标签'));
	$form->addInput($footerText);
	$footerWidget = new Typecho_Widget_Helper_Form_Element_Radio('footerWidget', array('0' => _t('不显示'), '1' => _t('显示')), '1', _t('页脚小工具'), _t('选择是否在页面底部显示“最新评论”、“最新文章”等栏目'));
	$form->addInput($footerWidget);
	$customCss = new Typecho_Widget_Helper_Form_Element_Textarea('customCss', NULL, '', _t('自定义 css'), _t('在这里填入所需要的 css，以实现自定义页面样式，如调整字体大小等'));
	$form->addInput($customCss);
	$viewerEnable = new Typecho_Widget_Helper_Form_Element_Radio('viewerEnable', array('0' => _t('关闭'), '1' => _t('打开'),), '1', _t('开启 viewer.js 图片查看器（点击放大）'), _t('选择是否启用 viewer.js 图片查看器'));
	$form->addInput($viewerEnable);
	$Pjax = new Typecho_Widget_Helper_Form_Element_Radio('Pjax', array('0' => _t('关闭'), '1' => _t('打开')), '1', _t('开启全站 pjax 模式'), _t('选择是否启用全站 pjax 模式提升用户访问体验。注意：启用该项可能带来页面加载问题，请仔细阅读主题说明文档。'));
	$form->addInput($Pjax);
	$pjaxcomp = new Typecho_Widget_Helper_Form_Element_Textarea('pjaxcomp', NULL, '', _t('pjax 回调代码'), _t('在这里填入 pjax 渲染完毕后需执行的 JS 代码，具体使用方法请仔细阅读主题说明文档'));
	$form->addInput($pjaxcomp);
	$katex = new Typecho_Widget_Helper_Form_Element_Radio('katex', array('0' => _t('关闭'), '1' => _t('打开')), '0', _t('开启 katex 数学公式渲染'), _t('选择是否启用 katex 数学公式渲染'));
	$form->addInput($katex);
	$prismjs = new Typecho_Widget_Helper_Form_Element_Radio('prismjs', array('0' => _t('关闭'), '1' => _t('打开')), '0', _t('开启 prism.js 代码高亮'), _t('选择是否启用 prism.js 代码高亮'));
	$form->addInput($prismjs);
	$prismLine = new Typecho_Widget_Helper_Form_Element_Radio('prismLine', array('0' => _t('关闭'), '1' => _t('打开')), '0', _t('开启 prism.js 行号显示'), _t('选择是否显示 prism.js 代码高亮左侧行号'));
	$form->addInput($prismLine);
	$prismTheme = new Typecho_Widget_Helper_Form_Element_Select('prismTheme',
		array('prism' => _t('default'),
			'prism-coy' => _t('coy'),
			'prism-dark' => _t('dark'),
			'prism-funky' => _t('funky'),
			'prism-okaidia' => _t('okaidia'),
			'prism-solarizedlight' => _t('solarizedlight'),
			'prism-tomorrow' => _t('tomorrow'),
			'prism-twilight' => _t('twilight')
		),
	'prism', _t('prism.js 高亮主题'), _t('选择 prism.js 代码高亮的主题配色'));
	$form->addInput($prismTheme);
	$toc = new Typecho_Widget_Helper_Form_Element_Radio('toc',
		array('0' => _t('关闭'),
			'1' => _t('打开'),
		),
		'1', _t('开启 TOC 文章目录功能'), _t('选择是否开启 TOC 文章目录功能'));
	$form->addInput($toc);
	$toc_enable = new Typecho_Widget_Helper_Form_Element_Radio('toc_enable',
		array('0' => _t('关闭'),
			'1' => _t('展开'),
		),
		'0', _t('默认 TOC 目录展开状态'), _t('选择打开文章时 TOC 目录的展开状态'));
	$form->addInput($toc_enable);

	$header_links_html = '
	<style>
		input[name=headerLinks]{
			display:none;
		}
	</style>
	<script>
	$(document).ready(function(){
		var editTemplate = \'<li class="size-5"><input type="checkbox"><span rel="$Link$">$Name$</span><a class="tag-edit-link linkEditer"><i class="i-edit"></i></a><a class="tag-edit-link linkDeleter"><i class="i-delete"></i></a></li>\'
		var finalTextform = $("input[name=headerLinks]")
		var linkList = finalTextform.val().split("$@!$")
		var isInEditing = -1
		var editTag = (is) => {
			isInEditing = is
			if(isInEditing == -1){
				$("#linkTagAddButton").text("添加")
				$("#linkTagCancleButton").hide()
			}else{
				$("#linkTagAddButton").text("编辑")
				$("#linkTagCancleButton").show()
			}
			
		}

		var updateList = () => {
			var renderedHtml = ""
			for (var eachLink in linkList){
				link = linkList[eachLink].split("$$")
				renderedHtml += editTemplate.replace("$Name$", link[0]).replace("$Link$", link[1])
			}
			$("#linkTags").html(renderedHtml)

			$(".linkEditer").click(function (){
				var span = $(this).prev()
				$("#linkTagAddLink").val(span.attr("rel"))
				$("#linkTagAddName").val(span.text())
				editTag(linkList.indexOf(span.text() + "$$" + span.attr("rel")))
			})
			$(".linkDeleter").click(function (){
				var span = $(this).prev().prev()
				linkList.splice(linkList.indexOf(span.text() + "$$" + span.attr("rel")), 1)
				updateList()
				updateForm()
			})
		}
		var updateForm = () => {
			finalTextform.val(linkList.join("$@!$"))
		}

		var clear = () => {
			$("#linkTagAddLink").val("")
			$("#linkTagAddName").val("")
		}
		updateList()
		
		$("#linkTagAddButton").click(() => {
			var link = $("#linkTagAddName").val() + "$$" + $("#linkTagAddLink").val()
			if(isInEditing == -1){
				if($("#linkTagAddName").val() != "" && $("#linkTagAddLink").val() != ""){
					linkList.push(link)
				}
			}else{
				linkList[isInEditing] = link
				editTag(-1)
			}
			updateList()
			updateForm()
			clear()
		})

		$("#linkTagCancleButton").click(() => {
			editTag(-1)
			clear()
		})
	})
	</script>
	</p>

		<ul class="typecho-list-notable tag-list clearfix" id="linkTags">
		</ul>
		<p class="description"></p>
		<div class="row">
			<div class="col-mb-12 col-tb-4">
				<label class="typecho-label">链接名称</label>
				<input id="linkTagAddName" type="text" class="text" value="">
			</div>
			<div class="col-mb-12 col-tb-4">
				<label class="typecho-label">链接网址</label>
				<input id="linkTagAddLink" type="text" class="text" value="">
			</div>
			<div class="col-mb-12 col-tb-3">
				<label class="typecho-label"> &nbsp;</label>
				<button type="button" class="btn primary" id="linkTagAddButton">添加</button>
				<button type="button" class="btn" id="linkTagCancleButton" style="display: none;">取消</button>
			</div>
		</div>
	
	<p class="description">编辑在顶部显示的链接';
	$headerLinks = new Typecho_Widget_Helper_Form_Element_Text('headerLinks', NULL, '', _t('顶部跳转链接'), $header_links_html);
	$form->addInput($headerLinks);
}

function printCategory($that, $icon = 0) { ?>
	<span class="list-tag">
		<?php if ($icon) { ?><i class="fa fa-folder-o" aria-hidden="true"></i><?php } ?>
		<?php foreach( $that->categories as $categories): ?>
		<a href="<?php print($categories['permalink']) ?>" class="badge badge-info badge-pill"><?php print($categories['name']) ?></a>
		<?php endforeach;?>
	</span>
<?php }

function printTag($that, $icon = 0) { ?>
	<span class="list-tag">
		<?php if ($icon) { ?><i class="fa fa-tags" aria-hidden="true"></i><?php } ?>
		<?php if (count($that->tags) > 0): ?>
			<?php foreach( $that->tags as $tags): ?>
			<a href="<?php print($tags['permalink']) ?>" class="badge badge-success badge-pill"><?php print($tags['name']) ?></a>
			<?php endforeach;?>
		<?php else: ?>
			<a class="badge badge-default badge-pill text-white">无标签</a>
		<?php endif;?>
	</span>
<?php }

function printAricle($that, $flag) { ?>
<?php if($that->fields->pic){ ?>
    
    <a class="card shadow content-card list-image-card <?php if ($flag): ?>content-card-head<?php endif; ?>" href="<?php $that->permalink() ?>">
        <div class="list-card-bg" data-src="<?php echo $that->fields->pic ?>"></div>
		<object class="list-image-card-section">
			<div class="container">
				<div class="content list-card-content">
					<h1><?php $that->title() ?></h1>
					<div class="list-object">
						<span class="list-tag"><i class="fa fa-calendar-o" aria-hidden="true"></i> <time datetime="<?php $that->date('c'); ?>"><?php $that->date();?></time></span>
						<span class="list-tag"><i class="fa fa-comments-o" aria-hidden="true"></i> <?php $that->commentsNum('%d');?> 条评论</span>
						<?php printCategory($that, 1); ?>
						<?php printTag($that, 1); ?>
						<span class="list-tag"><i class="fa fa-user-o" aria-hidden="true"></i> <a class="badge badge-warning badge-pill" href="<?php $that->author->permalink(); ?>"><?php $that->author();?></a></span>
					</div>
					<?php $that->excerpt(200,'...'); ?>
				</div>
			</div>
		</object>
	</a>
<?php }else{ ?>
	<a class="card shadow content-card list-card <?php if ($flag): ?>content-card-head<?php endif; ?>" href="<?php $that->permalink() ?>">
		<object class="section">
			<div class="container">
				<div class="content list-card-content">
					<h1><?php $that->title() ?></h1>
					<div class="list-object">
						<span class="list-tag"><i class="fa fa-calendar-o" aria-hidden="true"></i> <time datetime="<?php $that->date('c'); ?>"><?php $that->date();?></time></span>
						<span class="list-tag"><i class="fa fa-comments-o" aria-hidden="true"></i> <?php $that->commentsNum('%d');?> 条评论</span>
						<?php printCategory($that, 1); ?>
						<?php printTag($that, 1); ?>
						<span class="list-tag"><i class="fa fa-user-o" aria-hidden="true"></i> <a class="badge badge-warning badge-pill" href="<?php $that->author->permalink(); ?>"><?php $that->author();?></a></span>
					</div>
					<?php $that->excerpt(200,'...'); ?>
				</div>
			</div>
		</object>
	</a>
	<?php } ?>
<?php }

function printToggleButton($that) {
	if ($that->getTotal() > $that->parameter->pageSize) { ?>
		<section class="section" style="padding-bottom: 1rem; padding-top: 6rem">
			<div class="container">
				<nav class="page-nav"><?php $that->pageNav('<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>', 1, '...', array('wrapTag' => 'ul', 'wrapClass' => 'pagination justify-content-center', 'textTag' => 'a', 'currentClass' => 'active', 'prevClass' => '', 'nextClass' => '')); ?></nav>
			</div>
		</section>
	<?php }
}

function printBackground($url, $show) {
	_e('<div ');
	if ($url == '') _e('class="shape shape-style-1 shape-primary"');
	else _e('class="shape shape-style-1 shape-image" style="background-image: url(' . "$url" . ')"');
	_e('>');
	if ($show)
		_e('<span class="span-150"></span>
			<span class="span-50"></span>
			<span class="span-50"></span>
			<span class="span-75"></span>
			<span class="span-100"></span>
			<span class="span-75"></span>
			<span class="span-50"></span>
			<span class="span-100"></span>
			<span class="span-50"></span>
			<span class="span-100"></span>');
	_e('</div>');
}

function getRandomImage($str)
{
	if ($str == '') return '';
	$arr = explode(PHP_EOL, $str);
	return $arr[rand(0, sizeof($arr) - 1)];
}

function clear_urlcan($url)
{
	$rstr='';
	$tmparr=parse_url($url);
	$rstr=empty($tmparr['scheme'])?'http://':$tmparr['scheme'].'://';
	$rstr.=$tmparr['host'].$tmparr['path'];
	return $rstr;
}

function createCatalog($obj) {
	global $catalog;
	global $catalog_count;
	$catalog = array();
	$catalog_count = 0;
	$obj = preg_replace_callback('/<h([1-6])(.*?)>(.*?)<\/h\1>/i', function($obj) {
		global $catalog;
		global $catalog_count;
		$catalog_count ++;
		$catalog[] = array('text' => trim(strip_tags($obj[3])), 'depth' => $obj[1], 'count' => $catalog_count);
		return '<h'.$obj[1].$obj[2].'><a name="cl-'.$catalog_count.'"></a>'.$obj[3].'</h'.$obj[1].'>';
	}, $obj);
	return $obj;
}

function getCatalog() {
	global $catalog;
	$index = '';
	if ($catalog) {
		$index = '<ul>'."\n";
		$prev_depth = '';
		$to_depth = 0;
		foreach($catalog as $catalog_item) {
			$catalog_depth = $catalog_item['depth'];
			if ($prev_depth) {
				if ($catalog_depth == $prev_depth) {
					$index .= '</li>'."\n";
				} elseif ($catalog_depth > $prev_depth) {
					$to_depth++;
					$index .= '<ul>'."\n";
				} else {
					$to_depth2 = ($to_depth > ($prev_depth - $catalog_depth)) ? ($prev_depth - $catalog_depth) : $to_depth;
					if ($to_depth2) {
						for ($i=0; $i<$to_depth2; $i++) {
							$index .= '</li>'."\n".'</ul>'."\n";
							$to_depth--;
						}
					}
					$index .= '</li>';
				}
			}
			$index .= '<li><a name="dl-' . $catalog_item['count'] . '" href="javascript:jumpto('.$catalog_item['count'].')">'.$catalog_item['text'].'</a>';
			$prev_depth = $catalog_item['depth'];
		}
		for ($i=0; $i<=$to_depth; $i++) {
			$index .= '</li>'."\n".'</ul>'."\n";
		}
	}
	echo $index;
}

function GetCommentLineInDb($coid, $depth=3) { // 3 for getting this comment, the parent and the grandparent by default
	$db = Typecho_Db::get();
	$commentLine = [];
	while((count($commentLine) < $depth) and (isset($coid) and 0 != $coid)) {
		$row = $db->fetchRow($db->select()->from('table.comments')->where('coid = ? ', $coid));
		if(empty($row)) break;
		array_push($commentLine, $row);
		$coid = $row['parent'];
	}
	return $commentLine;
}

function themeInit($archive) {

}

function themeFields($layout) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('pic', NULL, NULL, _t('文章头图地址'), _t('在这里填入一个图片URL地址, 就可以让文章加上头图'));
    $layout->addItem($logoUrl);
}