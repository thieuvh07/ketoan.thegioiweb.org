

let authCookie = readCookie('auth')
if(typeof authCookie !== 'undefined' && authCookie != ''){
	authCookie = JSON.parse(authCookie);
	var auth = authCookie['auth']
	let temp = JSON.stringify({'id':auth['id']})
	var authid = '&authid='+window.btoa(unescape(encodeURIComponent(temp)))
}
// check_permission()


$(document).ready(function() {

	if($('.datetimepicker').length > 0 ){
		$('.datetimepicker').datetimepicker({
			format: 'd-m-Y',
			timepicker:false,
		});
	}

	
	// kiểm tra trạng thái đăng nhập
	check_login()
	
	
	//thêm mới nhóm sản phẩm
	$(document).on('submit','#form_create_catalogueid',function(e){
		e.stopPropagation();
		let obj = $(this).serializeArray();
		let urlModule = 'http://api.thegioiweb.org/v1.0/product_catalogue'
		$.ajax({
			type: 'POST', 
			url: urlModule+'/index?'+authid,
			data: obj,
			crossDomain:true,
			cache: false,
			success: function(resultApi){
				let json = JSON.parse(resultApi);
				if(json.result == true){
					swal("Thêm mới thành công!", "Thêm mới nhóm sản phẩm thành công.", "success");
					$('.modal-footer .btn-white').trigger("click");
					$("#create_catalogueid .error").addClass('hidden');
					clear_all_input()
				}else{
					$("#create_catalogueid .error").removeClass('hidden');
                	$("#create_catalogueid .error .alert").html(data);
					toastr.error(json.message)
				}
			},
			error: function(resultApi){
				let json = JSON.parse(resultApi);
				toastr.error(json.message)
			}
		});
		return false;
	});
	//thêm mới nhà cung cấp
	$(document).on('submit','#form_create_supplier',function(e){
		e.stopPropagation();
		let obj = $(this).serializeArray();
		let urlModule = 'http://api.thegioiweb.org/v1.0/supplier'
		$.ajax({
			type: 'POST', 
			url: urlModule+'/index?'+authid,
			data: obj,
			crossDomain:true,
			cache: false,
			success: function(resultApi){
				let json = JSON.parse(resultApi);
				if(json.result == true){
					swal("Thêm mới thành công!", "Thêm mới nhóm sản phẩm thành công.", "success");
					$('.modal-footer .btn-white').trigger("click");
					$("#create_catalogueid .error").addClass('hidden');
					clear_all_input()
				}else{
					$("#create_catalogueid .error").removeClass('hidden');
                	$("#create_catalogueid .error .alert").html(data);
					toastr.error(json.message)
				}
			},
			error: function(resultApi){
					return false;
				let json = JSON.parse(resultApi);
				toastr.error(json.message)
			}
		});
	});

	

	if($('.js_count').length){
		$('.js_count').each(function(item) {
			let _this = $(this)
			let module = _this.attr('data-module')
			let query = _this.attr('data-query')+',trash = 0'

			if(typeof module == 'undefined' || module == '') { return false }

			let pathname = 'limit=100000'
			if(typeof query != 'undefined'){ 
				pathname = 'limit=100000&query='+query
			}
			
			$.ajax({
				type: 'GET', 
				url: 'http://api.thegioiweb.org/v1.0/'+module+'/index?'+pathname,
				crossDomain:true,
				cache: false,
				success: function(resultApi){
					let json = JSON.parse(resultApi);
					if(json.result == true){
						let list = json.data.list
						if(_this.is("input")) {
							_this.val(list.length)
						}else{
							_this.html(list.length)
						}

					}
				},
				error: function(){
					toastr.error('Có lỗi sảy ra vui lòng thử lại')
				}
			});
		});
	}


	if($('.js_dropdown').length){
		$('.js_dropdown').each(function(item) {
			js_dropdown($(this))
		});
	}
	if($('.js_get_quantity_closing_stock').length){
		$('.js_get_quantity_closing_stock').each(function(item) {
			js_get_quantity_closing_stock($(this))
		});
	}
	if($('.js_dropdown_vn').length){
		$('.js_dropdown_vn').each(function(item) {
			js_dropdown_vn($(this))
		});
	}
	
	$(document).on('click','.js_extend',function(){	
		extend($(this))
	});

	// search advened khi click con chuột ra ngoài
	$(document).mouseup(function(e) {
	    let container = $('.js_block_search_advance');
	    let hide = $('.js_target_search_advance');
	    // if the target of the click isn't the container nor a descendant of the container
	    if (!container.is(e.target) && container.has(e.target).length === 0){
	        hide.hide();
	    }
	});

	// Xóa 1 row trong bảng
	$(document).on('click','.js_del_row', function(){
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
					swal("Xóa thành công!", "Hạng mục đã được xóa khỏi danh sách.", "success");
					console.log(2);
					update_key_in_table(_this.parents('table'));
				} else {
					swal("Hủy bỏ", "Thao tác bị hủy bỏ", "error");
				}
			});
	});
	
	// nhân bảng dòng 
	$(document).on('click','.js_ducated_row', function(){
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
					let row = _this.parents('tr').html();
					let index = _this.parents('tr').index();
					_this.parents('tr').after('<tr>'+row+'</tr>');
					_this.parents('tbody').find('tr:eq('+sum(index,1)+')').find('td:eq(9)').find('span').remove();
					// copy value
					var time = setTimeout(function(){
						let table = _this.parents('table');
						_this.parents('tr').find('td').each(function(item) {
							$(this).find('input').each(function(item1) {
								let index = _this.parents('tr').index();
								let val = $(this).val();
								let name = $(this).attr('name')
								_this.parents('tbody').find('tr:eq('+sum(index,1)+')').find('input[name="'+name+'"]').attr('name', name.replace(index, sum(index,1)))
								_this.parents('tbody').find('tr:eq('+sum(index,1)+')').find('input[name="'+name.replace(index, sum(index,1))+'"]').val(val)
								// _this.parents('tbody').find('tr:eq('+sum(index,1)+')').find('input[name="'+name+'"]').attr('name', name.replace(index, sum(index,1)))
							});
							$(this).find('select').each(function(item1) {
								let index = _this.parents('tr').index();
								let val = $(this).val();
								let name = $(this).attr('name')
								_this.parents('tbody').find('tr:eq('+sum(index,1)+')').find('select[name="'+name+'"]').attr('name', name.replace(index, sum(index,1)))
								_this.parents('tbody').find('tr:eq('+sum(index,1)+')').find('select[name="'+name.replace(index, sum(index,1))+'"]').val(val)
							});
						});
					}, 500);

					swal("Nhân bản thành công!", "", "success");
				} else {
					swal("Hủy bỏ", "Thao tác bị hủy bỏ", "error");
				}
				update_key_in_table(_this.parents('table'));
			});
	});

	$('.js_close_windown').click(function(){
		close();
	});
	$('.js_open_windown').click(function(){
		js_open_windown($(this))
	});
	
	$(document).on('click','.ajax_delete',function(){
		let _this = $(this);
		let obj = {}
		obj.title = _this.attr('data-title');
		obj.moduleText = _this.attr('data-moduleText');
		obj.module = _this.attr('data-module');
		obj.id = _this.attr('data-id');
		swal({
			title: "Hãy chắc chắn rằng bạn muốn thực hiện thao tác này?",
			text: obj.title,
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Thực hiện!",
			cancelButtonText: "Hủy bỏ!",
			closeOnConfirm: false,
			closeOnCancel: false },
			function (isConfirm) {
				if (isConfirm) {

					$.ajax({
						type: 'POST', 
						url: 'http://api.thegioiweb.org/v1.0/'+obj.module+'/delete/'+obj.id+'?'+authid,
						data: obj,
						crossDomain:true,
						cache:false,
						success: function(resultApi){
							let json = JSON.parse(resultApi);
							if(json.result == true){
								swal("Xóa thành công!", "Hạng mục đã được xóa khỏi danh sách.", "success");
								_this.parents('tr').hide().remove();
							}else{
								toastr.error(json.message)
							}
						},
						error: function(resultApi){
							let json = JSON.parse(resultApi);
							toastr.error(json.message)
						}
					});

				} else {
					swal("Hủy bỏ", "Thao tác bị hủy bỏ", "error");
				}
			});
	});
	$(document).on('click','.ajax_update_status',function(){
		let _this = $(this);
		let obj = {}
		let module = _this.attr('data-module');
		obj.id = _this.attr('data-id');
		let publish = _this.parents('.onoffswitch').find('.onoffswitch-checkbox').val()
		console.log(publish)
		if(publish == 0){
			obj.publish = 1;
		}else{
			obj.publish = 0;
		}
		
		$.ajax({
			type: 'put', 
			url: 'http://api.thegioiweb.org/v1.0/'+module+'/'+obj.id+'?'+authid,
			data: obj,
			crossDomain:true,
			cache:false,
			success: function(resultApi){
				let json = JSON.parse(resultApi);
				if(json.result == true){
					toastr.success("Cập nhật thành công")
					_this.parents('.onoffswitch').find('.onoffswitch-checkbox').val(obj.publish)
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


	// luôn focus mouse ở ô title khi load trang
	if($('.i-checks').length){
		ichecks($('.i-checks'));
	}
	if($('.js_name').length){
		$(document).on('change keyup keydown','.js_name',function(){
			ucWord($('.js_name'));
		});
	}
	
	if($('input[name="fullname"]').length){
		forcusEnd($('input[name="fullname"]'));
	}
	if($('input[name="title"]').length){
		forcusEnd($('input[name="title"]'));
	}

	/* SELECT 2 */
	if($('.select3NotSearch').length){
		$('.select3NotSearch').select2({
		    minimumResultsForSearch: -1
		});
	}
	if($('.select3').length){
		$('.select3').select2();
	}
	$('.selectMultipe').each(function(key, index){
		selectMultipe($(this));
	});


	// __________________________QUẬN HUYỆN TỈNH THÀNH__________________________

	$(document).on('change','#city',function(e, data){
		let _this = $(this);
		let param = {
			'parentid' : _this.val(),
			'select' : 'districtid',
			'table'  : 'vn_district',
			'trigger_district': (typeof(data) != 'undefined') ? true : false,
			'text'   : 'Chọn Quận/Huyện',
			'parentField'  : 'provinceid',
		}
		get_location(param, '#district');
	});
	if(typeof(cityid) != 'undefined' && cityid != ''){
		$('#city').val(cityid).trigger('change', [{'trigger':true}]);
	}
	$(document).on('change','#district', function(e, data){
		let _this = $(this);
		let param = {
			'parentid' : _this.val(),
			'select' : 'wardid',
			'trigger_ward': (typeof(data) != 'undefined') ? true : false,
			'table'  : 'vn_ward',
			'text'   : 'Chọn Phường/Xã',
			'parentField'   : 'districtid',
		}
		get_location(param, '#ward');
	});
	
	// ______________________________CHECKBOX ALL IN VIEW______________________________
	$(document).on('click','.label-checkboxitem',function(){
		let _this = $(this);
		_this.parent().find('.checkbox-item').trigger('click');
		check(_this);
		change_background(_this);
		check_item_all(_this);
		check_setting();
	});

	$(document).on('click','.labelCheckAll',function(){
		let _this = $(this);
		_this.siblings('input').trigger('click');
		check(_this);
		checkall(_this);
		change_background();
		check_setting();
	});

	// __________________________________CK EDITOR__________________________________
	$('.ckeditor-description').each(function(){
		CKEDITOR.replace( this.id, {
			height: 250,
			extraPlugins: 'colorbutton,panelbutton,pastefromexcel,font,format,youtube,link',
			removeButtons: '',
			entities: true,
			allowedContent: true,
			
		});
	});
	$('.ckeditor-content').each(function(){
		CKEDITOR.replace( this.id, {
			height: 250,
			extraPlugins: 'colorbutton,panelbutton,pastefromexcel,font,format,youtube',
			removeButtons: '',
			entities: true,
			allowedContent: true,
			toolbarGroups: [
				{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
				{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
				{ name: 'links' },
				{ name: 'insert' },
				{ name: 'forms' },
				{ name: 'tools' },
				{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
				{ name: 'colors' },
				{ name: 'others' },
				'/',
				{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
				{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
				{ name: 'styles' }
			],
		});
	});
	//_____________________________ÉP KIỂU INPUT INT FLOAT_____________________________
	// nếu input là 0 thì khi click vào sẽ rỗng
	$(document).on('click','.float, .int',function(){
		let data = $(this).val();
		if(data == 0){
			$(this).val('');
		}
	});
	$(document).on('keydown','.float, .int',function(e){
		let data = $(this).val();
		if(data == 0){
			let unicode=e.keyCode || e.which;
			if(unicode != 190){
				$(this).val('');
			}
		}
	});
	//khi thay đổi hoặc ấn phím xong : nếu  =='' sẽ trở về không, nếu == NaN cũng về 0
	$(document).on('change keyup blur','.int',function(){
		let data = $(this).val();
		if(data == '' ){
			$(this).val('0');
			return false;
		}
		data = data.replace(/\./gi, "");
		$(this).val(addCommas(data));
		// khi đánh chữ thì về 0
		data = data.replace(/\./gi, "");
		if(isNaN(data)){
			$(this).val('0');
			return false;
		}
	});
	$(document).on('change blur','.float',function(){
		let data = $(this).val();
		if(data == '' ){
			$(this).val('0');
			return false;
		}
		// khi đánh chữ thì về 0
		data = data.replace(/\./gi, "");
		if(isNaN(data)){
			$(this).val('0');
			return false;
		}
	});
	
});


function addCommas(nStr){
	nStr = String(nStr);
	nStr = nStr.replace(/\./gi, "");
	let str ='';
	for (i = nStr.length; i > 0; i -= 3){
		a = ( (i-3) < 0 ) ? 0 : (i-3); 
		str= nStr.slice(a,i) + '.' + str; 
	}
	str= str.slice(0,str.length-1); 

	return str;
}

/* CHECKBOX */
function check(object){
	if(object.hasClass('checked')){
		object.removeClass('checked');
	}else{
		object.addClass('checked');
	}
}
function check_setting(){
	if($('.checkbox-item').length) {
		if($('.checkbox-item:checked').length > 0) {
			$('.fa-cog').addClass('text-pink');
		}
		else{
			$('.fa-cog').removeClass('text-pink');
		}
	}
}
function check_item_all(_this){
	let table = _this.parents('table');
	if(table.find('.checkbox-item').length) {
		if(table.find('.checkbox-item:checked').length == table.find('.checkbox-item').length) {
			table.find('#checkbox-all').prop('checked', true);
			table.find('.labelCheckAll').addClass('checked');
		}
		else{
			table.find('#checkbox-all').prop('checked', false);
			table.find('.labelCheckAll').removeClass('checked');
		}
	}
}
function checkall(_this){
	let table = _this.parents('table');
	if($('#checkbox-all').length){
		if(table.find('#checkbox-all').prop('checked')){
			table.find('.checkbox-item').prop('checked', true);
			table.find('.label-checkboxitem').addClass('checked');
			
		}
		else{
			table.find('.checkbox-item').prop('checked', false);
			table.find('.label-checkboxitem').removeClass('checked');
		}
	}
	check_setting();
}

function change_background() {
	$('.checkbox-item').each(function() {
		if($(this).is(':checked')) {
			$(this).parents('tr').addClass('bg-active');
		}else {
			$(this).parents('tr').removeClass('bg-active');
		}
	});
}


function get_location(param, object){
	if(districtid == '' || param.trigger_district == false) districtid = 0;
	if(wardid == ''  || param.trigger_ward == false) wardid = 0;
	
	$.ajax({
		type: 'GET', 
		url: 'http://api.thegioiweb.org/v1.0/location/index',
		data:{ parentid: param.parentid, select: param.select, table: param.table, text: param.text, parentField: param.parentField},
		crossDomain:true,
		success: function(resultApi){
			let json = JSON.parse(resultApi);
			if(json.result == true){
				let data = json.data;
				if(param.select == 'districtid'){
					if(param.trigger_district == true){
						$(object).html(data.html).val(districtid).trigger('change', [{'trigger':true}]);
					}else{
						$(object).html(data.html).val(districtid).trigger('change');
					}
				}else if(param.select == 'wardid'){
					$(object).html(data.html).val(wardid);
				}
			}else{
				toastr.error(json.message)
			}

			$('.select3NotSearch').select2({
			    minimumResultsForSearch: -1
			});
			

		},
		error: function(resultApi){
			let json = JSON.parse(resultApi);
			toastr.error(json.message)
		}
	});

}



function slug(title){
	title = cnvVi(title);
	return title;
}


function cnvVi(str) {
	str = str.toLowerCase();
	str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
	str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
	str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
	str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
	str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
	str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
	str = str.replace(/đ/g, "d");
	str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g, "-");
	str = str.replace(/-+-/g, "-");
	str = str.replace(/^\-+|\-+$/g, "");
	return str;
}
function replace(Str=''){
	if(Str==''){
		return '';
	}else{
		Str = Str.replace(/\./gi, "");
		return Str;
	}
}
 
function selectMultipe(_this){
	let text = _this.attr('data-text')
	let module = _this.attr('data-module');
	let key = _this.attr('data-key');
	let value = _this.attr('data-value');
	let query = _this.attr('data-query')
	let selected= _this.attr('data-selected')

	key = (typeof key == 'undefined') ? 'id' : key ;
	value = (typeof value == 'undefined') ? 'title' : value ;
	text = (typeof text == 'Vui lòng nhập 2 kí tự') ? 'title' : text ;

	if(selected != ''){
		setTimeout(function(){
			$.post('dashboard/ajax/dashboard/get_select2', {
				selected: selected, module: module,value:value, key:key},
				function(data){
					let json = JSON.parse(data);
					if(json.items!='undefined' && json.items.length){
						for(let i = 0; i< json.items.length; i++){
							var option = new Option(json.items[i].text, json.items[i].id, true, true);
							_this.append(option).trigger('change');
						}
					}
				});
		}, 100);
		select2(_this, module, key, value, query)
	}else{
		select2(_this, module, key, value, query)
	}
}

function select2(_this, module, key, value, query ){
	_this.select2({
		minimumInputLength: 2,
		placeholder: 'Nhập 2 kí tự để tìm kiếm..',
			ajax: {
				url: 'dashboard/ajax/dashboard/get_select2',
				type: 'POST',
				dataType: 'json',
				deley: 250,
				data: function (params) {
					return {
						locationVal: params.term,
						module:module, key:key, value:value, query:query,
					};
				},
				processResults: function (data) {
					return {
						results: $.map(data, function(obj, i){
							return obj
						})
					}
					
				},
				cache: true,
			}
	});
}
function cutnchar(str,n){
	length = str.length;
	if(length < n){
		return str;
	}
	str = str.substr(0,n)+'...';
	return str;
}
function sum(a = 0 ,b = 0){
	if(b == ''){b = 0}
	return parseFloat(a) + parseFloat(b);
}
function sub(a = 0 ,b = 0){
	return parseFloat(a) - parseFloat(b);
}
function div(a = 0 ,b = 0){
	return parseFloat(a) / parseFloat(b);
}
function mul(a = 0 ,b = 0, c = 1){
	return Math.round(parseFloat(a) * parseFloat(b) * parseFloat(c));
}
// // gettime trong js
// function getTime(date, type='d-m-Y', result='Y/m/d'){
// 	// kieems tra xem co date truyển vào không
// 	if(date == '' || date == null){
// 		return false;
// 	}
// 	if(date.indexOf(' ') != -1){
// 		date = date.substr(0, 10)
// 	}
// 	// date = date.replace(' 00:00:00','');
// 	//chuyển ngày tháng nhập vào thành mảng
// 	if(date.indexOf('-') != -1){
// 		date1 = date.split('-');
// 	}
// 	if(date.indexOf('/') != -1){
// 		date1 = date.split('/');
// 	}
// 	// chuyển kiểu ngày tháng ban đầu thành mảng
// 	if(type.indexOf('-') != -1){
// 		type1 = type.split('-');
// 	}
// 	if(type.indexOf('/') != -1){
// 		type1 = type.split('/');
// 	}
// 	// chuyển ngày tháng muốn trả về thành mảng
// 	if(result.indexOf('-') != -1){
// 		result1 = result.split('-');
// 		// lấy kí tự phân cách giữa ngày tháng năm( chỉ có 2 TH là  - vs /)
// 		a ='-';
// 	}
// 	if(result.indexOf('/') != -1){
// 		result1 = result.split('/');
// 		a ='/';
// 	}
// 	//lặp mảng kiểu kết quả trả về
// 		// console.log(date1);
// 		// console.log(type1);
// 		// console.log(result1);
// 	for (i = 0; i < result1.length; i++){
// 		//lặp kiểu kết quả nhập vào ban đầu
// 		for (j = 0; j < type1.length; j++){
// 			// nếu kết quả ban đầu bằng với kết quả trả về thì ta
// 			// gắn ngày tháng nhập vào tương ứng vào mảng trả về
// 			if(type1[j] == result1[i]){
// 				result1[i] = date1[j]
// 			}
// 		}
// 	}
// 	//nối mảng trả về thành cuối cách nhau mảng kí tự phân cách

// 	// console.log(result1[0] + a + result1[1] + a + result1[2]);
// 	return result1[0] + a + result1[1] + a + result1[2] ;
// }
function readerCode(length = 6) {
  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

  for (var i = 0; i < length; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));

  return text;
}
function ichecks(_this) {
	_this.iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green',
	});
}
function ucwords(str) { 
    str = (str + '').toLowerCase(); 
    return str.replace(/^([a-z])|\s+([a-z])/g, function ($1) { 
     return $1.toUpperCase(); 
    }); 
} 
function ucWord(str) {
	string = ucwords(str.val())
	str.val(string);
	return true
}

function forcusEnd(input) {
	input.focus();
	var tmpStr = input.val();
	input.val('');
	input.val(tmpStr);
}

function extend(_this) {
	let param = []
	let extend_target = findElement(_this, '.js_extend_target')

	let collapse = _this.attr('data-collapse');
	if(typeof collapse == 'undefined'){
		collapse = 'Thu gọn';
	}
	let extend = _this.attr('data-extend');
	if(typeof extend == 'undefined'){
		extend = 'Mở rộng';
	}

	if(extend_target != false){
		if(extend_target.find('.js_extend_target').css('display') == 'none'){
			_this.html('<u>'+collapse+'</u>')
		}else{
			_this.html('<u>'+extend+'</u>')
		}
		extend_target.find('.js_extend_target').slideToggle()
	}
}

var parentElement = 0;
function findElement(_this, element, parent = 4) {
	let elm = _this.parent().find(element);
	if(elm.length > 0){
		parentElement = 0;
		return _this.parent();
	}else{
		parentElement = sum(parentElement, 1)
		if(parentElement <= parent){
			return findElement(_this.parent(), element)
		}
		return false
	}
}
function update_key_in_table(table){
	table.find('tbody tr').each(function(index) {
		$(this).find('td:eq(0)').html(sum(index, 1))
		$(this).find('input').each(function(item1) {
			let name = $(this).attr('name')
			let sub_name = name.substr(0, name.length -5);
			$(this).attr('name', sub_name+'['+index+'][]')
		});
		$(this).find('select').each(function(item1) {
			let name = $(this).attr('name')
			let sub_name = name.substr(0, name.length -5);
			$(this).attr('name', sub_name+'['+index+'][]')
		});
	});
}
function add_loading(_this){
	let html = '<div class="lds-css ng-scope"><div class="lds-eclipse"><div></div></div></div>'
	_this.css("position", "relative");
	_this.append(html)
}
function del_loading(_this){
	_this.find('.lds-css').remove()
	_this.css("position", "");
}
function add_loading_2(_this){
	let html = '<div class="sk-spinner sk-spinner-wave loading-2"> <div class="sk-rect1"></div> <div class="sk-rect2"></div> <div class="sk-rect3"></div> <div class="sk-rect4"></div> <div class="sk-rect5"></div> </div>'
	_this.css("background", "rgba(0, 0, 0, 0.45)");
	_this.append(html)
}

function del_loading_2(_this){
	_this.find('.loading-2').remove()
	_this.css("background", "");
}
function add_loading_view(_this){
	_this= _this.parents('table')
	let html = '<div class="sk-spinner sk-spinner-wave loading-2" style="background: #fff; top:90%"> <div class="sk-rect1"></div> <div class="sk-rect2"></div> <div class="sk-rect3"></div> <div class="sk-rect4"></div> <div class="sk-rect5"></div> </div>'
	_this.after(html)
}

function del_loading_view(_this){
	_this= _this.parents('table')
	_this.parent().find('.loading-2').remove()
	_this.css("background", "");
}

function first(array, n){
	if (array == null) 
      return void 0;
    if (n == null) 
      return array[0];
    if (n < 0)
      return [];
    return array.slice(0, n);
}
function check_login(){
    let authCookie = readCookie('auth')
    // nếu tồn tại auth
    if(typeof authCookie !== 'undefined' && authCookie != ''){
        authCookie = JSON.parse(authCookie);
        var auth = authCookie['auth']
        // nếu tồn tại auth
        if(typeof auth !== 'undefined'){
            let href = window.location.href
            // nếu đang ở đăng nhập
            if(href == 'http://ketoan.thegioiweb.org/admin'){
                window.location.replace("http://ketoan.thegioiweb.org/dashboard/home");
            }
            return true
        }
    }
    window.location.replace("http://ketoan.thegioiweb.org/admin");
}

function check_permission(permission = '' ){
    // lấy đường dẫn hiện tại
    let obj = {}
    // obj.permission = location.pathname.substring(1)
    obj.permission = permission
    obj.id = auth.id
    $.ajax({
		type: 'get', 
		url: 'http://api.thegioiweb.org/v1.0/auth/check_permission?'+authid,
		data: obj,
		crossDomain:true,cache:false,
		success: function(resultApi){
			let json = JSON.parse(resultApi);
			if(json.result == true){
				// toastr.success(json.message)
				// clear_all_input()
			}else{
				toastr.error(json.message)
				window.location.replace('http://ketoan.thegioiweb.org/dashboard/home')
			}
			// xóa trắng input
		},
		error: function(resultApi){
			let json = JSON.parse(resultApi);
			toastr.error(json.message)
		}
	});

}



// ______________________________________load view______________________________________
function convert_obj_to_pathname(obj = {}, push = true){
	let page = 1
	if(obj.page != '' && typeof obj.page != 'undefined'){
		page = obj.page;
	}
	let pathname = window.location.pathname;
	
	let pageCurent = get_page_in_url()
	if(pageCurent == ''){
		pathname = pathname.replace('view', 'view/1');
		// pathname = pathname.replace('detail', 'detail/1');
	}else{
		pathname = pathname.replace('view/'+pageCurent, 'view/'+page+'');
		// pathname = pathname.replace('detail/'+pageCurent, 'detail/'+page+'');
	}

	let href = pathname+'?';
	let pathnameNew = ''
	let query = 'query='
	let perpage = (typeof obj['perpage'] == 'undefined') ? 20 : obj['perpage']
	console.log(obj)
	$.each( obj, function( key, value ) {
		if(check_val(value)){
			if(key != 'order_by' || value != -1){
				href = href+key+'='+value+'&';
				console.log(key)
				if(key == 'perpage'){
					pathnameNew = pathnameNew+'limit='+value+'&';
				}else if (key == 'page'){
					pathnameNew = pathnameNew+'offset='+mul(sub(value,1),perpage)+'&';
				}else{
					console.log(1)
					query = query+key+'='+value+',';
				}
			}
		}
	});
	href = href.substr(0, sub(href.length,1))
	pathnameNew = pathnameNew+((query != 'query=') ? query : '')
	if(push == true){
	    history.pushState('', 'New URL: '+href, href);
	}
    return pathnameNew;
}

function get_obj_in_form(){
	let obj = $('.js_form_search').serializeObject();
	clean(obj)
	return (obj == 'undefined') ? {} : obj
}

function clean(obj) {
	for (var propName in obj) { 
		if (obj[propName] === null || obj[propName] === undefined) {
			delete obj[propName];
		}
	}
}

function reset_all_form(_this = $('body')){
	_this.find('input').val('')
	_this.find('select').prop('selectedIndex',0)
	_this.find('.i-checks input').parent().removeClass('checked')
	_this.find('.i-checks input').iCheck('uncheck')
}

function get_obj_in_url() {
	let temp = {};
    location.search.substr(1)
        .split("&")
        .some(function(item) { // returns first occurence and stops
        	console.log(item)
        	if(item != ''){
	        	let field = item.split("=")[0];
	        	let val = item.split("=")[1];
	        	temp[field] = val
	       	}
        })
    return temp
}

function get_page_in_url() {
	let pathname = window.location.pathname;
	let array = pathname.split("/")
	let lastUrl = array.slice(-1)[0]
	let page = lastUrl.replace(".html", "");
	if(page == 'view'){page = ''}
	return page;
}

function clear_all_input(_this = $('body')){
	$(".select2 ").val(null).trigger('change')

	_this.find('input').val('')
	_this.find('textarea').val('')
	_this.find('input').prop("checked", false);
	_this.find('select').prop("checked", false);
	_this.find('.iCheck-helper').iCheck('uncheck');
	_this.find('.iCheck-helper').parent().removeClass('checked')
}

function convert_false_to($val = '' , $str = '', $round = true){
	if($val == '' || $val == null || typeof $val == 'undefined' || $val == false || isNaN($val)){
		$val = $str;
	}
	if($round == true){
		return Math.round($val);
	}
	return $val;
}
function check_val($val = '', $str = ''){
	if($val == '' || $val == null || typeof $val == 'undefined' || $val == false ){
		if($str == ''){
			return false
		}
	}
	if($str == ''){
		return true;
	}else{
		return $str;
	}
}
function is0(data){
	if(data == '' || data == null || typeof data == "undefined" ){
		data = '0';
	}
	return data;
}

function get_all_time(){
	var currentdate = new Date(); 
	let time = {}
	time.getHours = ((sub(currentdate.getHours(), 10) < 0) ? '0'+currentdate.getHours() : currentdate.getHours() )
	time.getMinutes = ((sub(currentdate.getMinutes(), 10) < 0) ? '0'+currentdate.getMinutes() : currentdate.getMinutes() )
	time.getSeconds = ((sub(currentdate.getSeconds(), 10) < 0) ? '0'+currentdate.getSeconds() : currentdate.getSeconds() )
	time.getDate = ((sub(currentdate.getDate(), 10) < 0) ? '0'+currentdate.getDate() : currentdate.getDate() )
	time.getMonth = ((sub((currentdate.getMonth() + 1), 10) < 0) ? '0'+(currentdate.getMonth() + 1) : (currentdate.getMonth() + 1) )
	time.getYear = currentdate.getFullYear()
	return time
}
$.fn.serializeObject = function() {
    var obj = {};
    var arr = this.serializeArray();
    arr.forEach(function(item, index) {
        if (obj[item.name] === undefined) { // New
            obj[item.name] = item.value || '';
        } else {                            // Existing
            if (!obj[item.name].push) {
                obj[item.name] = [obj[item.name]];
            }
            obj[item.name].push(item.value || '');
        }
    });
    return obj;
};

$(document).on('click keyup','.js_name',function(){
	ucWord($(this));
});
$(document).on('click','.js_edit',function(){	
	changeTextToInput($(this), 'js_update_info', false)
});


function gettime(time, formatString = 'DD/MM/YYYY'){
	if(time == '-'){
		return '-'
	}
	time = new Date(time)
	  var YYYY,YY,MMMM,MMM,MM,M,DDDD,DDD,DD,D,hhhh,hhh,hh,h,mm,m,ss,s,ampm,AMPM,dMod,th;
	  YY = ((YYYY= time.getFullYear())+"").slice(-2);
	  MM = (M= time.getMonth()+1)<10?('0'+M):M;
	  MMM = (MMMM=["January","February","March","April","May","June","July","August","September","October","November","December"][M-1]).substring(0,3);
	  DD = (D= time.getDate())<10?('0'+D):D;
	  DDD = (DDDD=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"][ time.getDay()]).substring(0,3);
	  th=(D>=10&&D<=20)?'th':((dMod=D%10)==1)?'st':(dMod==2)?'nd':(dMod==3)?'rd':'th';
	  formatString = formatString.replace("YYYY",YYYY).replace("YY",YY).replace("MMMM",MMMM).replace("MMM",MMM).replace("MM",MM).replace("M",M).replace("DDDD",DDDD).replace("DDD",DDD).replace("DD",DD).replace("D",D).replace("th",th);
	  h=(hhh= time.getHours());
	  if (h==0) h=24;
	  if (h>12) h-=12;
	  hh = h<10?('0'+h):h;
	  hhhh = hhh<10?('0'+hhh):hhh;
	  AMPM=(ampm=hhh<12?'am':'pm').toUpperCase();
	  mm=(m= time.getMinutes())<10?('0'+m):m;
	  ss=(s= time.getSeconds())<10?('0'+s):s;
	  return formatString.replace("hhhh",hhhh).replace("hhh",hhh).replace("hh",hh).replace("h",h).replace("mm",mm).replace("m",m).replace("ss",ss).replace("s",s).replace("ampm",ampm).replace("AMPM",AMPM);
};
function operator_time(time, val = 0, type = 'd', result = 'DD/MM/YYYY'){
	let day = time.substr(0,2) 
	let month = time.substr(3,2) 
	let year = time.substr(6,4) 
	let date = new Date(year+'-'+month+'-'+day)
	switch(type) {
	  	case 'd':
			return gettime(new Date(date.setDate(sum(date.getDate(),val))), result)
	    	break;
	  	case 'm':
			return gettime(new Date(date.setMonth(sum(date.getMonth(),val))), result)
		    break;
	    case 'y':
			return gettime(new Date(date.setYear(sum(date.getYear(),val))), result)
	    	break;
	}
}
function toObject(arr) {
  var rv = {};
  for (var i = 0; i < arr.length; ++i)
    rv[i] = arr[i];
  return rv;
}
function readCookie(name) {
    var i, c, ca, nameEQ = name + "=";
    ca = document.cookie.split(';');
    for(i=0;i < ca.length;i++) {
        c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1,c.length);
        }
        if (c.indexOf(nameEQ) == 0) {
            return c.substring(nameEQ.length,c.length);
        }
    }
    return '';
}
function timeDifference(previous, current = Date.now()) {

    var msPerMinute = 60 * 1000;
    var msPerHour = msPerMinute * 60;
    var msPerDay = msPerHour * 24;
    var msPerMonth = msPerDay * 30;
    var msPerYear = msPerDay * 365;

    var elapsed = sub(previous,current) ;
    if(elapsed < 0){
    	console.log(1)
    	var elapsedTest = sub(elapsed, 2*elapsed);
    }else{
    	elapsedTest = elapsed ;
    }

    if (elapsedTest < msPerMinute) {
         return Math.round(elapsed/1000) + ' giây';   
    }

    else if (elapsedTest < msPerHour) {
         return Math.round(elapsed/msPerMinute) + ' phút';   
    }

    else if (elapsedTest < msPerDay ) {
         return Math.round(elapsed/msPerHour ) + ' giờ';   
    }

    else if (elapsedTest < msPerMonth) {
        return Math.round(elapsed/msPerDay) + ' ngày';   
    }

    else if (elapsedTest < msPerYear) {
        return Math.round(elapsed/msPerMonth) + ' tháng';   
    }

    else {
        return Math.round(elapsed/msPerYear ) + ' năm';   
    }
}
function parseURLParams(url) {
    var queryStart = url.indexOf("?") + 1,
        queryEnd   = url.indexOf("#") + 1 || url.length + 1,
        query = url.slice(queryStart, queryEnd - 1),
        pairs = query.replace(/\+/g, " ").split("&"),
        parms = {}, i, n, v, nv;

    if (query === url || query === "") return;

    for (i = 0; i < pairs.length; i++) {
        nv = pairs[i].split("=", 2);
        n = decodeURIComponent(nv[0]);
        v = decodeURIComponent(nv[1]);

        if (!parms.hasOwnProperty(n)) parms[n] = [];
        parms[n].push(nv.length === 2 ? v : null);
    }
    return parms;
}

function js_dropdown(_this){
	let name = _this.attr('data-name')
	let module = _this.attr('data-module')
	let key = _this.attr('data-key')
	let value = _this.attr('data-value')
	let text = _this.attr('data-text')
	let query = _this.attr('data-query')
	let checked = _this.attr('data-checked')
	let data_class = _this.attr('data-class')
	let data_id = _this.attr('data-id')
	let data_type = _this.attr('data-type')
	let data_disabled = _this.attr('data-disabled')
	let limit = _this.attr('data-limit')
	
	if(typeof disabled == 'undefined' || disabled == '') { disabled = 'false' }
	if(typeof key == 'undefined' || key == '') { key = 'id' }
	if(typeof value == 'undefined' || key == '') { value = 'title' }
	if(typeof limit == 'undefined' || limit == '') { limit = 20 }
	if(typeof data_id == 'undefined') { data_id = '' }
	if(typeof data_class == 'undefined') { data_class = ''}
	pathname = 'fields='+key+','+value+'&limit='+limit

	if(typeof query == 'undefined' || query == ''){ 
		pathname = pathname+'&query=trash=0' 
	}else{
		pathname = pathname+'&query='+query+',trash=0'
	}


	$.ajax({
		type: 'GET', 
		url: 'http://api.thegioiweb.org/v1.0/'+module+'/index?'+pathname,
		crossDomain:true,
		cache: false,
		success: function(resultApi){
			let json = JSON.parse(resultApi);
			if(json.result == true){
				let list = json.data.list

				let html = ''
				if(data_type == "radio"){
					list.forEach(function(item, index, array) {
						html = html+'<div class="i-checks"><label> ';
							html = html+'<input type="radio" value='+item[key]+' name="incident[catalogueid]"> <i></i> '+item[value];
						html = html+'</label></div>';
					});
				}else{
					html = html+'<select name="'+name+'" class="form-control '+data_class+'" id="'+data_id+'">';
						if(check_val(text)){
							html = html+'<option value=>'+text+'</option>';
						}
						list.forEach(function(item, index, array) {
							if(checked == item[key]){
								html = html+'<option selected  value='+item[key]+'>'+item[value]+'</option>';
							}else{
								html = html+'<option value='+item[key]+'>'+item[value]+'</option>';
							}
						});
					html = html+'</select>';
				}
				
				

				_this.html(html)
				$('.select3NotSearch').select2({
				    minimumResultsForSearch: -1
				});
				ichecks($('.i-checks'));
				if(data_disabled == 'true'){
					_this.find('input').parent().addClass('disabled')
					_this.find('input').prop('disabled', true);
					_this.find('select').parent().addClass('disabled')
					_this.find('select').prop('disabled', true);
				}

			}

		},
		error: function(){
			toastr.error('Có lỗi sảy ra vui lòng thử lại')
		}
	});
}

function js_dropdown_vn(_this){
	let name = _this.attr('data-name')
	let module = _this.attr('data-module')
	let key = _this.attr('data-key')
	let value = _this.attr('data-value')
	let text = _this.attr('data-text')
	let query = _this.attr('data-query')
	let checked = _this.attr('data-checked')
	let data_class = _this.attr('data-class')
	let data_id = _this.attr('data-id')
	let data_type = _this.attr('data-type')
	let data_disabled = _this.attr('data-disabled')

	if(typeof disabled == 'undefined' || disabled == '') { disabled = 'false' }
	if(typeof key == 'undefined' || key == '') { key = 'id' }
	if(typeof value == 'undefined' || key == '') { value = 'title' }
	if(typeof offset == 'undefined' || offset == '') { offset = 20 }
	pathname = 'fields='+key+','+value

	if(typeof query != 'undefined'){ 
		pathname = pathname+'&query='+query
	}


	$.ajax({
		type: 'GET', 
		url: 'http://api.thegioiweb.org/v1.0/'+module+'/index?'+pathname,
		crossDomain:true,
		cache: false,
		success: function(resultApi){
			let json = JSON.parse(resultApi);
			if(json.result == true){
				let list = json.data.list

				let html = ''
				if(data_type == "radio"){
					list.forEach(function(item, index, array) {
						html = html+'<div class="i-checks"><label> ';
							html = html+'<input type="radio" value='+item[key]+' name="incident[catalogueid]"> <i></i> '+item[value];
						html = html+'</label></div>';
					});
				}else{
					html = html+'<select name="'+name+'" class="form-control select3NotSearch '+data_class+'" id="'+data_id+'">';
						html = html+'<option value=>'+text+'</option>';
						list.forEach(function(item, index, array) {
							if(checked == item[key]){
								html = html+'<option selected  value='+item[key]+'>'+item[value]+'</option>';
							}else{
								html = html+'<option value='+item[key]+'>'+item[value]+'</option>';
							}
						});
					html = html+'</select>';
				}
				
				

				_this.html(html)
				$('.select3NotSearch').select2({
				    minimumResultsForSearch: -1
				});
				ichecks($('.i-checks'));
				if(data_disabled == 'true'){
					_this.find('input').parent().addClass('disabled')
					_this.find('input').prop('disabled', true);
					_this.find('select').parent().addClass('disabled')
					_this.find('select').prop('disabled', true);
				}

			}

		},
		error: function(){
			toastr.error('Có lỗi sảy ra vui lòng thử lại')
		}
	});
}

function js_get_quantity_closing_stock(_this){
	let id = _this.attr('data-id')
	$.ajax({
		type: 'GET', 
		url: 'http://api.thegioiweb.org/v1.0/dashboard/quantity_closing_stock?id='+id,
		crossDomain:true,
		cache: false,
		success: function(resultApi){
			let json = JSON.parse(resultApi);
			if(json.result == true){
				let data = json.data
				_this.val(data.quantity_closing_stock)
			}
		},
		error: function(){
			toastr.error('Có lỗi sảy ra vui lòng thử lại')
		}
	});
}


function js_open_windown($this){
	let h = screen.availHeight;
	let w = screen.availWidth;
	window.open($this.href, 'chorme', 'top='+h*2/100+', left='+w*5/100+', width='+w*90/100+',height='+h*90/100);
	return false;
}


$(document).on('click', '.img-thumbnail', function(){
	openKCFinderAlbum($(this));
});
$(function(){
	var editor = CKEDITOR.instances['description']
	if (editor) { editor.destroy(true); }
	$('.ckeditor-description').each(function(){
		//colorbutton,
		CKEDITOR.replace( this.id, {
			height: 277,
			extraPlugins: 'youtube',
			removeButtons: '',
			entities: true,
			allowedContent: true,
			toolbarGroups: [
				{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
				{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
				{ name: 'links' },
				{ name: 'insert' },
				{ name: 'forms' },
				{ name: 'tools' },
				{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
				{ name: 'colors' },
				{ name: 'others' },
				'/',
				{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
				{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
				{ name: 'styles' }
			],
		});
	});
});

function openKCFinder(field, type) {
	window.KCFinder = {
		callBack: function(url) {
			field.value = url;
			window.KCFinder = null;
		}
	
	};
	if(typeof(type) == 'undefined'){
		type = 'images';
	}
	
	window.open(BASE_URL + 'plugin/kcfinder-3.12/browse.php?type='+type+'&dir=images/public', 'kcfinder_image',
		'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
		'resizable=1, scrollbars=0, width=1180, height=800'
	);
}



function openKCFinderMulti(button) {
	window.KCFinder = {
		callBackMultiple: function(files) {
			window.KCFinder = null;
			for (var i = 0; i < files.length; i++){
				CKEDITOR.instances['txtContent'].insertHtml('<img src="'+files[i]+'" alt="'+files[i]+'">');
				// textarea.value += files[i] + "\n";
			}
		}
	};
	window.open(BASE_URL + '/plugin/kcfinder-3.12/browse.php?type=images&dir=images/public',
		'kcfinder_multiple', 'status=0, toolbar=0, location=0, menubar=0, ' +
		'directories=0, resizable=1, scrollbars=0, width=800, height=600'
	);
}


function openKCFinderAlbum(field, type, result) {
	window.KCFinder = {
		callBack: function(url) {
			field.attr('src', url);
			field.parent().next().val(url);
			window.KCFinder = null;
		}
	};
	if(typeof(type) == 'undefined'){
		type = 'images';
	}
	window.open(BASE_URL + 'plugin/kcfinder-3.12/browse.php?type='+type+'&dir=images/public', 'kcfinder_image',
		'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
		'resizable=1, scrollbars=0, width=1080, height=800'
	);
	return false;
}


function js_search_product(_this){
	let supplierid = _this.attr('data-supplierid');
	let keyword = _this.val();
	let query = ''
	if(check_val(supplierid)){
		query = '&query=trash=0,supplier='+supplierid+',title[in]='+keyword
	}else{
		query = '&query=trash=0,keyword='+keyword
	}
	$.ajax({
		type: 'GET', 
		url: 'http://api.thegioiweb.org/v1.0/product/index?fields=product.id,product.title,product.quantity_opening_stock,product.price_input,product.price_output,product.image,product.code,product.measure'+query,
		crossDomain:true,
		cache: false,
		success: function(resultApi){
			let json = JSON.parse(resultApi);
			if(json.result == true){
				let list = json.data.list

				let html = ''
				if(list.length){
					list.forEach(function(item, index, array) {
						html = html+'<li class="p-xxs" data-info="'+item['data-info']+'">';
			    			html = html+'<div class="uk-flex uk-flex-middle uk-flex-space-between">';
			    				html = html+'<div class="uk-flex uk-flex-middle">';
			        				html = html+'<img  class="img-sm m-r" src=" '+item['image']+'" alt="ảnh">';
			        				html = html+'<div>';
			        					html = html+'<div class="title"> '+item['title'].slice(0, 50)+'</div>';
			        					html = html+'<div class="code"> '+item['code']+'</div>';
			        				html = html+'</div>';
			    				html = html+'</div>';
			    				html = html+'<div>';
			    					html = html+'<div class="uk-flex">';
			    						html = html+'<div class="m-r-xs" style="width:100px">Giá nhập: <b> '+addCommas(item['price_input'])+'<sup> đ</sup></b></div>';
			    						html = html+'<div style="width:100px">Giá bán: <b> '+addCommas(item['price_output'])+'<sup> đ</sup></b></div>';
			    					html = html+'</div>';
			    					html = html+'<div class="total_product uk-flex">';
			    						html = html+'<div class="m-r-xs" style="width:100px">Tồn cuối: <b> '+item['quantity_closing_stock']+'</b></div>';
			    						html = html+'<div style="width:100px">Tồn đầu: <b> '+item['quantity_opening_stock']+'</b></div>';
			    					html = html+'</div>';
			    				html = html+'</div>';
			    			html = html+'</div>';
			    		html = html+'</li>';
			    	});
				}else{
					html ="<li>Không có sản phẩm phù hợp</li>"
				}

				$('#list-product').html(html);
				
			}

		},
		error: function(){
			toastr.error('Có lỗi sảy ra vui lòng thử lại')
		}
	});
}

function numberOrder(id){
	let numberOrder=1;
	$(id).find('tr:not(.hidden)').each(function (){
		$(this).find('.numberOrder').html(numberOrder);
		numberOrder = numberOrder + 1;
	})
}
function pre(msg, flag = true){
    if( flag == true){
	    throw msg;
    }else{
    	console.log(msg)
    }
}
