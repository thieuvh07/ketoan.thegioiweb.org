<form method="post" role="form" action="" id="form_main" class="form-horizontal js_update js_load_update">	
	<input type="text" name="id" value="<?php echo $moduleDetail['id'] ?>" class="hidden">
<div id="page-wrapper" class="gray-bg dashbard-1">
	
	<div class="wrapper animated fadeInRight font-size-11 mytable">
		<div class="row">
            <div class="col-sm-12" style="padding-left:0;padding-right:0;">
                <div class="ibox">
					<div class="ibox-title uk-flex uk-flex-middle uk-flex-space-between">
						<h3>Cập nhật đơn hàng
							<small class="text-danger">(Điền đầy đủ các thông tin được hướng dẫn dưới đây.)</small>
						</h3>
						<div class="uk-button">
							<button style="margin-right:2px;" class="btn btn-primary btn-sm" name="update" value="update" type="submit">Cập nhật đơn hàng</button>
						</div>
					</div>
					<div class="ibox-content">
						<div class="box-body">
							<?php $error = validation_errors(); echo !empty($error)?'<div class="alert alert-danger">'.$error.'</div>':'';?>
						</div><!-- /.box-body -->
						<div class="row m-b-xs">	
							<div class="col-md-3">
								<div class="input-group width-100">
	                                <?php echo form_input('fullname',set_value('fullname', $moduleDetail['fullname'] ?? ''), 'class="form-control" autocomplete="off" ');?>
	                            </div>
							</div>
							<div class="col-md-3">
								<div class="input-group width-100 icon-left">
									<i class="fa fa-phone" aria-hidden="true"></i>
	                                <?php echo form_input('phone', set_value('phone', $moduleDetail['phone'] ?? ''), 'class="form-control" placeholder="Sđt khách hàng"  autocomplete="off"');?>
	                            </div>
							</div>
							<div class="col-md-3">
								<div class="input-group width-100">
									<div class="js_dropdown" data-name="catalogueid" data-module="construction_catalogue" data-checked="<?php echo $moduleDetail['catalogueid'] ?? '' ?>" data-query="id!=3" data-value="title"></div>
	                            </div>
							</div>
							
							<div class="col-md-3 hidden">
								<div class="input-group width-100">
	                                <?php echo form_input('code',set_value('code', $moduleDetail['code'] ?? '') , 'class="form-control" id="code" autocomplete="off" placeholder="Mã đơn hàng" readonly');?>
	                            </div>
							</div>
						</div>
						<div class="row m-b-xs">
							<div class="col-md-3">
								<div class="input-group width-100 icon-left">
									<i class="fa fa-search"></i>
	                                <?php echo form_input('product', '', 'class="form-control js_search_product" autocomplete="off" placeholder="Chọn sản phẩm"');?>
	                                <ul id="list-product">
	                                </ul>
	                            </div>
							</div>
							<div class="col-md-3">
								<div class="js_dropdown" data-name="userid_charge" data-module="user" data-text="Chọn nhân viên" data-value="fullname" data-checked="<?php echo $moduleDetail['userid_charge'] ?? '' ?>"></div>
							</div>
							<div class="col-md-3">
								<div class="js_dropdown" data-name="type_business" data-module="type_business" data-value="title" data-checked="<?php echo $moduleDetail['type_business'] ?? '' ?>"></div>

							</div>
							<div class="col-md-3">
								<div class="input-group width-100">
	                                <?php echo form_input('date_start',set_value('date_start', gettime($moduleDetail['date_start'] ?? '', 'd-m-Y')), 'class="form-control datetimepicker" placeholder="Chọn ngày khởi công"  autocomplete="off" ');?>
	                            </div>
							</div>
						</div>
						<div style="min-height: 290px! important">
                        	<table class="table">
	                            <thead>
		                            <tr class="">
		                                <th class="text-center">STT</th>
		                                <th>Mã SP</th>
		                                <th style="width:400px">Tên SP</th>
		                                <th>Đơn vị</th>
		                                <th class="text-right">SL</th>
		                                <th class="text-right">Đơn giá</th>
		                                <th></th>
		                            </tr>
	                            </thead>
	                            <tbody class="js_content">
		                            <?php if(isset($moduleDetail['data_json']) && is_array($moduleDetail['data_json']) && count($moduleDetail['data_json'])) { ?>
	                            	<?php foreach($moduleDetail['data_json'] as $key => $val){ ?>
		                            <tr>
		                            	<?php 
			                                $measure=$this->configbie->data('measure', (int)$val['measure']);
		                                 ?>
								        <td class="text-center"><?php 	echo $key+1 ?></td>
								        <td class="code"><?php echo $val['code'] ?? '' ?>
								        	<input type="text" name="product[code][]" value="<?php echo $val['code'] ?? '' ?>" class="hidden">
								        	

								        </td>
								        <td class="title"><?php echo cutnchar($val['title'] ?? '',100) ?> 
								        	<input type="text" name="product[id][]" value="<?php echo $val['id'] ?? '' ?>" class="hidden">
								        	<input type="text" name="product[title][]" value="<?php echo $val['title'] ?? '' ?>" class="hidden">
								        	<?php echo form_input('product[quantity_closing_stock][]',0 , 'data-id="'.($val['id'] ?? '').'" class="form-control hidden js_get_quantity_closing_stock"');?>
								       		<?php echo form_input('product[quantity_old][]',(isset($val['quantity'])) ? $val['quantity'] : 0, 'class="form-control hidden"');?>
								        </td>
								        <td >
								        	<?php echo $val['measure'] ?? ''  ?>
								        	<input type="text" name="product[measure][]" value="<?php echo $val['measure'] ?? 0 ?>" class="hidden">
								        </td>
								        <td class="text-right">
								        	<input type="text" name="product[quantity][]" value="<?php echo $val['quantity'] ?? 0 ?>" class="float text-right form-control">
								        </td>
								        <td class="price">
								       		<div class="input-group pull-right">
								        		<input type="text" name="product[price_output][]" style="height: 25px" value="<?php echo addCommas($val['price_output'] ?? 0) ?>" class="int text-right form-control">
								        	</div>
								        </td>
								        <td class="trash text-danger js_del" style="width:20px;"></td>
								    </tr>
									<?php }} ?>
	                            </tbody>
	                        </table>
                        </div>
                    </div>
                    <div class="ibox-title	">
                    	<div class="row">
                    		<div class="col-md-6">
                    			<?php echo form_textarea('note', set_value('note', $moduleDetail['note'] ?? ''), 'class="form-control m-b-xs" placeholder="Ghi chú đơn hàng" style="height: 70px"  ');?>
                    		</div>
                    		<div class="col-md-6">
                    			<div class="pull-right">
                    				<div class="m-b uk-flex uk-flex-middle uk-flex-space-between">
                    					<div>Tổng tiền đơn hàng: </div>
                    					<span class="total_money" style="margin-right:13px;"></span> </div>
                    				<!-- <div class="input-group m-b-sm">
						        		Tổng thu: <input type="text" name="sales_real" autocomplete="off"  value="<?php echo addCommas($moduleDetail['sales_real'] ?? '') ?>" class="text-right form-control int">
						        	</div> -->

						        	<!-- <div class="input-group m-b-sm">
						        		Doanh số: <input type="text" autocomplete="off" name="doanh_so_thuc" value="<?php echo number_format($detailConstruction['doanh_so_thuc'],0,',','.') ?>" class="text-right form-control int">
						        	</div> -->
						        	
									<div class="uk-button">
										<button style="margin-right:2px;" class="btn btn-primary btn-sm" name="update" value="update" type="submit">Cập nhật đơn hàng</button>
									</div>
								</div>
                    		</div>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
</form>
<div class="modal inmodal fade" id="update_customer" tabindex="-1" role="dialog"  aria-hidden="true">
	<form class="" method="POST" action="" id="form_update_customer" >
		<div class="modal-dialog ">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Thông tin khách hàng</h4>
				</div>
				<div class="modal-body">
					<div class="box-body">
						<div class="alert alert-danger error hidden"></div>
					</div><!-- /.box-body -->
					<div class="form-group  clearfix">
						<label class="col-md-4 control-label text-left">
							<div class="uk-flex uk-flex-middle uk-flex-space-between">
								<span>Họ tên <b class="text-danger">(*)</b></span>
								<a data-toggle="popover" data-placement="auto top" data-content="Họ tên đầy đủ của khách hàng" data-original-title="" title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
							</div>
						</label>
						<div class="col-md-8">
							<?php echo form_input('fullname', set_value('fullname'), 'class="form-control " id="fullname" placeholder="Nguyễn Văn A" autocomplete="off"');?>
						</div>
					</div>
					<div class="form-group clearfix">
						<label class="col-md-4 control-label text-left">
							<div class="uk-flex uk-flex-middle uk-flex-space-between">
								<span>Số điện thoại </span>
								<a data-toggle="popover" data-placement="auto top" data-content="Số điện thoại của khách hàng" data-original-title="" title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
							</div>
						</label>
						<div class="col-md-8">
							<?php $phone = array(
								'name'=> 'phone',
								'type'=> 'number',
								'value'=> set_value('phone'),
								'class'=>'form-control',
								'placeholder'=>'034 970 1998',
								'autocomplete'=>'off',
							) ?>
							<?php echo form_input($phone);?>
						</div>
					</div>
					<div class="form-group clearfix">
						<label class="col-md-4 control-label text-left">
							<div class="uk-flex uk-flex-middle uk-flex-space-between">
								<span>Email </span>
								<a data-toggle="popover" data-placement="auto top" data-content="Email của khách hàng" data-original-title="" title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
							</div>
						</label>
						<div class="col-md-8">
							<?php echo form_input('email', set_value('email'), 'class="form-control " placeholder="nguyenhanh@gmail.com" autocomplete="off"');?>
						</div>
					</div>
					<div class="form-group clearfix">
						<label class="col-md-4 control-label text-left">
							<div class="uk-flex uk-flex-middle uk-flex-space-between">
								<span>Địa chỉ</span>
								<a data-toggle="popover" data-placement="auto top" data-content="Địa chỉ khách hàng" data-original-title="" title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
							</div>
						</label>
						<div class="col-md-8">
							<?php echo form_input('address', set_value('address'), 'class="form-control" placeholder="số 10 Quan Hoa" autocomplete="off"');?>
						</div>
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" name= "update-customer" >Khởi Cập nhật khách hàng</button>
					<input type="reset" class="reset_form" style = "display: none">
				</div>
			</div>
		</div>
	</form>
</div>
