if($('.js_load_view').length){
	check_permission('supplier/backend/supplier/view')	
}
if($('.js_load_create').length){
	check_permission('supplier/backend/supplier/create')	
}
if($('.js_load_update').length){
	check_permission('supplier/backend/supplier/update')	
}

$(document).on('click','.js_content tr',function(){
	console.log(1);
	let _this = $(this);
	_this.parents('.js_content').find('tr').each(function(){
		$(this).removeClass('bg-choose');
	})
	_this.addClass('bg-choose');

	let id = _this.find('input[name="checkbox[]"]').val();
	let title =_this.find('td:eq(1)').text();
	$('.title').html('').html('<a href="'+BASE_URL+'supplier/backend/supplier/detail?id='+id+'" onclick="js_open_windown(this); return false" >'+title+'</a>');

	let urlModule = 'http://api.thegioiweb.org/v1.0/supplier'
		$.ajax({
			type: 'get', 
			url: urlModule+'/info/'+id+'?'+authid,
			data: '',
			crossDomain:true,
			cache: false,
			success: function(resultApi){
				let json = JSON.parse(resultApi);
				if(json.result == true){
					$('.supplier-detail').find('ul').html(render_history(json.data));
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
// thêm html sản phẩm vào bảng
function render_history(data){
    let html='';
	// console.log(data)
	if(data.length){
		data.forEach(function(item, index, array) {
			if(typeof item['code'] == "undefined"){
	            html= html+ '<li class="success uk-flex-right">';
	                html= html+ '<div class="text-right">';
						html= html+ 'Đã thanh toán <a href="http://ketoan.thegioiweb.org/cash/backend/cash/view.html">'+item['title']+'</a> : '+addCommas(is0(item.total_money)) + 'đ';
	                html= html+ '</div>';
	                html= html+ '<div class="text-right">';
		                html= html+ '<i class="fa fa-clock-o"></i> '+item['created'];
	                html= html+ '</div>';
	            html= html+ '</li>';
			}else{
				if(item.type == 'repay'){
		            html= html+ '<li class="success">';
		                html= html+ '<div>';
							html= html+ 'Đã trả đơn hàng <a href="http://ketoan.thegioiweb.org/repay/backend/repay/update/'+item['id']+'.html">'+item['code']+'</a> có tổng tiền: '+addCommas(is0(item.total_money_repay)) + 'đ';
		                html= html+ '</div>';
		                html= html+ '<i class="fa fa-clock-o"></i> '+item['created'];
		            html= html+ '</li>';
		        }else{
		            html= html+ '<li class="warning">';
		                html= html+ '<div>';
							html= html+ 'Đã nhập đơn hàng <a href="http://ketoan.thegioiweb.org/import/backend/import/update/'+item['id']+'.html">'+item['code']+'</a> có tổng tiền: '+addCommas(is0(item.total_money_import)) + 'đ';
		                html= html+ '</div>';
		                html= html+ '<i class="fa fa-clock-o"></i> '+item['created'];
		            html= html+ '</li>';
		        }
			}
		})
    }
    return html;
}





var module = 'supplier'
var urlModule = 'http://api.thegioiweb.org/v1.0/supplier'
var fields = 'id,title,total_money,total_money_paid'

function render_html(param){
	let html = ''
	// console.log(param);

	if(param.length){
		param.forEach(function(item, index, array) {
		  	html = html+'<tr style="cursor:pointer;" data-info="'+item['data-info']+'">';
		  		let total_money = item.total_money_import - item.total_money_repay
				html = html+'<td class="text-center">';
					html = html+'<input type="checkbox" name="checkbox[]" value="'+item['id']+'" class="checkbox-item">';
					html = html+'<div for="" class="label-checkboxitem"></div>';
				html = html+'</td>';
				html = html+'<td>'+item['title']+'</td>'; 
				html = html+'<td class="text-right">'+addCommas(is0(total_money))+'</td>'; 
				html = html+'<td class="text-right">'+addCommas(is0(item['total_money_paid']))+'</td>'; 
				html = html+'<td class="text-right"><b>'+addCommas(sub(is0(total_money),is0(item['total_money_paid'])))+'</b></td>'; 
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

	// _________________________________________create_________________________________________
	$(document).on('submit','.js_create', function(){
		event.preventDefault();
		let _this =$(this)
		let obj = _this.serializeObject();

		$.ajax({
			type: 'POST', 
			url: urlModule+'/index?'+authid,
			data: obj,
			crossDomain:true,
			cache: false,
			success: function(resultApi){
				let json = JSON.parse(resultApi);
				if(json.result == true){
					toastr.success(json.message)
					window.location.reload(false); 
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

	// _________________________________________update_________________________________________
	$(document).on('submit','.js_update', function(){
		event.preventDefault();
		let _this = $(this)
		let obj = _this.serializeObject();

		$.ajax({
			type: 'PUT', 
			url: urlModule+'/'+obj.id+'?'+authid,
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
});

function get_list_object(pathname = ''){
	add_loading_view($('.js_content'));
	if(pathname.indexOf("query") >= 0){
		pathname = pathname.replace("query=", "query=trash=0,");
	}else{
		pathname = pathname+'query=trash=0,'
	}
	$.ajax({
		type: 'GET', 
		url: urlModule+'/search?fields='+fields+'&'+pathname,
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

