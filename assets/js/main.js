var obj = document.getElementsByTagName('bbcode');

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