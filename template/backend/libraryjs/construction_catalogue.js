
if($('.js_load_view').length){
	check_permission('construction/backend/catalogue/view')	
}
if($('.js_load_create').length){
	check_permission('construction/backend/catalogue/create')	
}
if($('.js_load_update').length){
	check_permission('construction/backend/catalogue/update')	
}

var module = 'construction_catalogue'
var urlModule = 'http://api.thegioiweb.org/v1.0/construction_catalogue'
var fields = 'id,title,percent,user_created,construction_count'

function render_html(param){
	let html = ''
	// console.log(param);

	if(param.length){
		param.forEach(function(item, index, array) {

		  	html = html+'<tr style="cursor:pointer;" class="choose">';

				html = html+'<td class="text-center">';
					html = html+'<input type="checkbox" name="checkbox[]" value="'+item['id']+'" class="checkbox-item">';
					html = html+'<div for="" class="label-checkboxitem"></div>';
				html = html+'</td>';
				html = html+'<td>'+item['id']+'</td>'; 
				html = html+'<td>'+item['title']+'</td>'; 
				html = html+'<td class="text-center">'+item['percent']+' %</td>'; 
				html = html+'<td class="text-center">'+item['construction_count']+'</td>'; 
				html = html+'<td class="text-center">'+item['user_created']+'</td>'; 

				html = html+'<td class="client-status" style="text-align:center;">';
					html = html+'<a type="button" href="/construction/backend/catalogue/update/'+item['id']+'"   class="btn btn-sm btn-primary btn-update m-r-xs"><i class="fa fa-edit"></i></a>';
					html = html+'<a type="button" class="btn btn-sm btn-danger ajax_delete" data-title="Bạn chắc chắn muốn thựuc hiện hành động này" data-id="'+item['id']+'" data-module="'+module+'"><i class="fa fa-trash"></i></a>';
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

