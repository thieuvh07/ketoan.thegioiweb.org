var module = 'construction'
if($('.js_load_view').length){
	check_permission(module+'/backend/'+module+'/view')	
}
if($('.js_load_create').length){
	check_permission(module+'/backend/'+module+'/create')	
}
if($('.js_load_update').length){
	check_permission(module+'/backend/'+module+'/update')	
}
// hủy công trình
// _________________________________________update_________________________________________
$(document).on('click','.js_update_status', function(){
	let _this = $(this)
	let id = _this.attr('data-id')
	let title = _this.attr('data-title')

	swal({
		title: "Hãy chắc chắn rằng bạn muốn hủy công trình này?",
		text: title,
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Thực hiện!",
		cancelButtonText: "Hủy bỏ!",
		closeOnConfirm: false,
		closeOnCancel: false },
	function (isConfirm) {
		if (isConfirm) {
			$.ajax({
				type: 'PUT', 
				url: urlModule+'/update/'+id+'?'+authid,
				crossDomain:true,
				cache: false,
				success: function(resultApi){
					let json = JSON.parse(resultApi);
					if(json.result == true){
						swal("Cập nhật thành công!", "Hạng mục đã được xóa khỏi danh sách.", "success");
					}else{
						swal("Có lỗi xảy ra", "", "warning");
					}
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
				},
				error: function(resultApi){
					let json = JSON.parse(resultApi);
					toastr.error(json.message)
				}
			});
		} else {
			swal("Hủy bỏ", "Thao tác bị hủy bỏ", "error");
		}
	});
	

});

// tính tổng tiền đơn xuất và tổng tiền từng sản phẩmkiểm tra số lượng tồn trong kho
$(document).on('change keyup','input[name="product[quantity][]"]',function(){
	let _this = $(this);
	let price = _this.parents('tr').find('input[name="product[price][]"]').val();
	let quantity = _this.val();
	let quantity_closing_stock = _this.parents('tr').find('input[name="product[quantity_closing_stock][]"]').val();
	let quantity_old = _this.parents('tr').find('input[name="product[quantity_old][]"]').val();
	quantity_old = convert_false_to(quantity_old, 0)

	if(sub(quantity, sum(quantity_closing_stock, quantity_old)) > 0){
		toastr.error('Vui lòng nhập lại','Số lượng trong kho không đủ');
		_this.val(sum(quantity_closing_stock,quantity_old));
		return false;
	} 

	quantity = is0(quantity);
	let price_output = _this.parents('tr').find('input[name="product[price_output][]"]').val()
	price_output = is0(price_output);
	price_output = price_output.replace(/\./gi, "");
	_this.parents('tr').find('.money').html(addCommas(mul(quantity,price_output)))
	total_money_construction();
})

// xóa 1 sp trong bản
$(document).on('click','.js_del',function(){
	let _this = $(this);
	_this.parents('tr').remove()
	total_money_construction()
});

if($('.js_search_product').length){
	total_money_construction();
	// lấy ra danh sách sản phẩm thảo mãn đk
	$(document).on('click keyup','.js_search_product',function(){
		js_search_product($(this));
	});
	// khi chọn vào 1 sp trong danh sách
	$(document).on('click','#list-product li',function(){
		let _this = $(this);
		//lấy info của sp
		let data = _this.attr('data-info');
		data = window.atob(data);
		$('.js_search_product').val('');
		// thêm mới sản phẩm vào bảng
		let html= html_product(data);
		$('.js_content').append(html);
		$('#list-product').html('');
		numberOrder('.js_content');
		total_money_construction()
	});
	$(document).on('change keyup','input[name="product[quantity][]"]',function(){
		
		total_money_construction();
	});
	//khi click ra chỗ khác thì sẽ ẩn danh sách khách hàng đi
	$(document).mouseup(function(e){
	    let container = $("<div id='list-product'> </div> li");
	    if (!container.is(e.target) && container.has(e.target).length === 0){
	       container.hide()
	    }
	});

}
function total_money_construction(){
	let total_money = 0;
	$('.js_content tr').each(function (){
		let _this = $(this);
		let price_output = _this.find('input[name="product[price_output][]"]').val();
		let quantity = _this.find('input[name="product[quantity][]"]').val();
		
		price_output = is0(price_output);
		price_output = price_output.replace(/\./gi, "");
		quantity = is0(quantity);
		total_money =  total_money + Math.round(sub(mul(price_output, quantity)));
	});
	if($('.total_money').length){
	 	$('.total_money').html(addCommas(total_money));
	}
}

// thêm html sản phẩm vào bảng
function html_product(data){
	let json = JSON.parse(data);
	console.log(json)
	html='';
	html= html+ '<tr>';
        html= html+ '<td class=" numberOrder text-center"></td>';
        html= html+ '<td>'+ json.code;
        	html=html+ '<input type="text"  autocomplete="off"  name="product[code][]" value="'+json.code+'" class="hidden">'
        html= html+ ' </td>';
        html= html+ '<td>'+ cutnchar( json.title ,100) ;
        	html=html+ '<input type="text"  autocomplete="off"  name="product[id][]" value="'+json.id+'" class="hidden">'
        	html=html+ '<input type="text"  autocomplete="off"  name="product[title][]" value="'+json.title+'" class="hidden">'
        	html=html+ '<input type="text"  autocomplete="off"  name="product[quantity_closing_stock][]" value="'+json.quantity_closing_stock+'" class="hidden">'
        html= html+ ' </td>';
        html= html+ '<td>';
        	html= html+ json.measure;
        	html=html+ '<input type="text"  autocomplete="off"  name="product[measure][]" value="'+json.measure+'" class="hidden">'
        html= html+ '</td>';
         html= html+ '<td class="text-right">';
        	html=html+ '<input type="text" class="text-right form-control float" autocomplete="off"  name="product[quantity][]" value="0" >'
        html= html+ '</td>';

        html= html+ '<td>';
       		html= html+ '<div class="input-group pull-right">';
        		html= html+ '<input type="text" autocomplete="off"  name="product[price_output][]" style="height: 25px" value="'+addCommas(json.price_output)+'" class="text-right form-control">';
        	html= html+ '</div>';
        html= html+ '</td>';
        html= html+ '<td class="trash text-danger js_del"><i class="fa fa-trash" aria-hidden="true"></i></td>';
    html= html+ '</tr>';
    return html;
}




var module = 'construction'
var urlModule = 'http://api.thegioiweb.org/v1.0/construction'
var fields = 'trash,id,type,fullname,phone,code,date_start,status,status_extend,user_charge'

function render_html(param){
	let html = ''
	let style = ''
	// console.log(param);

	if(param.length){
		param.forEach(function(item, index, array) {
			if(item['status'] == 1){
				style = 'style ="cursor:pointer;text-decoration: line-through;"';
			}else{
				style = ''
			}
		  	html = html+'<tr class="choose" '+style+'>';

				html = html+'<td class="text-center">';
					html = html+'<input type="checkbox" name="checkbox[]" value="'+item['id']+'" class="checkbox-item">';
					html = html+'<div for="" class="label-checkboxitem"></div>';
				html = html+'</td>';


				html = html+'<td>'+item['id']+'</td>'; 
				html = html+'<td>'+item['code']+'</td>'; 
				html = html+'<td>'+item['fullname']+item['phone']+'</td>'; 
				html = html+'<td class="text-center">'+gettime(item['date_start'], 'DD/MM/YYYY')+'</td>'; 
				html = html+'<td class="text-center">'+item['user_charge']+'</td>'; 


				html = html+'<td class="text-center">';
					if(item['status_export'] == 0){
						html = html+'<span class="label label-warning-light m-r-xs m-">Đang đợi</span>';
					}else{
						html = html+'<span class="label label-success-light m-r-xs m-">Đã xuất hàng</span>';
					}
				html = html+'</td>';
				html = html+'<td class="text-center">';
					if(item['status_construction'] == 0){
						html = html+'<span class="label label-warning-light m-r-xs m-">Đang đợi</span>';
					}else{
						html = html+'<span class="label label-success-light m-r-xs m-">Đã hoàn thành</span>';
					}
				html = html+'</td>';

				html = html+'<td class="text-center">';
					// nếu công trình đã hủy thì tắt nút update
					if(item['status'] == 0){
						html = html+'<a type="button" href="construction/backend/construction/update/'+item['id']+'" class="btn btn-sm btn-primary m-r-xs"><i class="fa fa-edit"></i></a>';
					}
					// trường hợp đủ đk hủy
					if(item['status_done'] == 1 && item['status'] == 0){
						html = html+'<a type="button" data-id="'+item['id']+'" data-title="Khi hủy công trình số lượng đơn xuất hàng và sẽ về không" class="btn btn-sm btn-warning js_update_status"><i class="fa fa-ban "></i></a>';
					}else{
					// trường hợp ko đủ điều kiện hủy
						html = html+'<a disabled="disabled" type="button" data-id="'+item['id']+'" data-title="Khi hủy công trình số lượng đơn xuất hàng và sẽ về không" class="btn btn-sm btn-warning"><i class="fa fa-ban"></i></a>';
					}
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
	if(pathname.indexOf("&query") > 0){
		pathname = pathname.replace("&query=", "&query=trash=0,");
	}else{
		pathname = pathname+'&query=trash=0,'
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

