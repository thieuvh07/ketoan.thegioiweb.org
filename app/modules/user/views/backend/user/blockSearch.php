<?php 
	$isSearchAdvanced = false;
	$nameArray = array('catalogue', 'date_start', 'date_end', 'userid_created', 'radio_time' );
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
				<?php echo form_dropdown('perpage', $this->configbie->data('perpage'), set_value('perpage',$this->input->get('perpage')) ,'class="form-control height-32 js_perpage m-r" data-url="'.site_url('customer/backend/customer/view').'"'); ?>
			</div>
			<div class="col-sm-6 p-r-none">
				<?php echo form_dropdown('order_by', $this->configbie->data('order_by_user'), set_value('order_by',$this->input->get('order_by')) ,'class="form-control height-32"  '); ?>
			</div>

		</div>

		<div class="col-sm-3">
			<input type="search" name="keyword"  class="js_keyword form-control input-sm m-r" placeholder="Nhập từ khóa tìm kiếm mọi thứ..." value="<?php echo $this->input->get('keyword'); ?>" >
		</div>

		<div class="col-sm-3">
			<div class="btn btn-success js_search" style="margin-bottom: 0px">Tìm kiếm</div>
		</div>

		<div class=" col-lg-3 p-r-none text-right ">
			<div class="uk-button">
				<a href="<?php echo site_url('user/backend/user/create') ?>" class="btn btn-danger btn-sm"><i class="fa fa-plus"></i> Thêm Nhân sự</a>
			</div>
		</div>
	</div>
	<div class="m-b-sm">
		<a class="text-success js_extend font-size-13" data-extend="Tìm kiếm nâng cao"><u><?php echo (isset($isSearchAdvanced) && $isSearchAdvanced == true) ? 'Thu gọn' : 'Tìm kiếm nâng cao' ?></u></a>
	</div>
	<div class="js_extend_target" style="display: <?php echo (isset($isSearchAdvanced) && $isSearchAdvanced == true) ? 'block' : 'none' ?>">

		<div class="uk-flex uk-flex-middle uk-flex-space-between m-b-sm" >
			<div class="col-sm-3 p-l-none">
				Nhóm nhân sự
				<div class="js_dropdown" data-name="catalogue" data-module="user_catalogue" data-text="Chọn nhóm nhân sự"></div>
			</div>
			<div class="col-sm-3">
				<label for="">Từ ngày</label>
				<?php echo form_input('date_start', set_value('date_start',$this->input->get('date_start')), 'class="form-control "  data-mask="99/99/9999" placeholder="dd/mm/Y" autocomplete="off"');?>
			</div>
			<div class="col-sm-3">
				<label for="">Đến ngày</label>
				<?php echo form_input('date_end', set_value('date_end',$this->input->get('date_end')), 'class="form-control "  data-mask="99/99/9999" placeholder="dd/mm/Y" autocomplete="off"');?>
			</div>
			<?php
				if(in_array('ban-giam-doc', $this->auth['slugCata'] ?? [])){

			?>
				<div class="col-sm-3 p-r-none">
					<label for="">Chọn người khởi tạo</label>
					<div class="js_dropdown" data-name="userid_created" data-module="user" data-text="Chọn người khởi tạo" data-value="fullname"></div>
				</div>
				


			<?php }else{ ?>
				<div class="col-sm-3 p-r-none"> </div>

			<?php } ?>


		</div>

		<div class="uk-flex uk-flex-middle uk-flex-space-between m-b-sm" >
			<?php  ?>
			<div class="col-sm-3  p-l-none">
				Chọn lọc theo thời gian
			</div>
			<div class="col-sm-3">
				<div class="col-sm-6">
					<div class="i-checks">
						<label>
						<?php  echo form_radio(array(
								'name' => 'radio_time',
								'value' => 'time_all',
								'class' => 'filter',
								'checked' => ($this->input->get('radio_time') =='time_all' ) ? true : '',
							));
						?>
						Tất cả
						</label>
					</div>
				</div>
				<div class="col-sm-6">
                    <div class="i-checks">
                    	<label>
                    	<?php  echo form_radio(array(
								'name' => 'radio_time',
								'value' => 'time_day',
								'class' => 'filter',
								'checked' => ($this->input->get('radio_time') =='time_day' ) ? true : '',
							));
						?>
						Trong ngày
						</label>

                    </div>
                </div>
            </div>

			<div class="col-sm-3" >
				<div class="col-sm-6">
					<div class="i-checks">
						<label>
						<?php  echo form_radio(array(
								'name' => 'radio_time',
								'value' => 'time_week',
								'class' => 'filter',
								'checked' => ($this->input->get('radio_time') =='time_week' ) ? true : '',
							));
						?>
						Trong tuần
						</label>
					</div>
				</div>
				<div class="col-sm-6">
                    <div class="i-checks">
                    	<label>
                    	<?php  echo form_radio(array(
								'name' => 'radio_time',
								'value' => 'time_month',
								'class' => 'filter',
								'checked' => ($this->input->get('radio_time') =='time_month' ) ? true : '',
							));
						?>
						Trong tháng
						</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 text-right" >
            </div>
        </div>
	</div>
</form>
