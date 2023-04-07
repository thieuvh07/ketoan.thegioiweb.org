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
		<div class="col-lg-3 p-l-none">
    		<div class="col-sm-6 p-l-none">
    			<div>
    				<div class="js_dropdown" data-name="periodicid" data-module="periodic" data-key="id" data-value="title"></div>
            	</div>
    		</div>
			<div class="col-sm-6 p-r-none">
				<?php echo form_dropdown('order_by', $this->configbie->data('order_by_product'), set_value('order_by',$this->input->get('order_by')) ,'class="form-control height-32"  '); ?>
			</div>
		</div>

		<div class="col-sm-3">
			<input type="search" name="keyword"  class="js_keyword form-control input-sm m-
			r" placeholder="Nhập từ khóa tìm kiếm mọi thứ..." value="<?php echo $this->input->get('keyword'); ?>" >
		</div>

		<div class="col-sm-3">
			<div class="btn btn-success js_search" style="margin-bottom: 0px">Tìm kiếm</div>
		</div>

		<div class=" col-lg-3 p-r-none">
			
		</div>
	</div>
	<div class="uk-flex uk-flex-middle uk-flex-space-between m-b-sm" >
		<div class="col-sm-3 p-l-none">
			<label for="">Từ ngày</label>
			<?php echo form_input('date_start', set_value('date_start',$this->input->get('date_start')), 'class="form-control "  data-mask="99/99/9999" placeholder="dd/mm/Y" autocomplete="off"');?>
		</div>
		<div class="col-sm-3">
			<label for="">Đến ngày</label>
			<?php echo form_input('date_end', set_value('date_end',$this->input->get('date_end')), 'class="form-control "  data-mask="99/99/9999" placeholder="dd/mm/Y" autocomplete="off"');?>
		</div>
		<div class="col-sm-3">
			<label for="">Loại SP</label>
			<div class="js_dropdown" data-name="catalogue" data-checked="<?php echo $this->input->get('catalogue') ?>" data-limit=100 data-module="product_catalogue" data-text="Chọn Loại SP" data-value="title"></div>
		</div>
		<div class="col-sm-3">
			<label for="">Nhà cung cấp</label>
			<div class="js_dropdown" data-name="supplier" data-checked="<?php echo $this->input->get('supplier') ?>" data-module="supplier" data-text="Chọn NCC" data-value="title"></div>
		</div>
	</div>

	
</form>
