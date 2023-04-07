if($('.js_load_view').length){
	check_permission('salary/backend/timekeeping/view')	
}
var urlModule = 'http://api.thegioiweb.org/v1.0/salary_timekeeping'
var fields = ''

$(document).on('click','.js_update',function(){
	let _this = $(this);
	let obj = {}

	let index = 0 
	$('.js_content').find('.js_changed').each(function(){
		obj[index] = {}
		obj[index]['date'] = $(this).attr('data-date')
		obj[index]['userid'] = $(this).attr('data-userid')
		obj[index]['status'] = $(this).text()
		index = sum(index, 1)
	})
	let periodicid = $('select[name=periodicid]').val()
	$.ajax({
		type: 'PUT', 
		url: urlModule+'/'+periodicid+'?'+authid,
		data: obj,
		crossDomain:true,
		cache: false,
		success: function(resultApi){
			let json = JSON.parse(resultApi);
			if(json.result == true){
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
$(document).on('click','.js_change_all',function(){
	$('table .js_change').each(function(){
		$(this).html(1)
		$(this).addClass('js_changed')
		$(this).removeClass('bg-info')
		$(this).addClass('bg-success')
	
		// cập nhật lại tổng số ngày công
		let total = 0
		$(this).parents('tr').find('.js_change').each(function(){
			total = sum(total, $(this).text())
		})
		$(this).parents('tr').find('.js_total b').text(total)
	})
	
});

$(document).on('click','.js_change',function(){
	let _this = $(this);
	status = _this.text();
	_this.addClass('js_changed')
	if(status == 0){
		_this.html(0.5)
		_this.addClass('bg-info')
	}
	if(status == 0.5){
		_this.html(1)
		_this.removeClass('bg-info')
		_this.addClass('bg-success')
	}
	if(status == 1){
		_this.html(0)
		_this.removeClass('bg-success')
	}
	// cập nhật lại tổng số ngày công
	let total = 0
	_this.parents('tr').find('.js_change').each(function(){
		total = sum(total, $(this).text())
	})
	_this.parents('tr').find('.js_total b').text(total)
	
});


function render_html(param){
	let html = ''
	console.log(param);

	let timeList = param.time
	if(timeList.length){
		html = html+'<thead><tr>';
		html = html+'<th class="text-center">Tài khoản</th>';
		timeList.forEach(function(item, index, array) {
			html = html+'<th class="text-center">'+item.dayMonth+'</th>';
		});
		html = html+'<th class="text-center">Tổng</th>';
		html = html+'</tr></thead>';
	}

	let userList = param.user
	if(userList.length){
		html = html+'<tbody class="pointer">';
		userList.forEach(function(item, index, array) {
			html = html+'<tr>';
				html = html+'<td class="text-center">'+item.fullname+'</td>';
				let timeList = param.time
				let total = 0
				if(timeList.length){
					// lặp qua các ngày
					var html_extend = ''
					timeList.forEach(function(item2, index2, array2) {
						let timekeepingList = item.timekeeping
						html_extend = '<td  data-userid="'+item.id+'" data-date="'+item2.date+'" class="text-center js_change">0</td>';
						if(check_val(timekeepingList) && timekeepingList != "undefined" && timekeepingList.length >= 1){
							// kiểm tra xem nếu có ngày nào 
							timekeepingList.forEach(function(item1, index1, array1) {
								if(item2.date == item1.time){
									let bg = '';
									if(item1.status == 1){ bg = "bg-success"}
									if(item1.status == 0.5){ bg = "bg-info"}
									total = sum(total,item1.status)
									html_extend = '<td  data-userid="'+item.id+'" data-date="'+item2.date+'" class="text-center  js_change '+bg+'">'+item1.status+'</td>';
								}
							});
						}
						html = html+html_extend
					});
				}
				html = html+'<td class="text-center js_total"><b>'+total+'</b></td>';
			html = html+'</tr>';
		});
		html = html+'</tbody>';
	}
	return html
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
		url: urlModule+'/search?fields='+fields+'&periodicid='+periodicid+'&'+pathname,
		crossDomain:true,
		cache: false,
		success: function(resultApi){

			let json = JSON.parse(resultApi);
			if(json.result == true){
				let html = render_html(json.data.list)
				$('.js_to').html(json.data.to)
				$('.js_from').html(json.data.from)
				$('.js_total_rows').html(json.data.total_rows)
				$('.js_pagination').html(json.data.pagination)
				$('.js_content').html(html)
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

