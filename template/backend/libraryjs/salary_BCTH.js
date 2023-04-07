if($('.js_load_view').length){
	check_permission('salary/backend/salary/BCTH')	
}
var urlModule = 'http://api.thegioiweb.org/v1.0/salary_BCTH'


function render_html(param){
	let html = ''
	console.log(param);
	Object.keys(param).forEach(function (type) {
		
	})
	return html;
}


$(document).ready(function(){
	
	// load trang bằng url
	if($('.js_load_view').length){
		let _this = $('.js_load_view')
		// lấy dữ liệu url
		let obj = get_obj_in_form();
		let page = get_page_in_url();
		let parse = parseURLParams(window.location.href);
		$.each(parse, function(index, value) {
		    obj[index] = value[0];
		});
		obj.page = page;
		// đẩy dữ liệu lên url
		pathname = convert_obj_to_pathname(obj)
		// console.log(pathname);
		get_list_object(pathname);
	}

	// load trang khi tìm kiếm (search)
	$(document).on('change','select[name=periodicid]', function(){
		// lấy dữ liệu ở form
		let obj = get_obj_in_form()
		// đẩy dữ liệu lên url
		pathname = convert_obj_to_pathname(obj)
		// thực hiện search thông qua url
		get_list_object(pathname);
	});

});

function get_list_object(pathname = ''){
	add_loading_view($('.js_content'));
	if(pathname.indexOf("&query") > 0){
		pathname = pathname.replace("&query=", "&query=trash=0,");
	}else{
		pathname = pathname+'&query=trash=0,'
	}
	let periodicid = $('select[name=periodicid]').val()
	$.ajax({
		type: 'GET', 
		url: urlModule+'/view?&periodicid='+periodicid+'&'+pathname,
		crossDomain:true,
		cache: false,
		success: function(resultApi){

			let json = JSON.parse(resultApi);
			if(json.result == true){
				let data = json.data.list
				console.log(data);
				$('.js_total_price_in_stock').html(addCommas(Math.round(convert_false_to(data.total_price_in_stock,0))))
				$('.js_profit_real').html(addCommas(Math.round(convert_false_to(data.profit_real, 0))))
				$('.js_total_money_worker_profit').html(addCommas(Math.round(convert_false_to(data.total_money_worker_profit, 0))))
				$('.js_total_salary').html(addCommas(Math.round(convert_false_to(data.total_salary, 0))))
				$('.js_total_HT').html(addCommas(Math.round(convert_false_to(data.total_HT, 0))))
				$('.js_total_PS').html(addCommas(Math.round(convert_false_to(data.total_PS, 0))))
				let temp = 
					sub(
						sum(Math.round(convert_false_to(data.profit_real, 0)), Math.round(convert_false_to(data.total_money_worker_profit, 0))), 
						sum(Math.round(convert_false_to(data.total_salary, 0)), 
							sum(Math.round(convert_false_to(data.total_HT, 0)), Math.round(convert_false_to(data.total_PS, 0))))
						)
				$('.js_total_profit').html(addCommas(convert_false_to(temp, 0)))

			}
			del_loading_view($('.js_content'))

		},
		error: function(resultApi){
			let json = JSON.parse(resultApi);
			toastr.error(json.message)
			del_loading_view($('.js_content'))
		}
	});
}

