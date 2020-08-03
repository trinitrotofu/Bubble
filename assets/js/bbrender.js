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
            case 'secondary':
                res += '<i class="fa fa-at" aria-hidden="true"></i>';
                break;
            default:
                res += '<i class="fa fa-info-circle" aria-hidden="true"></i>';
                break;
        }
        res += '</span><span class="alert-inner--text">' + obj[i].innerHTML + '</span></div>';
        obj[i].innerHTML = res;
    }
}

function parseBblink() {
    let obj = document.getElementsByTagName('bblink');
    for (let i = 0; i < obj.length; i++) {
        obj[i].setAttribute('class', 'card shadow card-lift--hover friend-card');
        let ico = obj[i].getAttribute('icon');
        let lnk = obj[i].getAttribute('link');
        let des = obj[i].getAttribute('des');
        let res = '<a href="';
        res += lnk + '" class="friend-link" target="_blank"><div class="friend-container"><div class="friend-avatar rounded-circle" style="background:url(';
        res += ico + ') center center / cover no-repeat;"></div><div class="friend-text"><h5>'
        res += obj[i].innerHTML + '</h5>' + des + '</div></div></a>';
        obj[i].innerHTML = res;
    }
    obj = document.getElementsByTagName('bblist');
    for (let i = 0; i < obj.length; i++)
        obj[i].innerHTML = '<div class="row">' + obj[i].innerHTML + '</div>';
}