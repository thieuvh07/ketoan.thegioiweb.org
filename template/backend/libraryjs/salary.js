if($('.js_load_view').length){
	check_permission('salary/backend/salary/view')	
}


var urlModule = 'http://api.thegioiweb.org/v1.0/salary'
var fields = ''

$(document).on('submit','.js_update_salary',function(){
	event.preventDefault();
	let _this =$(this)
	let obj = _this.serializeObject();

	let periodicid = $('select[name=periodicid]').val()
	$.ajax({
		type: 'PUT', 
		url: urlModule+'/index?periodicid='+periodicid+authid,
		data: obj,
		crossDomain:true,
		cache: false,
		success: function(resultApi){
			let json = JSON.parse(resultApi);
			if(json.result == true){
				toastr.success(json.message)
				// xóa trắng input
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


function render_html(param){
	let html = ''
	console.log(param);
	Object.keys(param).forEach(function (type) {
		html = html+'<table class="table-salary table table-striped table-bordered table-hover dataTables-example" id="table_cash" >';
			html = html+'<thead>';
				html = html+'<tr>';
					html = html+'<th style="" class="text-center"></th>';
					html = html+'<th style="width:130px" class="text-center">Tên</th>';
					if(type == 'worker'){
						html = html+'<th style="width:130px" class="text-center">Công trình</th>';
						html = html+'<th style="width:130px" class="text-center">logo</th>';
						html = html+'<th style="width:130px" class="text-center">Chiết khấu % CT</th>';
						html = html+'<th style="width:130px" class="text-center">Chiết khấu % LG</th>';
						html = html+'<th style="width:130px" class="text-center">Thực nhận</th>';
					}
					if(type == 'worker_outside'){
						html = html+'<th style="width:130px" class="text-center">Công trình</th>';
						html = html+'<th style="width:130px" class="text-center">Logo</th>';
						html = html+'<th style="width:130px" class="text-center">Thực nhận</th>';
					}
					if(type == 'design'){
						html = html+'<th style="width:130px" class="text-center">Công trình</th>';
						html = html+'<th style="width:130px" class="text-center">Logo</th>';
						html = html+'<th style="width:130px" class="text-center">VP</th>';
						html = html+'<th style="width:130px" class="text-center">Thực nhận</th>';
					}
					if(type == 'office'){
						html = html+'<th style="width:130px" class="text-center">Tổng lợi nhuận từ KDCT</th>';
						html = html+'<th style="width:130px" class="text-center">Tổng lợi nhuận từ KDVP</th>';
						html = html+'<th style="width:130px" class="text-center">Chiết khấu % CT</th>';
						html = html+'<th style="width:130px" class="text-center">Chiết khấu % VP</th>';
						html = html+'<th style="width:130px" class="text-center">KDCT</th>';
						html = html+'<th style="width:130px" class="text-center">KDVP</th>';
						html = html+'<th style="width:130px" class="text-center">Lương thực</th>';
					}
					
					html = html+'<th style="width:130px" class="text-center">Lương ứng</th>';
					html = html+'<th style="width:130px" class="text-center">Thưởng</th>';
					html = html+'<th style="width:130px" class="text-center">Phạt</th>';
					html = html+'<th style="width:130px" class="text-center">Lương còn</th>';
					if(type == 'worker_outside' || type == 'worker'){
						html = html+'<th style="width:130px" class="text-center">Ngày công</th>';
					}


				html = html+'</tr>';
			html = html+'</thead>';
			html = html+'<tbody>';
				value = param[type]
				if(value.length){
					value.forEach(function(item, index, array) {
						index = sum(index, 1)
						html = html+'<tr>';
							let periodicid = $('select[name=periodicid]').val()
							if(index == 1 && type == 'worker') {
								html = html+'<td rowspan =100 >';
									html = html+'<a href="salary/backend/salary/view_worker?periodicid='+periodicid+'" onclick="js_open_windown(this); return false">';
										html = html + 'Thợ'
									html = html+'</a>';
								html = html+'</td>';
							}
							if(index == 1 && type == 'worker_outside' ) {
								html = html+'<td rowspan =100 >';
									html = html + 'Thợ ngoài'
								html = html+'</td>';
							}

							if(index == 1 && type == 'office'){
								html = html+'<td rowspan =100 >KD vs KTVP</td>';
							}
							if(index == 1 && type == 'design'){
								html = html+'<td rowspan =100 >Thiết kế</td>';
							}
							
							if(type == 'worker'){
								console.log(item)
								html = html+'<td class="text-center">';

									html = html+'<a href="salary/backend/salary/detail_worker?periodicid='+periodicid+'&id='+item.id+'" onclick="js_open_windown(this); return false">';
										html = html+item.fullname
									html = html+'</a>';
									html = html+'<input class="hidden" type="text" name="user['+item.id+'][id]" value="'+item.id+'"/>'
								html = html+'</td>';
								html = html+'<td class="text-right">'+addCommas(convert_false_to(item['totalWorkCT'], 0))+'</td>';
								html = html+'<td class="text-right">'+addCommas(convert_false_to(item['totalWorkLG'], 0))+'</td>';
								html = html+'<td class="text-right">'+mul(convert_false_to(item['percentCT'], 0), 100)+'</td>';
								html = html+'<td class="text-right">'+mul(convert_false_to(item['percentLG'], 0), 100)+'</td>';

								html = html+'<td class="text-right">'+addCommas(convert_false_to(item['salary'],0));
								html = html+'</td>';
							}
							if(type == 'worker_outside'){
								html = html+'<td class="text-center">';
									html = html+item.fullname
									html = html+'<input class="hidden" type="text" name="user['+item.id+'][id]" value="'+item.id+'"/>'
								html = html+'</td>';
								html = html+'<td class="text-right">'+addCommas(convert_false_to(item['totalWorkCT'], 0))+'</td>';
								html = html+'<td class="text-right">'+addCommas(convert_false_to(item['totalWorkLG'], 0))+'</td>';
								html = html+'<td class="text-right">'+addCommas(convert_false_to(item['salary'],0));
								html = html+'</td>';
							}

							if(type == 'design'){
								html = html+'<td class="text-center">';
									html = html+'<a href="salary/backend/salary/detail_worker?periodicid='+periodicid+'&id='+item.id+'" onclick="js_open_windown(this); return false">';
										html = html+item.fullname
									html = html+'</a>';
									html = html+'<input class="hidden" type="text" name="user['+item.id+'][id]" value="'+item.id+'"/>'
								html = html+'</td>';
								html = html+'<td class="text-right">'+addCommas(convert_false_to(item['totalWorkCT'], 0))+'</td>';
								html = html+'<td class="text-right">'+addCommas(convert_false_to(item['totalWorkLG'], 0))+'</td>';
								html = html+'<td class="text-right">'+addCommas(convert_false_to(item['profitVP'], 0))+'</td>';
								html = html+'<td class="text-right">'+addCommas(convert_false_to(item['salary'],0));
								html = html+'</td>';
							}
							if(type == 'office'){
								html = html+'<td class="text-center">';
									html = html+'<a href="salary/backend/salary/detail_office?periodicid='+periodicid+'&id='+item.id+'" onclick="js_open_windown(this); return false">';
										html = html+item.fullname
									html = html+'</a>';
									html = html+'<input class="hidden" type="text" name="user['+item.id+'][id]" value="'+item.id+'"/>'
								html = html+'</td>';
								html = html+'<td class="text-right">'+addCommas(convert_false_to(item['profitCT'], 0))+'</td>';
								html = html+'<td class="text-right">'+addCommas(convert_false_to(item['profitVP'], 0))+'</td>';
								html = html+'<td class="text-right">'+mul(convert_false_to(item['percentCT'],0),100)+'</td>';
								html = html+'<td class="text-right">'+mul(convert_false_to(item['percentVP'],0),100)+'</td>';
								html = html+'<td class="text-right">'+addCommas(convert_false_to(item['salaryCT'],0))+'</td>';
								html = html+'<td class="text-right">'+addCommas(convert_false_to(item['salaryVP'],0))+'</td>';
								html = html+'<td>';
									html = html+'<input type="text" name="user['+item.id+'][salary]" value="'+addCommas(convert_false_to(item['salary'],0))+'" class="form-control input-sm int text-right" placeholder=""  autocomplete="off" />'
								html = html+'</td>';
							}

							
							html = html+'<td>';
								html = html+'<input type="text" name="user['+item.id+'][ung_luong]" value="'+addCommas(convert_false_to(item.ung_luong, 0))+'" class="form-control input-sm int text-right" placeholder="" readonly  autocomplete="off" />'
							html = html+'</td>';

							html = html+'<td>';
								html = html+'<input type="text" name="user['+item.id+'][bonus]" value="'+addCommas(convert_false_to(item.bonus, 0))+'" class="form-control input-sm int text-right" placeholder="" autocomplete="off" />'
							html = html+'</td>';

							html = html+'<td>';
								html = html+'<input type="text" name="user['+item.id+'][fine]" value="'+addCommas(convert_false_to(item.fine, 0))+'" class="form-control input-sm int text-right" placeholder="" autocomplete="off" />'
							html = html+'</td>';

							html = html+'<td class="text-right">'+addCommas(convert_false_to(item.totalSalary, 0))+'</td>';
							if(type == 'worker_outside' || type == 'worker'){
								html = html+'<td class="text-right">'+convert_false_to(item.timekeeping, 0)+'</td>';
							}
							
						html = html+'</tr>';
					})
				}
			html = html+'</tbody>';
		html = html+'</table>';
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

