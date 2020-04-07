function parseBbcode() {
	let obj = document.getElementsByTagName('bbcode');
	for (let i = 0; i < obj.length; i++) {
		let tp = obj[i].getAttribute('type');
		let res = '<div class="alert alert-' + tp + '" role="alert"><span class="alert-inner--icon">';
		switch (tp) {
			case 'success':
				res += '<i class="fa fa-check-circle" aria-hidden="true"></i>';
				break;
			case 'danger':
				res += '<i class="fa fa-exclamation-circle" aria-hidden="true"></i>';
				break;
			case 'warning':
				res += '<i class="fa fa-exclamation-circle" aria-hidden="true"></i>';
				break;
			default:
				res += '<i class="fa fa-info-circle" aria-hidden="true"></i>';
				break;
		}
		res += '</span><span class="alert-inner--text">' + obj[i].innerHTML + '</span></div>';
		obj[i].innerHTML = res;
	}
}
parseBbcode();

function parseBblink() {
	let obj = document.getElementsByTagName('bblink');
	for (let i = 0; i < obj.length; i++) {
		let ico = obj[i].getAttribute('icon');
		let lnk = obj[i].getAttribute('link');
		let des = obj[i].getAttribute('des');
		let res = '<div class="card shadow card-lift--hover friend-card"><a href="';
		res += lnk + '" class="friend-link"><div class="friend-container"><img class="avatar" src="';
		res += ico + '"><div class="friend-text"><h5>'
		res += obj[i].innerHTML + '</h5>' + des + '</div></div></a></div>';
		obj[i].innerHTML = res;
	}
	obj = document.getElementsByTagName('bblist');
	for (let i = 0; i < obj.length; i++)
		obj[i].innerHTML = '<div class="row">' + obj[i].innerHTML + '</div>';
}
parseBblink();