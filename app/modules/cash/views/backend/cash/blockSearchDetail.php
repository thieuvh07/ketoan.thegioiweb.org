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
			<div class="js_dropdown" data-name="periodicid" readonly data-module="periodic" data-value="title" data-checked="<?php echo $this->input->get('periodicid') ?>"></div>
		</div>
		<div class="col-sm-2">
			<div class="js_dropdown" data-text="chọn danh mục" data-name="catalogueid" data-module="cash_catalogue" data-value="title" data-checked="<?php echo $this->input->get('catalogueid') ?>"></div>
		</div>
		<div class="col-sm-2">
			<?php echo form_input('date_start', set_value('date_start',$this->input->get('date_start')), 'class="form-control "  data-mask="99/99/9999" placeholder="dd/mm/Y" autocomplete="off"');?>
		</div>
		<div class="col-sm-2">
			<?php echo form_input('date_end', set_value('date_end',$this->input->get('date_end')), 'class="form-control "  data-mask="99/99/9999" placeholder="dd/mm/Y" autocomplete="off"');?>
		</div>
		<div class=" col-lg-2 p-r-none">
			<input type="search" name="keyword"  class="js_keyword form-control input-sm m-r" placeholder="Nhập từ khóa tìm kiếm mọi thứ..." value="<?php echo $this->input->get('keyword'); ?>" >
		</div>

		<div class=" col-lg-2 text-right">
			<div class="btn btn-success js_search" style="margin-bottom: 0px">Tìm kiếm</div>
		</div>
	</div>
</form>
