if($('.js_load_view').length){
	check_permission('supplier/backend/supplier/detail')	
}
var urlModule = 'http://api.thegioiweb.org/v1.0/supplier_detail'


function render_html(param){
	let html = ''
	console.log(param)
	render_cash(param);
	render_import(param);
	render_repay(param);
	// render_repay(param);
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
				html = html+'<td class="text-center">'+item.title+'</td>';
				html = html+'<td class="text-center">'+gettime(item.time, 'DD-MM-YYYY')+'</td>';
				html = html+'<td class="text-center">'+item.title+'</td>';
				html = html+'<td class="text-right">'+addCommas(convert_false_to(item.input, 0))+'</td>';
				html = html+'<td class="text-right">'+addCommas(convert_false_to(item.output, 0))+'</td>';
				html = html+'<td class="text-center">'+item.note+'</td>';
			html = html+'</tr>';

		})
	}else{
		html = html+'<tr class="gradeX choose">';
			html = html+'<td class="text-danger" colspan="100" >Không có dữ liệu phù hợp</td>';
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
function render_import(param){
	let html = ''
	let import1 = param.import
	console.log(import1)
	html = html+'<thead>';
		html = html+'<tr style="background:#eee;">';
			html = html+'<td class="text-center" style="width:86px;">Ngày</td>';
			html = html+'<td class="text-center" style="width:180px;">Mã đơn nhập</td>';
			html = html+'';
			html = html+'<td class="text-right" style="width:180px;">Tổng tiền</td>';
			
			html = html+'<td class="text-center" style="width:60px;">Người tạo</td>';
		html = html+'</tr>';
	html = html+'</thead>';
	html = html+'<tbody id="listData">';

	if(import1.length){
		import1.forEach(function(item, index, array) {
			html = html+'<tr class="gradeX choose">';
				html = html+'<td class="text-center">'+gettime(item.created, 'DD-MM-YYYY')+'</td>';
				html = html+'<td class="text-center">'+item.code+'</td>';
				html = html+'<td class="text-right">'+addCommas(convert_false_to(item.total_money, 0))+'</td>';
				html = html+'<td class="text-center">'+item.user_created+'</td>';
			html = html+'</tr>';
		})
	}else{
		html = html+'<tr class="gradeX choose">';
			html = html+'<td class="text-danger"  colspan="100">Không có dữ liệu phù hợp</td>';
		html = html+'</tr>';
	}
	html = html+'</tbody>';
	$('.js_content_import').html(html)
}
function render_repay(param){
	let html = ''
	let repay1 = param.repay
	console.log(repay1)
	html = html+'<thead>';
		html = html+'<tr style="background:#eee;">';
			html = html+'<td class="text-center" style="width:86px;">Ngày</td>';
			html = html+'<td class="text-center" style="width:180px;">Mã đơn nhập</td>';
			html = html+'';
			html = html+'<td class="text-right" style="width:180px;">Tổng tiền</td>';
			
			html = html+'<td class="text-center" style="width:60px;">Người tạo</td>';
		html = html+'</tr>';
	html = html+'</thead>';
	html = html+'<tbody id="listData">';

	if(repay1.length){
		repay1.forEach(function(item, index, array) {
			html = html+'<tr class="gradeX choose">';
				html = html+'<td class="text-center">'+gettime(item.created, 'DD-MM-YYYY')+'</td>';
				html = html+'<td class="text-center">'+item.code+'</td>';
				html = html+'<td class="text-right">'+addCommas(convert_false_to(item.total_money, 0))+'</td>';
				html = html+'<td class="text-center">'+item.user_created+'</td>';
			html = html+'</tr>';
		})
	}else{
		html = html+'<tr class="gradeX choose">';
			html = html+'<td class="text-danger"  colspan="100">Không có dữ liệu phù hợp</td>';
		html = html+'</tr>';
	}
	html = html+'</tbody>';
	$('.js_content_repay').html(html)
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

