var module = 'user'
const linkApi = "http://api.thegioiweb.org/v1.0/"
var urlModule = linkApi + "accountant" 

if($('.js_load_view').length){
	check_permission('accountant/backend/accountant/view')	
}
// chọn thợ thì chia tiền cho các thợ đó
$(document).on('click','.js_choose_worker',function(){	
	let _this = $(this)
	// lấy giá trị tổng thợ
	let total_money_worker = _this.parents('tr').prev().find('.js_worker_extend').attr('data-total_money_worker')
	// thếm màu sắc cho thợ được chọn
	if(!_this.hasClass('bg-green')){
		_this.addClass('bg-green')
	}else{
		_this.removeClass('bg-green')
	}

	//chia tổng tiền cho các thợ này
	// đếm số lượng thợ được chọn
	let count = _this.parents('tr').find('.bg-green').length
	$(this).parents('tr').find('input').val(0)		
	_this.parents('tr').find('.bg-green').each(function(){
		$(this).parent('td').find('input').val(addCommas(Math.round(div(total_money_worker, count))))		
	})


})
// hiện thị input dữ liệu sales_real gross_revenue_real profit_real
$(document).on('click','.edit_row',function(){	
	let _this = $(this)
	let id =_this.parents('tr').attr('data-id')
	_this.parents('tr').find('input[name=sales_real]').removeClass('hidden')
	_this.parents('tr').find('input[name=sales_real]').parent().find('span').addClass('hidden')

	_this.parents('tr').find('input[name=gross_revenue_real]').removeClass('hidden')
	_this.parents('tr').find('input[name=gross_revenue_real]').parent().find('span').addClass('hidden')

	_this.parents('tr').find('input[name=profit_real]').removeClass('hidden')
	_this.parents('tr').find('input[name=profit_real]').parent().find('span').addClass('hidden')
	// lấy dữ liệu tiền mặt
	var cash = []
	var worker = []
	$.ajax({
		type: 'GET', 
		url: api_url+'cash_detail/view?query=catalogueid=1,constructionid='+id,
		crossDomain:true,
		cache: false,
		success: function(resultApi){

			let json = JSON.parse(resultApi);
			if(json.result == true){
				cash = json.data.list
			}

		},
		error: function(resultApi){
			let json = JSON.parse(resultApi);
			toastr.error(json.message)
		}
	});
	$.ajax({
		type: 'GET', 
		url: linkapi + 'accountant/worker/'+id,
		crossDomain:true,
		cache: false,
		success: function(resultApi){
			let json = JSON.parse(resultApi);
			if(json.result == true){
				worker = json.data.list
			}
		},
		error: function(){
			toastr.error('Có lỗi sảy ra vui lòng thử lại')
		}
	});
	setTimeout(function() {
		let html = render_html_extend(cash, worker)
		_this.parents('tr').after('<tr class="extend" style="background: #fffdbb !important"><td colspan=1000>'+html+'</td></tr>')
	},300);
	_this.addClass('js_update_row')
	_this.removeClass('edit_row')
});
function render_html_extend(cash = '', worker = '') {
	let html = '';
	console.log(cash)
	if(check_val(cash)){
		html = html+'<table class="table table-bordered">'; 
			html = html+'<thead>'; 
				html = html+'<th class="text-center">Ngày tháng</th>'; 
				html = html+'<th class="text-right">Thu</th>'; 
				html = html+'<th class="text-right">Chi</th>'; 
				html = html+'</thead>'; 
			html = html+'<tbody>'; 
		if(cash.length){
			cash.forEach(function(item, index, array) {
				html = html+'<tr><td class="text-center">'+gettime(item.time, 'DD/MM/YYYY')+'</td>'; 
				html = html+'<td class="text-right"><b>'+addCommas(convert_false_to(item.input, 0))+'</b></td>'; 
				html = html+'<td class="text-right">'+addCommas(convert_false_to(item.output, 0))+'</td></tr>'; 
			})
		}else{
				html = html+'<td class="text-right" colspan=100>Không có dữ liệu</td>'; 
		}
			html = html+'</tbody>'; 
		html = html+'</table>'; 
	}
	if(check_val(worker)){
		html = html+'<table  class="table table-bordered">'; 
			let money = worker.money
			let userid = worker.userid
			let fullname = worker.fullname
			html = html+'</tbody><tr>';
			money.forEach(function(item, index, array) {
				let bg = (item > 0) ? 'bg-green' : ''
				html = html+'<td>'
					+'<span class="js_choose_worker pointer '+bg+'">'+fullname[index]+'</span>'
					+'<input type="text" name="money" data-id="'+userid[index]+'" class="text-right form-control input-sm int" placeholder="" value="'+addCommas(convert_false_to(item, 0))+'"></td>';
			});
			html = html+'</tr></tbody>';
		html = html+'</table>'; 
	}
	return html

}


// cập nhật lại tổng thợ
$(document).on('change click','input[name=sales_real] , input[name=gross_revenue_real]',function(){	
	let _this = $(this)
	let id =_this.parents('tr').attr('data-id')
	// lấy tổng thu
	let sales_real = _this.parents('tr').find('input[name=sales_real]').val()
	sales_real = is0(sales_real);
	sales_real = sales_real.replace(/\./gi, "");
	// lấy tổng doanh thu
	let gross_revenue_real = _this.parents('tr').find('input[name=gross_revenue_real]').val()
	gross_revenue_real = is0(gross_revenue_real);
	gross_revenue_real = gross_revenue_real.replace(/\./gi, "");
	// cập nhật công thợ mới
	let total_money_worker = sub(sales_real, gross_revenue_real)
	_this.parents('tr').find('.js_worker_extend').text(addCommas(total_money_worker))

	// lấy tổng công thợ cũ
	let total_money_worker_detail = _this.parents('tr').find('.js_worker_extend').attr('data-total_money_worker_detail')
	total_money_worker_detail = is0(total_money_worker_detail);
	total_money_worker_detail = total_money_worker_detail.replace(/\./gi, "");
	// nếu công tổng công thợ cũ không bằng công thợ mới thì thông báo
	if(total_money_worker_detail == total_money_worker){
		_this.parents('tr').find('.js_worker_extend').removeClass('bg-red')
	}else{
		_this.parents('tr').find('.js_worker_extend').addClass('bg-red')
	}
});
// cập nhật input dữ liệu sales_real gross_revenue_real profit_real
$(document).on('click','.js_update_row',function(){	
	let _this = $(this)
	let id =_this.parents('tr').attr('data-id')
	let obj = {}
	obj.sales_real = _this.parents('tr').find('input[name=sales_real]').val()
	obj.gross_revenue_real = _this.parents('tr').find('input[name=gross_revenue_real]').val()
	obj.profit_real = _this.parents('tr').find('input[name=profit_real]').val()

	obj.sales_real = is0(obj.sales_real);
	obj.sales_real = obj.sales_real.replace(/\./gi, "");
	obj.gross_revenue_real = is0(obj.gross_revenue_real);
	obj.gross_revenue_real = obj.gross_revenue_real.replace(/\./gi, "");
	obj.profit_real = is0(obj.profit_real);
	obj.profit_real = obj.profit_real.replace(/\./gi, "");

	// cập nhật doanh số tổng thu lợi nhuận
	$.ajax({
		type: 'PUT', 
		url: linkapi + 'accountant/update/'+id+'?'+authid,
		data : obj,
		crossDomain:true,
		cache: false,
		success: function(resultApi){
			let json = JSON.parse(resultApi);
			if(json.result == true){
				toastr.success('Cập nhật thành công')
				
			}
		},
		error: function(){
		}
	});
	obj.profit_real = _this.parents('tr').find('input[name=profit_real]').val()

	// cập nhật công thợ
	let constructionid = _this.parents('tr').attr('data-id')
	let obj1 = {}
	let index = 0
	_this.parents('tr').next().find('input[name=money]').each(function(){
		obj1[index] = {}
		obj1[index]['constructionid'] = constructionid
		obj1[index]['userid'] = $(this).attr('data-id')
		obj1[index]['money'] = $(this).val()
		index = sum(index, 1)
	})
	$.ajax({
		type: 'PUT', 
		url: linkapi + 'accountant/worker?'+authid,
		data: obj1,
		crossDomain:true,
		cache: false,
		success: function(resultApi){
			let json = JSON.parse(resultApi);
			if(json.result == true){
				toastr.success('Cập nhật thành công')
				$('.modal-footer .btn-white').trigger("click");
				$("#create_catalogueid .error").addClass('hidden');
			}
		},
		error: function(){
			toastr.error('Có lỗi sảy ra vui lòng thử lại')
		}
	});
	js_load_view()
});
// cập nhật dữ liệu vào modal
$(document).on('click','.js_worker_extend',function(){	
	let _this = $(this)
	let id = _this.parents('tr').attr('data-id')
	let total_money_worker = _this.text()
	$.ajax({
		type: 'GET', 
		url: linkapi + 'accountant/worker/'+id,
		crossDomain:true,
		cache: false,
		success: function(resultApi){
			let json = JSON.parse(resultApi);
			if(json.result == true){
				let list = json.data.list
				$('#modal .total_money_worker').html(total_money_worker)
				$('#modal .total_money_worker').attr('data-constructionid', id)
				$('#modal .js_content').html(render_html_worker(list))
			}
		},
		error: function(){
			toastr.error('Có lỗi sảy ra vui lòng thử lại')
		}
	});
});
$(document).on('click','.js_update_money_worker',function(){	
	event.preventDefault();
	let _this = $(this)
	let constructionid = _this.parents('.modal').find('.total_money_worker').attr('data-constructionid')
	let obj = {}
	let index = 0
	$('.js_content tbody').find('input[name=money]').each(function(){
		obj[index] = {}
		obj[index]['constructionid'] = constructionid
		obj[index]['userid'] = $(this).attr('data-id')
		obj[index]['money'] = $(this).val()
		index = sum(index, 1)
	})
	$.ajax({
		type: 'PUT', 
		url: linkapi + 'accountant/worker?'+authid,
		data: obj,
		crossDomain:true,
		cache: false,
		success: function(resultApi){
			let json = JSON.parse(resultApi);
			if(json.result == true){
				toastr.success('Cập nhật thành công')
				$('.modal-footer .btn-white').trigger("click");
				$("#create_catalogueid .error").addClass('hidden');
			}
		},
		error: function(){
			toastr.error('Có lỗi sảy ra vui lòng thử lại')
		}
	});
});

function render_html_worker(param){
	let html = ''
	html = html+'<thead><tr>';
	fullname.forEach(function(item, index, array) {
		html = html+'<td class="text-right">'+item+'</td>';
	});
	html = html+'</tr></thead>';
	let money = param.money
	let userid = param.userid
	html = html+'</tbody><tr>';
	console.log(money);
	money.forEach(function(item, index, array) {
		html = html+'<td><input type="text" name="money" data-id="'+userid[index]+'" class="text-right form-control input-sm int" placeholder="" value="'+convert_false_to(addCommas(item), 0)+'"></td>';
	});
	html = html+'</tr></tbody>';
	// console.log(html)
	return html
}



var fields = ''


function render_html(param){
	let html = ''
	// console.log(param);

	if(param.length){
		param.forEach(function(item, index, array) {
		  	html = html+'<tr style="cursor:pointer;" class="choose" data-id="'+item['id']+'">';

				html = html+'<td class="text-center">'+item['type_business']+'</td>'; 
				html = html+'<td class="text-center">'+item['user_charge']+'</td>'; 
				html = html+'<td class="text-center">'+item['fullname']+' '+item['phone']+'</td>'; 
				html = html+'<td class="text-center">'+item['detail']+'</td>'; 

				let bg_sales = '';
				console.log(item)
				if(item['sales_real'] != item['sales_cash']){
					bg_sales = 'bg-red'
				} 
				let link = 'cash/backend/cash/fillter?constructionid='+item['id']+'&catalogueid=1'
				html = html+'<td class="text-right '+bg_sales+'">';
					html = html+'<div href="'+link+'">';
						html = html+'<span>'+addCommas(convert_false_to(item['sales_real'], 0))+'</span>'
						html = html+'<input type="search" name="sales_real" class="hidden form-control input-sm text-right int" placeholder="" value="'+addCommas(convert_false_to(item['sales_real'], 0))+'">';
					html = html+'</div>';
				html = html+'</td>'; 

				let bg = '';
				if(item['gross_revenue_real'] != 0 && item['gross_revenue_real'] != item['gross_revenue']){
					bg = 'bg-red'
				}
				html = html+'<td class="text-right '+bg+'">';
					
					html = html+'<span>'+addCommas(convert_false_to(item['gross_revenue_real'],0))+'</span>'
					html = html+'<input type="search" name="gross_revenue_real" class="hidden form-control input-sm text-right int" placeholder="" value="'+addCommas(convert_false_to(item['gross_revenue_real'],0))+'">';
				html = html+'</td>'; 

				let bg_profit = '';
				if(item['profit_real'] != 0 && item['profit_real'] != item['profit']){
					bg_profit = 'bg-red'
				}
				html = html+'<td class="text-right '+bg_profit+'">';
					html = html+'<span>'+addCommas(convert_false_to(item['profit_real'], 0))+'</span>'
					html = html+'<input type="search" name="profit_real" class="hidden form-control input-sm text-right int" placeholder="" value="'+addCommas(convert_false_to(item['profit_real'], 0))+'">';
				html = html+'</td>'; 

				let bg_work = '';
				if(convert_false_to(item['total_money_worker_detail'], 0) != convert_false_to(item['total_money_worker'], 0)){
					bg_work = 'bg-red'
				}
				html = html+'<td class="text-right js_worker_extend '+bg_work+'" data-total_money_worker_detail = "'+item['total_money_worker_detail']+'" data-total_money_worker = "'+item['total_money_worker']+'">'+addCommas(convert_false_to(item['total_money_worker'],0))+'</td>'; 
				html = html+'<td class="text-center">'+convert_false_to(item['note'], '')+'</td>'; 
				html = html+'<td class="text-center">';
					html = html+'<button type="button" class="edit_row btn  btn-warning">Sửa</button>';
				html = html+'</td>';

			html = html+'</tr>';
		});

	}else{
		html = html+'<tr>';
			html = html+'<td colspan="100">';
				html = html+'<small class="text-danger">Không có dữ liệu phù hợp</small>';
			html = html+'</td>';
		html = html+'</tr>';
	}
	return html
}


$(document).ready(function(){
	// _________________________________________ search _________________________________________
	var time;
	// load trang khi nhập từ 2 kí tự trở lên
	$(document).on('keyup change','.js_keyword', function(){
		// get data
		let keyword = $(this).val();
		keyword = keyword.trim();

		clearTimeout(time);
		if(keyword.length > 2){
			// lấy dữ liệu ở form
			let obj = get_obj_in_form()
			// đẩy dữ liệu lên url
			pathname = convert_obj_to_pathname(obj)
			time = setTimeout(function(){
				get_list_object(pathname);
			},500);
		}else{
			// lấy dữ liệu ở form
			let obj = get_obj_in_form()
			// đẩy dữ liệu lên url
			obj.keyword = '';
			pathname = convert_obj_to_pathname(obj)
			time = setTimeout(function(){
				get_list_object(pathname);
			},500);
		}
	});

	// load trang bằng url
	if($('.js_load_view').length){
		js_load_view()
	}

	// load trang khi tìm kiếm (search)
	$(document).on('click','.js_search', function(){
		// lấy dữ liệu ở form
		let obj = get_obj_in_form()
		// đẩy dữ liệu lên url
		pathname = convert_obj_to_pathname(obj)
		// thực hiện search thông qua url
		get_list_object(pathname);
	});

	// load trang khi ấn sang trang khác
	$(document).on('click','.pagination li a', function(e){
		e.preventDefault(); 
		
		//lấy dữ liệu url
		let obj = get_obj_in_url();
		convert_false_to(obj, {})
		let page = $(this).attr('data-ci-pagination-page');
		obj.page = page;

		pathname = convert_obj_to_pathname(obj)
		get_list_object(pathname);
		return false
	});
});
function js_load_view() {
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
function get_list_object(pathname = ''){
	add_loading_view($('.js_content'));
	time = setTimeout(function(){


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
					let index = 0
					$('.js_content').find('tr').each(function(){
						if(index > 0){
							$(this).html('')
						}
						index = sum(index,1);
					})
					$('.js_content').append(html)
				}
				del_loading_view($('.js_content'))

			},
			error: function(resultApi){
				let json = JSON.parse(resultApi);
				toastr.error(json.message)
				del_loading_view($('.js_content'))
			}
		});
	},500);
}

