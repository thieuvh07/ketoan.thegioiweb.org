<?php 
	$isSearchAdvanced = false;
	$nameArray = array('fullname', 'account', 'phone', 'email', 'date_start', 'date_end', 'userid_created', 'radio_time' );
	foreach ($nameArray as $key => $val) {
		if(!empty($this->input->get($val))){
			$isSearchAdvanced = true;
		}
	}
 ?>
<form class="user-filter js_form_search" method="get" action="">
	<div class="uk-flex uk-flex-middle uk-flex-space-between m-b-sm">
		<div class="col-lg-2 p-l-none">
			<div class="js_dropdown" data-name="periodicid" data-module="periodic" data-value="title" data-checked="<?php echo $this->input->get('periodicid') ?>"></div>
		</div>
		<div class=" col-lg-2 text-right">
			<a href="cash/backend/cash/detail?catalogueid=8" class="btn btn-success btn-sm" onclick="js_open_windown(this); return false"></i>Tìm kiếm</a>
		</div>

	</div>
</form>
