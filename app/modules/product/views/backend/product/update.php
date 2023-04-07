
<?php 
	if($this->input->post('update')){
		$catalogueid = base64_encode(json_encode($this->input->post('catalogueid'))); 
	}else{
		$catalogueid = base64_encode($moduleDetail['catalogueid']);
	}
	if($this->input->post('update')){
		$supplierid = base64_encode(json_encode($this->input->post('supplierid'))); 
	}else{
		$supplierid = base64_encode($moduleDetail['supplierid']);
	}

 ?>
<div id="page-wrapper" class="gray-bg dashbard-1 js_load_update">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/header'); ?>
	</div>
	 <div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Cập nhật sản phẩm</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Cập nhật sản phẩm</strong></li>
			</ol>
		</div>
	</div>
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="box-body">
				<?php $error = validation_errors(); echo !empty($error)?'<div class="alert alert-danger">'.$error.'</div>':'';?>
			</div><!-- /.box-body -->
		</div>
		<div class="row">
			
        	<form method="post" role="form" action="" class="form-horizontal product js_update">
        	<input type="text" class="hidden" name="id" value="<?php echo $moduleDetail['id'] ?>">	
				<div class="ibox ">
					<div class="ibox-title m-b">
						<div class="uk-flex uk-flex-middle uk-flex-space-between">
								<h5>Thông tin cơ bản <small class="text-danger">(Điền đầy đủ các thông tin được hướng dẫn dưới đây.)</small></h5>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
		                    <div class="ibox-content" style="height: 307px">
	                    		<div class="form-group">
									<label class="p-w-sm">Ảnh hiển thị</label> 
									<div class="avatar" style="cursor: pointer;">
										<img src="<?php echo (!empty($moduleDetail['image'])) ? $moduleDetail['image'] : 'template/not-found.png' ?>" class="img-thumbnail" alt="" style="width: 100%;border-radius: 0;">
									</div>
									<?php echo form_input('image', set_value('image', $moduleDetail['image'] ?? ''), 'class="form-control image hidden"  placeholder="Ảnh đại diện" onclick="openKCFinder(this)" ');?>
								</div>
		                    </div>
						</div>
			            <div class="col-sm-9" style="padding-left:0;">
			                <div class="ibox ">
			                    <div class="ibox-content m-b">
			                    	<div class="row">
		                        		<div class="col-sm-6">
		                        			<div class="form-group">
				                        	<label>Tên sản phẩm <b class="text-danger">(*)</b></label> <a data-toggle="popover" data-placement="auto top" data-content="Tên của sản phẩm không được để trống và trùng nhau" data-original-title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
	                        				<?php echo form_input('title', set_value('title',$moduleDetail['title'] ?? '') , 'class="form-control " placeholder="" autocomplete="off"');?>
				                        	</div>
		                        		</div>
		                        		<div class="col-sm-3">
		                        			<div class="form-group">
				                        		<label>Mã sản phẩm</label> 
				                        		<?php echo form_input('code', $moduleDetail['code'] ?? '', 'class="form-control " placeholder="" 
												autocomplete="off"');?>
												<?php echo form_hidden('code_original', $moduleDetail['code'] ?? '', 'class="form-control " placeholder="" 
												autocomplete="off"');?>
				                        	</div>
		                        		</div>
		                        		<div class="col-sm-3">
		                        			<div class="form-group">
				                        		<label>Đơn vị</label> 
	                        				<?php echo form_dropdown('measure',$this->configbie->data('measure'), set_value('measure',$moduleDetail['measure'] ?? ''), 'class="form-control " ');?>
				                        	</div>
				                        </div>
		                        	</div>
		                        	<div class="row">
		                        		<div class="col-sm-6">
			                        		<div class="form-group">
												<div class="uk-flex uk-flex-middle uk-flex-space-between">
													<div>
														<label>Nhóm sản phẩm </label> <a data-toggle="popover" data-placement="auto top" data-content="Nhóm sản phẩm như: hàng mới, hàng cũ" data-original-title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
													</div>
													<div><a href="" data-toggle="modal" data-target="#create_catalogueid" class="clear_modal">Thêm mới nhóm sản phẩm</a></div>
												</div>
				                        		<?php echo form_dropdown('catalogueid[]', '', NULL, 'class="form-control selectMultipe" multiple="multiple"  style="width: 100%;" data-module="product_catalogue" data-selected="'.($catalogueid ?? '').'"'); ?>
				                        	</div>
				                        </div>
				                        <div class="col-sm-6">
											<div class="form-group">
				                        		<div class="uk-flex uk-flex-middle uk-flex-space-between">
													<div>
														<label>Nhà cung cấp </label> <a data-toggle="popover" data-placement="auto top" data-content="Nhà cung cấp như: hàng mới, hàng cũ" data-original-title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
													</div>

													<div><a href="" data-toggle="modal" data-target="#create_supplier" class="clear_modal">Thêm mới nhà cung cấp</a></div>
												</div> 
												<?php echo form_dropdown('supplierid[]', '', NULL, 'class="form-control selectMultipe" multiple="multiple"  style="width: 100%;" data-module="supplier" data-selected="'.($supplierid ?? '').'"'); ?>
				                        	</div>
				                        </div>
				                    </div>
	                        		<div class="row">
	                        			<div class="col-sm-6">
	                        				<div class="form-group">
	                        					<label>Tồn đầu kì</label> <a data-toggle="popover" data-placement="auto top" data-content="Số lượng sản phẩm hiện có sẵn ở kho tại thời điểm bạn làm dữ liệu." data-original-title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
												<?php 
					                        		$quantity_opening_stock = array(
					                        			'name'=>'quantity_opening_stock',
														'class'=> 'form-control',
														'type' => '',
													);
													echo form_input($quantity_opening_stock, set_value('quantity_opening_stock', $moduleDetail['quantity_opening_stock'] ?? ''));
												?>
											</div>
	                        			</div>
	                        		</div>
	                        		
		                        	<div class="form-group">
		                        		<div class="row">
			                        		<div class="col-sm-6">
			                        			<label>Giá bán</label> <a data-toggle="popover" data-placement="auto top" data-content="Đây là giá mà bạn sẽ bán sản phẩm này cho những khách hàng đơn lẻ." data-original-title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
				                        		<div class="input-group">
							                        <span class="input-group-addon">đ</span>
							                        <?php 
						                        		$price_output = array(
						                        			'name'=>'price_output',
															'class'=> 'form-control int',
															);
														echo form_input($price_output, set_value('price_output', addCommas($moduleDetail['price_output'] ?? 0)),'autocomplete="off"');
													?>
						                        </div>
			                        		</div>
			                        		<div class="col-sm-6">
			                        			<label>Giá nhập</label> <a data-toggle="popover" data-placement="auto top" data-content="Đây là giá mà bạn sẽ bán nhập sản phẩm này." data-original-title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
				                        		<div class="input-group">
							                        <span class="input-group-addon">đ</span>
					                        		<?php 
						                        		$price_input = array(
						                        			'name'=>'price_input',
															'class'=> 'form-control int',
															);
														echo form_input($price_input, set_value('price_input', addCommas($moduleDetail['price_input']?? 0)),'autocomplete="off"');
													?>
						                        </div>
			                        		</div>
			                        	</div>
		                        	</div>
								</div>
			                </div>
			            </div>
			        </div>
		           	<div class="ibox-title">
						<div class="uk-flex uk-flex-middle uk-flex-space-between">
							<div></div>
							<div class="uk-button">
								<button style="margin-right:2px;" class="btn btn-primary btn-sm" name="update" value="update" type="submit">Cập nhất sản phẩm</button>
								<!-- <button class="btn btn-sm btn-warning" type="reset">Làm mới</button> -->
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php $this->load->view('dashboard/backend/common/footer'); ?>
</div>
<div class="modal inmodal fade" id="create_catalogueid" tabindex="-1" role="dialog"  aria-hidden="true">
	<form class="" method="" action="" id="form_create_catalogueid" >
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Cập nhật nhóm sản phẩm</h4>
					<small class="font-bold text-danger">Cập nhật đầy đủ thông tin người dùng giúp việc quản lý dễ dàng hơn</small>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<div class="row">
							<div class="box-body error hidden">
								<div class="alert alert-danger"></div>
							</div><!-- /.box-body -->
						</div>
						<div class="row">
							<label class="col-md-4">
								<div class=" control-label">
									<span class="m-r">Tên nhóm sản phẩm <b class="text-danger">(*)</b></span>
									 <a data-toggle="popover" data-placement="auto top" data-content="Tên nhóm sản phẩm" data-original-title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
								</div>
							</label>
							<div class="col-md-8">
								<?php echo form_input('title', set_value('title'), 'class="form-control " id="title_catalogueid" placeholder="" autocomplete="off"');?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="col-md-4">
								<div class=" control-label">
									<span class="m-r">Mô tả</span>
									 <a data-toggle="popover" data-placement="auto top" data-content="Mô tả ngắn gọn về sản phẩm 255 kí tự" data-original-title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
								</div>
							</label>
							<div class="col-md-8">
								<?php echo form_input('description', set_value('description'), 'class="form-control " placeholder="" autocomplete="off"');?>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Thêm mới</button>
				</div>
			</div>
		</div>
	</form>
</div>
<div class="modal inmodal fade" id="create_supplier" tabindex="-1" role="dialog"  aria-hidden="true">
	<form class="" method="" action="" id="form_create_supplier" >
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Thêm mới nhà cung cấp</h4>
					<small class="font-bold text-danger">Cập nhật đầy đủ thông tin người dùng giúp việc quản lý dễ dàng hơn</small>
				</div>
				<div class="modal-body p-md">
					<div class="row">
						<div class="box-body error hidden">
							<div class="alert alert-danger"></div>
						</div><!-- /.box-body -->
					</div>
					<div class="form-group">
						<div class="row">
						<label class="col-md-4">
							<div class=" control-label">
								<span class="m-r">Tên nhà cung cấp <b class="text-danger">(*)</b></span>
								 <a data-toggle="popover" data-placement="auto top" data-content="Tên doanh nghiệp, tổ chức .. giao dịch với cửa hàng." data-original-title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
							</div>
						</label>
						<div class="col-md-8">
							<?php echo form_input('title', set_value('title'), 'class="form-control " placeholder=""  id="title_supplier"  autocomplete="off"');?>
						</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
						<label class="col-md-4">
							<div class=" control-label">
								<span class="m-r">Mã nhà cung cấp </span>
								 <a data-toggle="popover" data-placement="auto top" data-content="Mã nhà cung cấp sẽ sử dụng để tìm kiếm" data-original-title="" title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
							</div>
						</label>
						<div class="col-md-8">
							<?php echo form_input('code', set_value('code'), 'class="form-control not_clear" id="code_supplier" data-module="supplier" placeholder="" autocomplete="off" readonly');?>
						</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
						<label class="col-md-4">
							<div class=" control-label">
								<span class="m-r">Địa chỉ </span>
								 <a data-toggle="popover" data-placement="auto top" data-content="Địa chỉ nhà cung cấp sẽ sử dụng để chưa hàng" data-original-title="" title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
							</div>
						</label>
						<div class="col-md-8">
							<?php echo form_input('address', set_value('address'), 'class="form-control "  id="address_supplier"  placeholder="" autocomplete="off"');?>
						</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
						<label class="col-md-4">
							<div class=" control-label">
								<span class="m-r">Số điện thoại </span>
								 <a data-toggle="popover" data-placement="auto top" data-content="Số điện thoại của nhà cung cấp dùng để liên hệ khi đặt hàng hoặc giao dịch." data-original-title="" title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
							</div>
						</label>
						<div class="col-md-8">
							<?php echo form_input('phone', set_value('phone'), 'class="form-control " placeholder="" autocomplete="off"');?>
						</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="row">
						<label class="col-md-4">
							<div class=" control-label">
								<span class="m-r">Email</span>
								 <a data-toggle="popover" data-placement="auto top" data-content="Email của nhà cung cấp dùng để liên hệ khi đặt hàng hoặc giao dịch." data-original-title="" title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
							</div>
						</label>
						<div class="col-md-8">
							<?php echo form_input('email', set_value('email'), 'class="form-control " placeholder="" autocomplete="off"');?>
						</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="row">
						<label class="col-md-4">
							<div class=" control-label">
								<span class="m-r">Website</span>
								 <a data-toggle="popover" data-placement="auto top" data-content="Website hoạt động của nhà cung cấp có thể có." data-original-title="" title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
							</div>
						</label>
						<div class="col-md-8">
							<?php echo form_input('website', set_value('website'), 'class="form-control " placeholder="" autocomplete="off"');?>
						</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="row">
						<label class="col-md-4">
							<div class=" control-label">
								<span class="m-r">Tài khoản ngân hàng</span>
								 <a data-toggle="popover" data-placement="auto top" data-content="Cung cấp số tài khoản để giao dịch" data-original-title="" title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
							</div>
						</label>
						<div class="col-md-8">
							<?php echo form_textarea('bank', set_value('bank'), 'class="form-control " style="height:70px" placeholder="" autocomplete="off"');?>
						</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="row">
						<label class="col-md-4">
							<div class=" control-label">
								<span class="m-r">Số fax </span>
								 <a data-toggle="popover" data-placement="auto top" data-content="Số fax để liên lạc với nhà cung cấp." data-original-title="" title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
							</div>
						</label>
						<div class="col-md-8">
							<?php echo form_input('fax', set_value('fax'), 'class="form-control " placeholder="" autocomplete="off"');?>
						</div>
						</div>
					</div>
					<div class="form-group m-b-none">
						<div class="row">
						<label class="col-md-4">
							<div class=" control-label">
								<span class="m-r">Mã số thuế</span>
								 <a data-toggle="popover" data-placement="auto top" data-content="Mã số thuế có thể được sử dụng trong các hoạt động thanh toán trực tuyến hoặc các giao dịch quan trọng." data-original-title="" title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
							</div>
						</label>
						<div class="col-md-8">
							<?php echo form_input('mst', set_value('mst'), 'class="form-control " placeholder="" autocomplete="off"');?>
						</div>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Thêm mới</button>
				</div>
			</div>
		</div>
	</form>
</div>
