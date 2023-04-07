if($('.js_load_view').length){
	check_permission('product/backend/month/view')	
}

var module = 'product'
var urlModule = 'http://api.thegioiweb.org/v1.0/product_month'
var fields = ''

function render_html(param){
	let html = ''
	console.log(param);

	if(param.length){
		param.forEach(function(item, index, array) {
		  	html = html+'<tr style="cursor:pointer;" class="choose">';

				html = html+'<td class="text-center">';
					html = html+'<input type="checkbox" name="checkbox[]" value="'+item['id']+'" class="checkbox-item">';
					html = html+'<div for="" class="label-checkboxitem"></div>';
				html = html+'</td>';
				html = html+'<td class="img-product"><img alt="image" src="'+item['image']+'"> </td>';
				
				html = html+'<td>'+item['title']+'</td>'; 
				html = html+'<td>'+item['code']+'</td>'; 
				html = html+'<td class="text-right">'+convert_false_to(item['quantity_opening_stock'], 0, false)+'</td>'; 
				html = html+'<td class="text-right">'+convert_false_to(item['quantity_closing_stock'], 0, false)+'</td>'; 
				html = html+'<td class="text-right">'+convert_false_to(item['import'], 0, false)+'</td>'; 
				html = html+'<td class="text-right">'+convert_false_to(item['export'], 0, false)+'</td>'; 

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

	$(document).on('change','select[name=periodicid]',function(){
		let _this = $('.js_load_view')
		// lấy dữ liệu url
		let obj = get_obj_in_form();
		let page = get_page_in_url();
		obj.page = page;
		// đẩy dữ liệu lên url
		pathname = convert_obj_to_pathname(obj)
		// console.log(pathname);
		get_list_object(pathname);

	});

});

function get_list_object(pathname = ''){
	add_loading_view($('.js_content'));
	time = setTimeout(function(){
		let periodicid = $('select[name=periodicid]').val()
		console.log(pathname)
		if(pathname.indexOf("query=") >= 0){
			pathname = pathname.replace("query=", "query=trash=0,");
		}else{
			pathname = pathname+'&query=trash=0,'
		}
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

	},500);
	
}

