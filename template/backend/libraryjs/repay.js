var module = 'repay'
if($('.js_load_view').length){
	check_permission(module+'/backend/'+module+'/view')	
}
if($('.js_load_create').length){
	check_permission(module+'/backend/'+module+'/create')	
}
if($('.js_load_update').length){
	check_permission(module+'/backend/'+module+'/update')	
}
// tính tổng tiền đơn xuất và tổng tiền từng sản phẩmkiểm tra số lượng tồn trong kho
$(document).on('change keyup','input[name="product[quantity_repay][]"]',function(){
	console.log(1)
	let _this = $(this);
	let price = _this.parents('tr').find('input[name="product[price][]"]').val();
	let quantity = _this.val();
	let quantity_closing_stock = _this.parents('tr').find('input[name="product[quantity_closing_stock][]"]').val();
	let quantity_old = _this.parents('tr').find('input[name="product[quantity_old][]"]').val();
	if(sub(quantity, sum(quantity_closing_stock, quantity_old)) > 0){
		toastr.error('Vui lòng nhập lại','Số lượng trong kho không đủ');
		_this.val(quantity_closing_stock);
		return false;
	} 

	quantity = is0(quantity);
	let price_output = _this.parents('tr').find('input[name="product[price_output][]"]').val()
	price_output = is0(price_output);
	price_output = price_output.replace(/\./gi, "");
	_this.parents('tr').find('.money').html(addCommas(mul(quantity,price_output)))
	total_money_repay();
})


if($('.js_update').length){
	total_money_repay();
}
if($('.js_search_product').length){
	total_money_repay();

	$(document).on('change keyup','input[name="product[quantity_repay][]"],input[name="product[price][]"]',function(){
		let _this = $(this);
		let money = 0;
		let price = _this.parents('tr').find('input[name="product[price][]"]').val();
		let quantity_repay = _this.parents('tr').find('input[name="product[quantity_repay][]"]').val();
		price = is0(price);
		quantity_repay = is0(quantity_repay);

		price = price.replace(/\./gi, "");
		money =  Math.round(mul(quantity_repay, price));
		money = addCommas(money);
		_this.parents('tr').find('input[name="product[money][]"]').removeAttr('readonly');
		_this.parents('tr').find('input[name="product[money][]"]').val(money);
		_this.parents('tr').find('input[name="product[money][]"]').attr('readonly', true);
		total_money_repay();
	});
	


	$(document).on('change','select[name=supplierid]', function(){
		$(this).parents('.row').find('input[name=product]').attr('data-supplierid', $(this).val());
	});
	// lấy ra danh sách sản phẩm thảo mãn đk
	$(document).on('click keyup','.js_search_product',function(){
		let _this = $(this);
		let supplierid = _this.parents('.row').find('select[name=supplierid]').val();
		if(supplierid == ''){
			swal("Bạn phải chọn nhà cung cấp trước", "", "error");
			_this.val('');
			return false
		}
		js_search_product($(this));
	});
	// khi chọn vào 1 sp trong danh sách
	$(document).on('click','#list-product li',function(){
		let _this = $(this);
		//lấy info của sp
		let data = _this.attr('data-info');
		data = window.atob(data);
		$('#list-product').html('');
		$('.js_search_product').val('');
		// thêm mới sản phẩm vào bảng
		let html= html_product(data);
		$('.js_content').append(html);
		total_money_repay();
	});
	// xóa sp trong bảng
	$(document).on('click','.trash',function(){
		let _this = $(this);
		swal({
			title: "Hãy chắc chắn rằng bạn muốn thực hiện thao tác này?",
			text: '',
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Thực hiện!",
			cancelButtonText: "Hủy bỏ!",
			closeOnConfirm: false,
			closeOnCancel: false },
		function (isConfirm) {
			if (isConfirm) {
				_this.parents('tr').remove();
				total_money_repay();
				swal("Xóa thành công!", "Sản phẩm đã được xóa khỏi danh sách.", "success");
			} else {
				swal("Hủy bỏ", "Thao tác bị hủy bỏ", "error");
			}
		});
		total_money_repay();
	});

}


var module = 'repay'
var urlModule = 'http://api.thegioiweb.org/v1.0/repay'
var fields = 'id, code, supplierid, date_start,supplier,user_created,total_money,code'
function openKCFinderSlide(button) {
	window.KCFinder = {
		callBackMultiple: function(files) {
			window.KCFinder = null;
			for (var i = 0; i < files.length; i++){
				let src= files[i];
				let lastIndexOf = src.lastIndexOf('/');
				let length = src.length;
				let name = src.substr(lastIndexOf+1,length);
				var extend = ['.jpg', '.jpeg', '.png', '.gif', '.JPG', '.JPEG', '.PNG', '.GIF'];
				let index=0
				for (var k = extend.length -1; k >= 0; k--) {
					index = name.indexOf(extend[k]);
					if(index != -1){
						name = name.substr(0,index)
					}
				}
				$('#list-img').append(image_render( src, name));
				
			}
		}
	};
	 window.open(BASE_URL + 'plugin/kcfinder-3.12/browse.php?type=images&dir=images/public', 'kcfinder_image',
        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
        'resizable=1, scrollbars=0, width=1080, height=800'
    );
}
function image_render(src = '', name=''){
	let html = '<div class="col-sm-2">';
		html = html + '<img class="img-prd" src="'+src+'" alt="À‰nh">';
		html = html + '<input type="text" name="repay[title][]" placeholder="Thêm tên sp" value="" autocomplete="off" class="text-center m-b-sm form-control" />';
		html = html + '<input type="text" name="repay[code][]" value="'+name+'" class="text-center hidden m-b form-control" />';
		html = html + '<span class="m-b-sm text-center">'+name+'</span><input type="text" name="repay[image][]" value="'+src+'" class="hidden" />';
	return html;
}


function openKCFinder(button) {
	window.KCFinder = {
		callBackMultiple: function(files) {
			window.KCFinder = null;
			for (var i = 0; i < files.length; i++){
				let src= files[i];
				let lastIndexOf = src.lastIndexOf('/');
				let length = src.length;
				let name = src.substr(lastIndexOf+1,length);
				var extend = ['.jpg', '.jpeg', '.png', '.gif', '.JPG', '.JPEG', '.PNG', '.GIF'];
				let index=0
				for (var k = extend.length -1; k >= 0; k--) {
					index = name.indexOf(extend[k]);
					if(index != -1){
						name = name.substr(0,index)
					}
				}
				$('.img-thumbnail').append(image_render( src, name));
				
			}
		}
	};
	 window.open(BASE_URL + 'plugin/kcfinder-3.12/browse.php?type=images&dir=images/public', 'kcfinder_image',
        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
        'resizable=1, scrollbars=0, width=1080, height=800'
    );
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
				

				html = html+'<td>'+item['id']+'</td>'; 
				html = html+'<td>'+gettime(item['date_start'], 'DD-MM-YYYY')+'</td>'; 
				html = html+'<td>'+item['supplier']+'</td>'; 
				html = html+'<td>'+item['detail']+'</td>'; 
				html = html+'<td class="text-right"><b>'+addCommas(is0(item['total_money']))+'</b></td>'; 
				html = html+'<td>'+item['user_created']+'</td>'; 

				

				html = html+'<td class="client-status" style="text-align:center;">';
					html = html+'<a type="button" href="/repay/backend/repay/update/'+item['id']+'"   class="btn btn-sm btn-primary btn-update m-r-xs"><i class="fa fa-edit"></i></a>';
					// html = html+'<a type="button" class="btn btn-sm btn-danger ajax_delete" data-title="Bạn chắc chắn muốn thựuc hiện hành động này" data-id="'+item['id']+'" data-module="'+module+'"><i class="fa fa-trash"></i></a>';
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

// thêm html sản phẩm vào bảng
function html_product(data){
	let json = JSON.parse(data);
	html='';
	html= html+ '<tr>';
        html= html+ '<td>'+ json.code +'</td>';
        html= html+ '<td>'+ cutnchar(json.title ,70) ;
        	html=html+ '<input type="text"  name="product[id][]" value="'+json.id+'" class="hidden">'
        	html=html+ '<input type="text"  name="product[quantity_closing_stock][]" value="'+json.quantity_closing_stock+'" class="hidden">'
        	html=html+ '<input type="text"  name="product[quantity_old][]" value="'+convert_false_to(json.quantity_old, 0)+'" class="hidden">'
        	html=html+ '<input type="text"  name="product[title][]" value="'+json.title+'" class="hidden">'
        html= html+ ' </td>';

        html= html+ ' <td>';
        	html= html+ '<div class="input-group">';
        		html= html+ '<input type="text" autocomplete="off" style="height: 25px" name="product[quantity_repay][]" value="0" class="float text-right form-control">';
            html= html+ '</div>';
        html= html+ '</td>';

        html= html+ ' <td>';
        	html= html+ '<div class="input-group">';
        		html= html+ '<input type="text" autocomplete="off" style="height: 25px" name="product[measure_repay][]" value="Cuốn" class="text-right form-control">';
            html= html+ '</div>';
        html= html+ '</td>';

        html= html+ ' <td>';
        	html= html+ '<div class="input-group">';
        		html= html+ '<input type="text" autocomplete="off" style="height: 25px" name="product[quantity][]" value="0" class="float text-right form-control">';
            html= html+ '</div>';
        html= html+ '</td>';

        html= html+ '<td>';
        	html= html+ json.measure;
        html= html+ ' </td>';

        html= html+ '<td>';
       		html= html+ '<div class="input-group">';
        		html= html+ '<input type="text" autocomplete="off" name="product[price][]" style="height: 25px" value="0" class="int text-right form-control">';
        	html= html+ '</div>';
        html= html+ '</td>';

        html= html+ '<td class="text-right"><input type="text" autocomplete="off" name="product[money][]" style="height: 25px" value="0" class="int text-right form-control"  readonly></td>';

    

        html= html+ '<td class="trash text-danger" style="width:20px;"><i class="fa fa-trash" aria-hidden="true"></i></td>';
    html= html+ '</tr>';
    return html;
}
function total_money_repay(){
	let total_money = 0;
	$('.js_content tr').each(function (){
		let _this = $(this);
		let price = _this.find('input[name="product[price][]"]').val();
		let quantity = _this.find('input[name="product[quantity_repay][]"]').val();
		
		price = is0(price);
		price = price.replace(/\./gi, "");
		quantity = is0(quantity);
 
		total_money =  total_money + Math.round(sub(mul(price, quantity)));
	});
	if($('.total_money').length){
	 	$('.total_money').html(addCommas(total_money));
	}
}
