$(document).ready(function(){
	let info = window.atob(_this.attr('data-info'));
	let json = JSON.parse(info)

	// 
	$(document).on('click','.js_extend',function(){	
		
	});
	// 
	if($('.element').length){
		$('.element').each(function(item) {
			let _this = $(this)
			let obj = {}
			obj.cataloguekey = _this.val()
			if(obj.cataloguekey == 0){
				$('.js_serviceid').find('select').remove()
				$('.js_serviceid').find('span:eq(1)').remove()
				$('.js_serviceid').append('<select name="serviceid" class="form-control" readonly="readonly"></select>')
				return false
			}
			$('.loading').show();

			$.ajax({
				type: 'GET', 
				url: 'http://api.webchuanseoht.com/v1.0/user_catalogue/usercata_list',
				crossDomain:true,
				cache: false,
				success: function(resultApi){

					let json = JSON.parse(resultApi);
					if(json.result == true){
						let list = json.data.list
						let html = ''
						if(list.length){
							list.forEach(function(item, index, array) {

							});
						}else{
							html = html+'<small class="text-danger">Không có phòng ban nào tồn tại</small>';
						}
						_this.html(html)

						$('.js_serviceid').find('select').val('')
						$('.js_serviceid').find('span:eq(1)').remove()
						$('.js_serviceid').find('select').remove()
						$('.js_serviceid').append(html)
						$('.select3NotSearch').select2();
						$('.loading').hide();
					}

				},
				error: function(){
					toastr.error('Có lỗi sảy ra vui lòng thử lại')
				}
			});
		});
// ICHECK
if(status == 1){
	$('input[name="incident[appointment]"]').parent().addClass('disabled')
	$('input[name="incident[status]"]').prop('disabled', true )

	$('input[name="incident[appointment]"]').parent().addClass('checked')
	$('input[name="incident[status]"]').prop('checked', true )
}else{
	$('input[name="incident[status]"]').parent().removeClass('disabled')
	$('input[name="incident[status]"]').prop('disabled', false )

	$('input[name="incident[catalogueid]"]').parent().removeClass('checked')
	$('input[name="incident[catalogueid]"]').prop('checked', false);
}

$("#kitten").hover(function(){
    $(this).find("img").fadeOut();

}, function() {
    $(this).find("img").fadeIn();

});

// window.location.replace
$(document).on('change','select[name="accountant_month"]',function(){
	let _this = $(this);
	let id = _this.val();
	let location = window.location.href;
	let index = location.indexOf('?');
	if(index != -1){
		location = location.substr(0, index) +'?accountant_monthId='+id
	}else{
		location = location.substr(0, location.length-5) +'?accountant_monthId='+id
	}
	window.location.replace(location);
});

// click outsite
$(document).mouseup(function(e){
    let container = $("#list-supplier li");

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        container.hide();
    }
});