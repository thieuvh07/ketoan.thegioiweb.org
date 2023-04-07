var module = 'user'
if($('.js_load_view').length){
	check_permission(module+'/backend/'+module+'/view')	
}
if($('.js_load_create').length){
	check_permission(module+'/backend/'+module+'/create')	
}
if($('.js_load_update').length){
	check_permission(module+'/backend/'+module+'/update')	
}


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

				html = html+'<td>';
					html = html+'<span class="uk-flex uk-flex-middle">';
						html = html+'<div class=" height-32 width-32 img-cover m-r-sm ">';
							html = html+'<img alt="'+item['avatar']+'" class="img-circle"  src="'+item['avatar']+'">';
						html = html+'</div>';
						html = html+'<a data-toggle="tab" href="#contact-1" class="client-link">'+item['fullname']+'</a>';
					html = html+'</span>';
				html = html+'</td>';

				html = html+'<td> '+item['account']+'</td>';
				html = html+'<td> '+item['phone']+'</td>';
				html = html+'<td class="client-email"> <i class="fa fa-envelope" style="margin-right:5px;"> </i>'+((typeof item['email'] != 'undefined') ? item['email'] : '-')+'</td>';
				html = html+'<td> '+item['catalogue']+'</td>';

				html = html+'<td class="client-status" style="text-align:center;">';
					html = html+'<a type="button" href="/user/backend/user/update/'+item['id']+'"   class="btn btn-sm btn-primary btn-update m-r-xs"><i class="fa fa-edit"></i></a>';
					html = html+'<a type="button" class="btn btn-sm btn-danger ajax_delete" data-title="Lưu ý: Khi bạn xóa nhận sự, người này sẽ không thể truy cập vào hệ thống quản trị được nữa." data-id="'+item['id']+'" data-module="user"><i class="fa fa-trash"></i></a>';
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
			url: 'http://api.thegioiweb.org/v1.0/user/index?'+authid,
			data: obj,
			crossDomain:true,cache:false,
			success: function(resultApi){
				let json = JSON.parse(resultApi);
				if(json.result == true){
					toastr.success(json.message)
					window.location.reload(false); 
				}else{
					toastr.error(json.message)
				}
				// xóa trắng input
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
		console.log(obj);

		$.ajax({
			type: 'PUT', 
			url: 'http://api.thegioiweb.org/v1.0/user/'+obj.id+'?'+authid,
			data: obj,
			crossDomain:true,cache:false,
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

	/* RESET MẬT KHẨU */
	$(document).on('click','.p-reset',function(){
		let _this = $(this);
		let userID = _this.attr('data-userid');
		if(userID == 0){
			sweet_error_alert('Có vấn đề xảy ra','Bạn phải chọn thành viên để thực hiện thao tác này');
		}else{
			swal({
				title: "Hãy chắc chắn rằng bạn muốn thực hiện thao tác này?",
				text: "Mật khẩu sẽ được cài về giá trị mặc định là : 123456xyz sau thao tác này",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Thực hiện!",
				cancelButtonText: "Hủy bỏ!",
				closeOnConfirm: false,
				closeOnCancel: false },
				function (isConfirm) {
					if (isConfirm) {

						let ajaxUrl = 'user/ajax/user/reset_password';
						$.post(ajaxUrl, {
							userID: userID},
							function(data){
								let json = JSON.parse(data);
								if(json.flag == 1){
									sweet_error_alert('Có vấn đề xảy ra',json.message);
								}else{
									swal("Cập nhật thành công!", "Reset mật khẩu thành công.", "success");
								}
							});
						
					} else {
						swal("Hủy bỏ", "Thao tác bị hủy bỏ", "error");
					}
				});
		}
	});
});

function get_list_object(pathname = ''){
	add_loading_view($('.js_content'))
	if(pathname.indexOf("&query") > 0){
		pathname = pathname.replace("&query=", "&query=trash=0,");
	}else{
		pathname = pathname+'&query=trash=0'
	}

	pathname = 'fields=user.id,user.fullname,user.account,user.email,user.address,user.phone,user.avatar,user.catalogue&'+pathname

	$.ajax({
		type: 'GET', 
		url: 'http://api.thegioiweb.org/v1.0/user/search?'+pathname,
		crossDomain:true,cache:false,
		success: function(resultApi){

			let json = JSON.parse(resultApi);
			if(json.result == true){
				let html = render_html(json.data.list)
				$('.js_to').html(json.data.to)
				$('.js_from').html(json.data.from)
				$('.js_total_rows').html(json.data.total_rows)
				$('.js_content').html(html)
				$('.js_pagination').html(json.data.pagination)
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



