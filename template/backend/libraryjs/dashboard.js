

if($('.js_load_view').length){
	check_permission('dashboard/home/statistical')	
}

var module = 'dashboard'
var urlModule = 'http://api.thegioiweb.org/v1.0/dashboard'
var fields = ''




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
					let time = json.data
					console.log(time)
					$('#morris-bar-chart').html('')
					Morris.Bar({
				        element: 'morris-bar-chart',
				        data:time,
				        xkey: 'day',
				        ykeys: ['gross_revenue_real', 'profit_real'],
				        labels: ['Doanh thu', 'Lợi nhuận'],
				        hideHover: false,
				        resize: true,
				        barColors: ['#1ab394', '#cacaca'],
				    });


				}
			},
			error: function(resultApi){
				let json = JSON.parse(resultApi);
				toastr.error(json.message)
				del_loading_view($('.js_content'))
			}
		});
	},10);
}
