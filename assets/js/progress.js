changeprogress = function(progress){
	progress -= 4
	$("#argprogress .progress-bar").css("width",`${progress}%`)
}
function start_progress(){
	var tick = 1
	$("#argprogress").fadeIn(150)
	var loadingtime = window.performance.timing["loadEventEnd"] - window.performance.timing["navigationStart"]
	var nowtime = 0
	var clock = setInterval(function(){
		nowtime += tick
		if(nowtime > loadingtime){
		}else{
			nowprogress = Math.round(nowtime / loadingtime * 100)
			changeprogress(nowprogress)
		}
	}, tick);
	return clock
}

function stop_progress(clock){
	$("#argprogress div").css("transition","all 600ms ease-in-out 0s")
	clearInterval(clock)
	changeprogress(104)
	setTimeout(function() {
		$("#argprogress").fadeOut(150)
		setTimeout(function() {
			changeprogress(-4)
			$("#argprogress div").css("transition","all 200ms linear 0s")
		}, 150);
	}, 500);
}

addclass = "bg-gradient-primary"

$("body").append("<style>#argprogress{position: fixed;top: 0;width: 100%;left: 0;border: none;z-index: 105;overflow: hidden;height: 5px;display: flex;background-color: #e9ecef;}</style>")
$("body").append(`<div id="argprogress" style="display:none;"><div class="progress-bar ${addclass}" style="width:0%;border: none;"></div></div>`)
$("#argprogress div").css("transition","all 200ms linear 0s")