if($('.js_load_view').length){
	check_permission('salary/backend/salary/view_worker')	
}
var urlModule = 'http://api.thegioiweb.org/v1.0/salary_worker'


function render_html(param){
	let html = ''
	render_worker(param);
	render_construction(param);
	render_cash(param);
}
function render_cash(param){
	let html = ''
	let cash = param.cash
	let total_input = 0;
	let total_output = 0;
	html = html+'<thead>';
	html = html+'<thead>';
		html = html+'<tr>';
			html = html+'<th class="text-center">Tên</th>';
			html = html+'<th class="text-center">Ngày tháng</th>';
			html = html+'<th class="text-center" style="width:320px;">Diễn giải</th>';
			html = html+'<th class="text-center" style="width:120px;">Thu</th>';
			html = html+'<th class="text-center" style="width:120px;">Chi</th>';
			html = html+'<th class="text-center">Ghi chú</th>';
		html = html+'</tr>';
	html = html+'</thead>';
	html = html+'<tbody id="listData">';
	if(cash.length){
		cash.forEach(function(item, index, array) {	
			html = html+'<tr class="gradeX choose">';
				total_input = sum(total_input, convert_false_to(item.input, 0))
				total_output = sum(total_output, convert_false_to(item.output, 0))
				html = html+'<td class="text-center">'+item.fullname+'</td>';
				html = html+'<td class="text-center">'+gettime(item.time, 'DD-MM-YYYY')+'</td>';
				html = html+'<td class="text-center">'+item.title+'</td>';
				html = html+'<td class="text-right">'+addCommas(convert_false_to(item.input, 0))+'</td>';
				html = html+'<td class="text-right">'+addCommas(convert_false_to(item.output, 0))+'</td>';
				html = html+'<td class="text-center">'+item.note+'</td>';
			html = html+'</tr>';

		})
	}else{
		html = html+'<tr class="gradeX choose">';
			html = html+'<td class="text-danger"  colspan="100">Không có dữ liệu phù hợp</td>';
		html = html+'</tr>';
	}
		
		html = html+'<tr>';
			html = html+'<td class="text-right" colspan="3">Tổng</td>';
			html = html+'<td class="text-right"><b>'+addCommas(total_input)+'</b></td>';
			html = html+'<td class="text-right"><b>'+addCommas(total_output)+'</b></td>';
		html = html+'</tr>';
		html = html+'<tr>';
			html = html+'<td class="text-right" colspan="2"><b>Tổng cuối</b></td>';
			html = html+'<td class="text-right" colspan="2"><b>'+addCommas(sub(total_input, total_output))+'</b></td>';
		html = html+'</tr>';
	html = html+'</tbody>';
	$('.js_content_cash').html(html)

}
function render_construction(param){
	let html = ''
	let construction = param.construction
	console.log(construction)
	html = html+'<thead>';
		html = html+'<tr style="background:#eee;">';
			html = html+'<td class="text-center hidden" style="width:86px;">';
				html = html+'<input type="checkbox" id="checkbox-all">';
				html = html+'<label for="check-all" class="labelCheckAll"></label>';
			html = html+'</td>';
			html = html+'<td class="text-center" style="width:86px;">ngày</td>';
			html = html+'<td class="text-center" style="width:180px;">Tên CT</td>';
			html = html+'';
			html = html+'<td class="text-center" style="width:180px;">Diễn giải</td>';
			
			html = html+'<td class="text-center" style="width:60px;">Tổng thợ</td>';

			if(construction.length){
				let item = construction['0']
				let accountant = item.accountant
				if(accountant.length){
					accountant.forEach(function(item1, index1, array1) {
						html = html+'<td class="text-center" style="width:58px;">'+item1.fullname+'</td>';
					})
				}
			}
			html = html+'<td class="text-center">Ghi chú</td>';

		html = html+'</tr>';
	html = html+'</thead>';
	html = html+'<tbody id="listData">';

	let total_worker_all = 0;
	let total_worker = [];
	if(construction.length){
		construction.forEach(function(item, index, array) {
			html = html+'<tr class="gradeX choose">';
				html = html+'<td class="text-center">'+gettime(item.date_start, 'DD-MM-YYYY')+'</td>';
				html = html+'<td class="text-center">'+item.fullname+' '+item.phone+'</td>';
				html = html+'<td class="text-center">'+item.detail+'</td>';
				let accountant = item.accountant
				html = html+'<td class="text-right"><b>'+addCommas(convert_false_to(item.total_money_worker, 0))+'</b></td>';
				total_worker_all = sum(total_worker_all, item.total_money_worker)
				if(accountant.length){
					accountant.forEach(function(item1, index1, array1) {
						html = html+'<td class="text-right">'+addCommas(convert_false_to(item1.money, 0))+'</td>';
						total_worker[index1] = sum(convert_false_to(total_worker[index1], 0), item1.money)
					})
				}
				html = html+'<td class="text-center">'+item.note+'</td>';
			html = html+'</tr>';
		})
	}else{
		html = html+'<tr class="gradeX choose">';
			html = html+'<td class="text-danger"  colspan="100">Không có dữ liệu phù hợp</td>';
		html = html+'</tr>';
	}
		html = html+'<tr>';
			html = html+'<td colspan="3" class="text-center"><b>Tổng</b></td>';
			html = html+'<td class="text-right"><b>'+addCommas(convert_false_to(total_worker_all, 0))+'</b></td>';
			console.log(total_worker);
			total_worker.forEach(function(item1, index1, array1) {
				html = html+'<td class="text-right">'+addCommas(convert_false_to(item1, 0))+'</td>';
			})
			html = html+'<td colspan="3" class="text-center"></td>';
		html = html+'</tr>';
	html = html+'</tbody>';
	$('.js_content_construction').html(html)
}
function render_worker(param){
	let html = ''
	let worker = param.worker
	console.log(worker);
	html = html+'<table class="table-salary table table-striped table-bordered table-hover dataTables-example" id="table_cash" >';
		html = html+'<thead>';
			html = html+'<tr>';
				html = html+'<th style="" class="text-center"></th>';
				html = html+'<th style="width:130px" class="text-center">Tên</th>';
					html = html+'<th style="width:130px" class="text-center">Công trình</th>';
					html = html+'<th style="width:130px" class="text-center">logo</th>';
					html = html+'<th style="width:130px" class="text-center">Chiết khấu % CT</th>';
					html = html+'<th style="width:130px" class="text-center">Chiết khấu % LG</th>';
					html = html+'<th style="width:130px" class="text-center">Thực nhận</th>';
				html = html+'<th style="width:130px" class="text-center">Lương ứng</th>';
				html = html+'<th style="width:130px" class="text-center">Thưởng</th>';
				html = html+'<th style="width:130px" class="text-center">Phạt</th>';
				html = html+'<th style="width:130px" class="text-center">Lương còn</th>';
			html = html+'</tr>';
		html = html+'</thead>';
		html = html+'<tbody>';
			if(worker.length){
				worker.forEach(function(item, index, array) {
					index = sum(index, 1)
					html = html+'<tr>';
						let periodicid = $('select[name=periodicid]').val()
						if(index == 1) {
							html = html+'<td rowspan =100 >';
								html = html+'<a href="salary/backend/salary/view_worker?periodicid="'+periodicid+'>';
									html = html + 'Thợ'
								html = html+'</a>';
							html = html+'</td>';
						}
						
							html = html+'<td class="text-center">';
								html = html+item.fullname
								html = html+'<input class="hidden" type="text" name="user[id][]" value="'+item.id+'"/>'
							html = html+'</td>';
							html = html+'<td class="text-right">'+addCommas(convert_false_to(item['totalWorkCT'], 0))+'</td>';
							html = html+'<td class="text-right">'+addCommas(convert_false_to(item['totalWorkLG'], 0))+'</td>';
							html = html+'<td class="text-right">'+mul(convert_false_to(item['percentCT'], 0), 100)+'</td>';
							html = html+'<td class="text-right">'+mul(convert_false_to(item['percentLG'], 0), 100)+'</td>';

							html = html+'<td>';
								html = html+'<input type="text" name="user[salary][]" value="'+addCommas(convert_false_to(item['salary'],0))+'" class="form-control input-sm int text-right" placeholder="" readonly  autocomplete="off" />'
							html = html+'</td>';
						
						html = html+'<td>';
							html = html+'<input type="text" name="user[ung_luong][]" value="'+addCommas(convert_false_to(item.ung_luong, 0))+'" class="form-control input-sm int text-right" placeholder="" readonly  autocomplete="off" />'
						html = html+'</td>';

						html = html+'<td>';
							html = html+'<input type="text" name="user[bonus][]" value="'+convert_false_to(item.bonus, 0)+'" class="form-control input-sm int text-right" placeholder="" autocomplete="off" />'
						html = html+'</td>';

						html = html+'<td>';
							html = html+'<input type="text" name="user[fine][]" value="'+convert_false_to(item.fine, 0)+'" class="form-control input-sm int text-right" placeholder="" autocomplete="off" />'
						html = html+'</td>';

						html = html+'<td>'+addCommas(convert_false_to(item.totalSalary, 0))+'</td>';
					html = html+'</tr>';
				})
			}
		html = html+'</tbody>';
	html = html+'</table>';
	$('.js_content').html(html)
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
		console.log(1)
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
				render_html(json.data.list)
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

