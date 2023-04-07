if($('.js_load_view').length){
	check_permission('cash/backend/common/view')	
}
if($('.js_load_create').length){
	check_permission('cash/backend/common/create')	
}
if($('.js_load_update').length){
	check_permission('cash/backend/common/update')	
}

// cập nhập khoản thu chi
$(document).on('click','.js_update',function(){
	let _this = $(this);
	let detail = _this.parents('tr').find('.detail').text();
	let input = _this.parents('tr').find('.input').text();
	let output = _this.parents('tr').find('.output').text();
	let note = _this.parents('tr').find('.note').text();
	let extend = _this.parents('tr').find('.extend').text();

	_this.parents('tr').find('.detail').html('<input type="text" style="height:30px" name="title" value="'+detail+'" class="form-control text-center" autocomplete="off">');
	_this.parents('tr').find('.input').html('<input type="text" style="height:30px" name="input" value="'+input+'" class="form-control text-right int" autocomplete="off">');
	_this.parents('tr').find('.output').html('<input type="text" style="height:30px" name="output" value="'+output+'" class="form-control text-right int" autocomplete="off">');
	_this.parents('tr').find('.note').html('<input type="text" style="height:30px" name="note" value="'+note+'" class="form-control" autocomplete="off">');

	let catalogueid = _this.parents('tr').find('.catalogue').attr('data-catalogueid');
	_this.parents('tr').find('.catalogue').html('<div class="js_dropdown" data-name="catalogueid" data-module="cash_catalogue" data-value="title" data-checked="'+catalogueid+'"></div>');
	js_dropdown(_this.parents('tr').find('.catalogue .js_dropdown'))

	let extendid = _this.parents('tr').find('.extend').attr('data-id');
	if(catalogueid == 2){
		_this.parents('tr').find('.extend').html('<div class="js_dropdown" data-checked="'+extendid+'" data-name="userid" data-module="user" data-text="Chọn NV" data-value="fullname"></div>');
		js_dropdown(_this.parents('tr').find('.extend .js_dropdown'))
	}
	if(catalogueid == 1){
		_this.parents('tr').find('.extend').html('<input id="construction" value="'+extend+'" data-id="'+extendid+'" type="text" style="height:30px" name="constructionid" class="form-control text-center" placeholder="Tìm công trình" autocomplete="off"><ul id="list-construction"></ul>');
		select_construction();
	}
	if(catalogueid == 7){
		_this.parents('tr').find('.extend').html('<div class="js_dropdown" data-checked="'+extendid+'" data-name="supplierid" data-module="supplier" data-text="Chọn NCC" data-value="title"></div>');
		js_dropdown(_this.parents('tr').find('.extend .js_dropdown'))
	}
	let data_id = _this.parents('tr').attr('data-id');
	_this.parents('tr').find('.client-status').html('<a type="button" value="'+data_id+'" class="btn btn-sm btn-primary ajax_update">Cập nhật</a>');
});



// thêm thành phần mở rộng khi thay đổi nhóm tiền mặt
$(document).on('change','#table_cash select[name=catalogueid]',function(){
	let _this = $(this);
	let id = _this.val();
	console.log(id)
	_this.parents('tr').find('.extend').html('');
	if(id == 2){
		_this.parents('tr').find('.extend').html('<div class="js_dropdown" data-name="userid" data-module="user" data-text="Chọn NV" data-value="fullname"></div>');
		js_dropdown(_this.parents('tr').find('.extend .js_dropdown'))
	}
	if(id == 1){
		_this.parents('tr').find('.extend').html('<input id="construction" type="text" style="height:30px" name="constructionid" class="form-control text-center" placeholder="Tìm công trình" autocomplete="off"><ul id="list-construction"></ul>');
		select_construction();
	}
	if(id == 7){
		_this.parents('tr').find('.extend').html('<div class="js_dropdown" data-name="supplierid" data-module="supplier" data-text="Chọn NCC" data-value="title"></div>');
		js_dropdown(_this.parents('tr').find('.extend .js_dropdown'))
	}
});


function select_construction(){
	// công trình phải chọn không được đánh kí tự
	$(document).on('change','#construction',function(){	
		$('#construction').attr('data-id','' );
	});
	// lấy ra danh sách công trình thảo mãn đk
	$(document).on('click keyup','#construction',function(){
		let _this = $(this);
		let keyword = _this.val();
		keyword = $.trim(keyword);
		if(keyword.length > 1){
			setTimeout(function() {

				$.ajax({
					type: 'GET', 
					url: 'http://api.thegioiweb.org/v1.0/construction/index?fields=fullname,code,gross_revenue_real,user_charge,id&query=trash=0,keyword='+keyword,
					crossDomain:true,
					cache: false,
					success: function(resultApi){
						let json = JSON.parse(resultApi);
						if(json.result == true){
							$('#list-construction').html(render_html_construction(json.data.list));
						}else{
							toastr.error(json.message)
						}
					},
					error: function(resultApi){
						let json = JSON.parse(resultApi);
						toastr.error(json.message)
					}
				});
			}, 200);
		}
		$('#list-construction').html('');
	});
	// khi chọn vào 1 công trình trong danh sách
	$(document).on('click','#list-construction li',function(){
		let id = $(this).attr('data-id');
		let title = $(this).find('.title').text();
		$('#construction').attr('data-id',id );
		$('#construction').val(title);
		$('#list-construction').html('');
	});
	$(document).mouseup(function(e){
	    let container = $("#list-construction li");
	    if (!container.is(e.target) && container.has(e.target).length === 0){
	        container.hide();
	    }
	});
}
function render_html_construction(param){
	let html = ''
	if(param.length){
		param.forEach(function(item, index, array) {
			html = html+'<li class="p-xxs" data-id="'+item['id']+'">';
				html = html+'<div class="uk-flex uk-flex-middle uk-flex-space-between">';
					html = html+'<div><span class="font-bold">Tên CT:  </span><span class="title">'+item['fullname']+' '+convert_false_to(item['phone'],'')+'</span></div>';
					html = html+'<div class="code"><span class="font-bold">Mã CT: </span>'+item['code']+'</div>';
					html = html+'<div class="gross_revenue"><span class="font-bold">Doanh thu:  </span>'+addCommas(convert_false_to(item['gross_revenue_real'], 0))+'</div>';
				html = html+'</div>';
				html = html+'<div class="uk-flex uk-flex-middle uk-flex-space-between">';
					html = html+'<div><span class="font-bold">NVKD :  </span>'+item['user_charge']+'</div>';
				html = html+'</div>';
			html = html+'</li>';
		});

	}else{
		html = html+'<li class="text-left">';
				html = html+'<small class="text-danger">Không có dữ liệu phù hợp</small>';
		html = html+'</li>';
	}
	console.log(html)
	return html
}

var module = 'cash_detail'
var urlModule = 'http://api.thegioiweb.org/v1.0/cash_common'
var fields = ''

function render_html(param){
	let html = ''
	// console.log(param);

	if(param.length){
		param.forEach(function(item, index, array) {
		 	html = html+'<tr style="cursor:pointer;" class="choose" data-id="'+item['id']+'">';

				html = html+'<td class="text-center">';
					html = html+'<input type="checkbox" name="checkbox[]" value="'+item['id']+'" class="checkbox-item">';
					html = html+'<div for="" class="label-checkboxitem"></div>';
				html = html+'</td>';
				html = html+'<td class="detail">'+item['title']+'</td>'; 
				html = html+'<td class="text-center catalogue" data-catalogueid="'+item['catalogueid']+'">'+item['catalogue']+'</td>'; 
				html = html+'<td data-id="'+item['extendid']+'" class="extend">'+item['extend']+'</td>'; 

				html = html+'<td class="text-right input">'+addCommas(convert_false_to(item.input, 0))+'</td>'; 
				html = html+'<td class="text-right output">'+addCommas(convert_false_to(item.output, 0))+'</td>'; 

				html = html+'<td class="note">'+item['note']+'</td>'; 
				html = html+'<td class="text-center client-status">';
					html = html+'<a type="button" class="btn btn-sm btn-warning js_update m-r-xs"><i class="fa fa-edit"></i></a>';
					html = html+'<a type="button" data-module="cash_common" data-id="'+item['id']+'" class="btn btn-sm btn-danger ajax_delete"><i class="fa fa-trash"></i></a>';
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
	$(document).on('click','.js_create', function(){
		console.log(1)
		event.preventDefault();
		let _this =$(this)
		let obj = {}
		obj.title = _this.parents('tr').find('input[name="title"]').val()
		obj.catalogueid = _this.parents('tr').find('select[name="catalogueid"]').val()
		obj.note = _this.parents('tr').find('input[name="note"]').val()
		obj.input = _this.parents('tr').find('input[name="input"]').val()
		obj.output = _this.parents('tr').find('input[name="output"]').val()

		let userid = _this.parents('tr').find('select[name=userid]').val();
		let constructionid = _this.parents('tr').find('#construction').attr('data-id');
		let supplierid = _this.parents('tr').find('select[name=supplierid]').val();
		obj.userid = convert_false_to(userid, 0);
		obj.constructionid = convert_false_to(constructionid, 0);
		obj.supplierid = convert_false_to(supplierid, 0);

		obj.input = is0(obj.input);
		obj.input = obj.input.replace(/\./gi, "");
		output = is0(obj.output);
		obj.output = obj.output.replace(/\./gi, "");
		console.log(obj)
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

					let _this = $('.js_load_view')
					// lấy dữ liệu url

					let obj = get_obj_in_form();
					pathname = convert_obj_to_pathname(obj)
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

	// _________________________________________update_________________________________________
	$(document).on('click','.ajax_update', function(){
		event.preventDefault();
		let _this =$(this)
		let obj = {}
		let id = _this.parents('tr').attr('data-id');
		obj.title = _this.parents('tr').find('input[name="title"]').val()
		obj.catalogueid = _this.parents('tr').find('input[name="catalogueid"]').val()
		obj.note = _this.parents('tr').find('input[name="note"]').val()
		obj.input = _this.parents('tr').find('input[name="input"]').val()
		obj.output = _this.parents('tr').find('input[name="output"]').val()

		let userid = _this.parents('tr').find('select[name=userid]').val();
		let constructionid = _this.parents('tr').find('#construction').attr('data-id');
		let supplierid = _this.parents('tr').find('select[name=supplierid]').val();
		obj.userid = convert_false_to(userid, 0);
		obj.constructionid = convert_false_to(constructionid, 0);
		obj.supplierid = convert_false_to(supplierid, 0);

		obj.input = is0(obj.input);
		obj.input = obj.input.replace(/\./gi, "");
		output = is0(obj.output);
		obj.output = obj.output.replace(/\./gi, "");
		console.log(obj)
		$.ajax({
			type: 'PUT', 
			url: urlModule+'/'+id+'?'+authid,
			data: obj,
			crossDomain:true,
			cache: false,
			success: function(resultApi){
				let json = JSON.parse(resultApi);
				if(json.result == true){
					toastr.success(json.message)
					let obj = get_obj_in_form();
					pathname = convert_obj_to_pathname(obj)
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
	if(pathname.indexOf("query") > 0){
		pathname = pathname.replace("query=", "query=trash=0,");
	}else{
		pathname = pathname+'query=trash=0,'
	}
	let periodicid = $('select[name=periodicid]').val()
	time = setTimeout(function(){
		$.ajax({
			type: 'GET', 
			url: urlModule+'/view?&periodicid='+periodicid+'&'+pathname,
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
					$('.money_opening').html(convert_false_to(addCommas(json.data.money_opening), 0))
				}
				// load lại tồn tiền trong cách ngày
				del_loading_view($('.js_content'))

			},
			error: function(resultApi){
				let json = JSON.parse(resultApi);
				toastr.error(json.message)
				del_loading_view($('.js_content'))
			}
		});
	},10);
}


