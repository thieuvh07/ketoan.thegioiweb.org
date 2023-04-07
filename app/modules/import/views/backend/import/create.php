<form method="post" role="form" action="" class="form-horizontal js_create js_load_create">	
<div id="page-wrapper" class="gray-bg dashbard-1">
	<div class="wrapper animated fadeInRight import">
		<div class="row">
            <div class="col-sm-12" style="padding-left:0;padding-right:0;">
            	
                <div class="ibox">
					<div class="ibox-title">
						<h3>Tạo đơn nhập hàng
							<small class="text-danger">(Điền đầy đủ các thông tin được hướng dẫn dưới đây.)</small>
						</h3>
					</div>
					<div class="ibox-content">
						<div class="box-body">
							<?php $error = validation_errors(); echo !empty($error)?'<div class="alert alert-danger">'.$error.'</div>':'';?>
						</div><!-- /.box-body -->
						<div class="row m-b-xs">
							<div class="col-md-3">
								<div class="input-group icon-left">
									<div class="js_dropdown" data-name="supplierid" data-module="supplier" data-text="Chọn NCC" data-value="title" ></div>
	                            </div>
							</div>
							<div class="col-md-3">
								<div class="input-group icon-left">
									<i class="fa fa-search"></i>
	                                <?php echo form_input('product', '', 'class="form-control js_search_product" autocomplete="off" placeholder="Chọn sản phẩm"');?>
	                                <ul id="list-product">
	                                </ul>
	                            </div>
							</div>
							<div class="col-md-3">
								<div class="input-group">
	                               <?php echo form_input('code', $moduleDetail['code'], 'class="form-control " placeholder="Mã đơn nhập hàng" autocomplete="off" readonly');?>
	                            </div>
	                        </div>
							<div class="col-md-3">
								<div class="input-group width-100">
	                                <?php echo form_input('date_start',set_value('date_start', gettime($moduleDetail['date_start'] ?? gettime($this->currentTime, 'd-m-Y'), 'd-m-Y')), 'class="form-control datetimepicker" placeholder="Chọn ngày khởi công"  autocomplete="off" ');?>
	                            </div>
							</div>
						</div>
						<div style="min-height: 290px! important">
                        	<table class="table" >
	                            <thead>
		                            <tr class="">
		                                <th style="width:70px">Mã SP</th>
		                                <th>Tên SP</th>
		                                <th style="width:70px">SL nhập</th>
		                                <th style="width:70px">Đơn vị nhập</th>
		                                <th style="width:70px">SL quy đổi</th>
		                                <th style="width:70px">Đơn vị bán</th>
		                                <th style="width:100px">Giá nhập</th>
		                                <th style="width:100px">Thành tiền</th>
		                                <th style="width:20px"></th>
		                            </tr>
	                            </thead>
	                            <tbody class="js_content">
		                            
	                            </tbody>
	                        </table>
                        </div>
                    </div>
                    <div class="ibox-title	">
                    	<div class="row">
                    		<div class="col-md-6">
                    			<?php echo form_textarea('note', set_value('note'), 'class="form-control m-b-xs" placeholder="Ghi chú đơn nhập" style="height: 70px"  ');?>
                    		</div>
                    		<div class="col-md-6">
                    			<div class="uk-flex uk-flex-space-between font-bold">
                    				<span>Thành tiền</span>
                    				<span class="total_money">0</span>
                    			</div>
                    		</div>
                    	</div>
                    </div>
                    <div class="ibox-title">
						<div class="uk-flex uk-flex-middle uk-flex-space-between">
							<div class="uk-flex uk-flex-middle">
								
							</div>
							<div class="uk-button">
								<button style="margin-right:2px;" class="btn btn-primary btn-sm" name="create" value="create" type="submit">Tạo đơn</button>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
	</div>
</div>
</form>

