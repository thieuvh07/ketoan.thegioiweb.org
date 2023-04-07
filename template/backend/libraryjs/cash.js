var linkApi = 'http://api.thegioiweb.org/v1.0/'
if($('.js_load_view').length){
	check_permission('cash/backend/catalogue/view')	
}

var module = 'cash'
var urlModule = linkApi + 'cash'
var fields = ''
// khi clock tìm kiếm thì chuyển sang trang khác
$(document).on('click','.js_search',function(){
	let _this = $(this);
	let obj = get_obj_in_form();
	// đẩy dữ liệu lên url
	pathname = convert_obj_to_pathname(obj, false)
	console.log(pathname)
	pathname = pathname.substr(6, pathname.strlen)
	console.log('http://ketoan.thegioiweb.org/cash/backend/cash/detail/1.html?'+pathname)
	return false;
	location.replace('http://ketoan.thegioiweb.org/cash/backend/cash/detail/1.html?'+pathname)
});



function render_html(param){
	let html = ''
	// console.log(param);

	let periodicid = $('select[name=periodicid]').val()

	if(param.length){
		param.forEach(function(item, index, array) {
		  	html = html+'<tr style="cursor:pointer;" class="choose">';

				html = html+'<td class="text-center">';
					html = html+'<input type="checkbox" name="checkbox[]" value="'+item['id']+'" class="checkbox-item">';
					html = html+'<div for="" class="label-checkboxitem"></div>';
				html = html+'</td>';
				console.log(item)
				html = html+'<td class="text-center">'+gettime(item.date, ' DD-MM-YYYY')+'</td>'; 
				html = html+'<td class="text-right input">'+addCommas(convert_false_to(item.cash.input, 0))+'</td>'; 
				html = html+'<td class="text-right output">'+addCommas(convert_false_to(item.cash.output, 0))+'</td>'; 

				html = html+'<td class="text-right money_closing_day"></td>';
				html = html+'<td class="text-center">';
				let time = gettime(item.date,'DD-MM-YYYY')
				let date = 'date_start='+time+'&date_end='+time
					html = html+'<a href="cash/backend/cash/detail?periodicid='+periodicid+'&'+date+'" class="btn btn-warning btn-sm" onclick="js_open_windown(this); return false"><i class="fa fa-edit"></i> Chi tiết</a>';
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
	// load trang bằng url
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
	$(document).on('change','select[name=periodicid]',function(){
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
	})
});

function get_list_object(pathname = ''){
	add_loading_view($('.js_content'));
	if(pathname.indexOf("&query") > 0){
		pathname = pathname.replace("&query=", "&query=trash=0");
	}else{
		pathname = pathname+'&query=trash=0'
	}
	let periodicid = $('select[name=periodicid]').val()
	console.log(periodicid)
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
				load_money_closing_day()
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

function load_money_closing_day(){
	let _this = $('.js_content');
	let index = 1;
	let money_opening_day = 0;
	let money_closing_day = 0;

	if($('.js_content tr').length){
		length = $('.js_content tr').length;
		money_opening = _this.parent('table').find('.money_opening').text()
		let i=0;
		let money_closing = 0;
		for (length ; length > 0; length--) {
			i++;
			let input = $('.js_content tr:eq('+sub(length,1)+')').find('.input').text();
			let output = $('.js_content tr:eq('+sub(length,1)+')').find('.output').text();
			if(i == 1){
				money_closing_day = money_opening;
			}else{
				money_closing_day = $('.js_content tr:eq('+length+')').find('.money_closing_day').text();
			}
			input = is0(input);
			output = is0(output);
			money_closing_day = is0(money_closing_day);

			input = input.replace(/\./gi, "");
			output = output.replace(/\./gi, "");
			money_closing_day = money_closing_day.replace(/\./gi, "");

			// console.log(money_month);
			$('.js_content tr:eq('+sub(length,1)+')').find('.money_closing_day').text(addCommas(sum(money_closing_day,sub(input,output))));
			money_closing = addCommas(sum(money_closing_day,sub(input,output)));
		}
		_this.parent('table').find('.money_closing').text(money_closing)

	}


	_this.find('tr').each(function(){


	})

}