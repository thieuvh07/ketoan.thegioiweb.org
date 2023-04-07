var module = 'periodic'
if($('.js_load_view').length){
	check_permission(module+'/backend/'+module+'/view')	
}
var urlModule = 'http://api.thegioiweb.org/v1.0/periodic'
var fields = ''


function render_html(param){
	let html = ''
	// console.log(param);
	
	let date_end = (check_val(param[0]['date_end'])) ? param[0]['date_end'] : '';
	if(date_end != ''){
		date_end = sum(date_end, 24*60*60*1000)
	}
	
	html = html+'<tr style="cursor:pointer;" class="choose">';

		html = html+'<td class="text-center">';
			html = html+'<input type="checkbox" name="checkbox[]" value="" class="checkbox-item">';
			html = html+'<div for="" class="label-checkboxitem"></div>';
		html = html+'</td>';

		html = html+'<td class="text-center"><input type="text" name="title" value="" class="form-control text-center input-sm m-r-sm " placeholder="Nhập tiêu đề" autocomplete="off"></td>';

		html = html+'<td class="text-center date_start">'+gettime(date_end, 'DD-MM-YYYY')+'</td>'; 
		html = html+'<td><input type="text" name="date_end" value="" class="form-control text-center datetimepicker input-sm m-r-sm " placeholder="Chọn ngày kết thúc" autocomplete="off" data-mask="99/99/9999"></td>'; 
		html = html+'<td class="text-right">0</td>'; 
		html = html+'<td class="text-right">0</td>'; 
		html = html+'<td><input type="text" name="note" value="" class="form-control text-center input-sm m-r-sm " placeholder="Nhập ghi chú" autocomplete="off"></td>'; 
		html = html+'<td><a type="button" class="btn btn-sm btn-primary js_create"> Kết chuyển</a></td>'; 
	html = html+'</tr>';
	if(param.length){
		

		param.forEach(function(item, index, array) {
		  	html = html+'<tr style="cursor:pointer;" class="choose">';

				html = html+'<td class="text-center">';
					html = html+'<input type="checkbox" name="checkbox[]" value="'+item['id']+'" class="checkbox-item">';
					html = html+'<div for="" class="label-checkboxitem"></div>';
				html = html+'</td>';

				html = html+'<td>'+item['title']+'</td>'; 
				html = html+'<td class="text-center">'+gettime(item['date_start'],'DD-MM-YYYY')+'</td>'; 
				html = html+'<td class="text-center">'+gettime(item['date_end'],'DD-MM-YYYY')+'</td>'; 
				html = html+'<td class="text-right">0</td>'; 
				html = html+'<td class="text-right">0</td>'; 
				html = html+'<td class="text-center">'+item['note']+'</td>'; 
				html = html+'<td></td>'; 
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
	// _________________________________________create_________________________________________
	$(document).on('click','.js_create', function(){
		event.preventDefault();
		let _this =$(this)
		let obj = {};
		obj.title = _this.parents('tr').find('input[name=title]').val()
		obj.date_end = _this.parents('tr').find('input[name=date_end]').val()	
		obj.note = _this.parents('tr').find('input[name=note]').val()	
		obj.date_start = _this.parents('tr').find('.date_start').val()	

		if(!check_val(obj.title)){toastr.error('Vui lòng nhập tiêu đề',''); return false}
		if(!check_val(obj.date_end)){toastr.error('Vui lòng thời gian',''); return false}
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
					// xóa trắng input
					clear_all_input()
					let _this = $('.js_load_view')
					// lấy dữ liệu url
					let obj = get_obj_in_form();
					let page = get_page_in_url();
					obj.page = page;
					// đẩy dữ liệu lên url
					pathname = convert_obj_to_pathname(obj)
					// console.log(pathname);
					get_list_object(pathname);
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
		pathname = pathname.replace("&query=", "&query=trash=0");
	}else{
		pathname = pathname+'&query=trash=0'
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

