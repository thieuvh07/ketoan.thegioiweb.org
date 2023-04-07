
$(document).ready(function(){
    check_login()
	// _________________________________________create_________________________________________
	$(document).on('submit','.js_check_login', function(){
		event.preventDefault();
		let _this =$(this)
		let obj = _this.serializeObject();

		if(!check_val(obj.account)){toastr.error('Vui lòng nhập tên đăng nhập',''); return false}
		if(!check_val(obj.password)){toastr.error('Vui lòng nhập mật khẩu',''); return false}

		$.ajax({
			type: 'POST', 
			url: 'http://api.thegioiweb.org/v1.0/auth/check_login',
			data: obj,
			crossDomain:true,
			cache: false,
			success: function(resultApi){
				let json = JSON.parse(resultApi);
				if(json.result == true){
					window.location.replace("http://ketoan.thegioiweb.org/dashboard/home");
					writeCookie('auth', JSON.stringify(json.data))
					toastr.success(json.message)
				}else{
					toastr.error(json.message)
				}
			},
			error: function(resultApi){
				let json = JSON.parse(resultApi);
				toastr.error(json.message)
			}
		});

	});


});
$.fn.serializeObject = function() {
    var obj = {};
    var arr = this.serializeArray();
    arr.forEach(function(item, index) {
        if (obj[item.name] === undefined) { // New
            obj[item.name] = item.value || '';
        } else {                            // Existing
            if (!obj[item.name].push) {
                obj[item.name] = [obj[item.name]];
            }
            obj[item.name].push(item.value || '');
        }
    });
    return obj;
};
function check_val($val = '' , $str = ''){
	if($val == '' || $val == null || typeof $val == 'undefined' || $val == false ){
		return false
	}
	return true;
}
function writeCookie(name,value,days = 1) {
    var date, expires;
    if (days) {
        date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        expires = "; expires=" + date.toGMTString();
            }else{
        expires = "";
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}
function readCookie(name) {
    var i, c, ca, nameEQ = name + "=";
    ca = document.cookie.split(';');
    for(i=0;i < ca.length;i++) {
        c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1,c.length);
        }
        if (c.indexOf(nameEQ) == 0) {
            return c.substring(nameEQ.length,c.length);
        }
    }
    return '';
}

function check_login(){
    let authCookie = readCookie('auth')
    if(typeof authCookie !== 'undefined' && authCookie != ''){
        authCookie = JSON.parse(authCookie);
        var auth = authCookie['auth']

        if(typeof auth !== 'undefined'){
            let href = window.location.href
            if(href == 'http://ketoan.thegioiweb.org/admin'){
                window.location.replace("http://ketoan.thegioiweb.org/dashboard/home");
            }
        }
    }
}