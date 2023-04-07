
<?php 
	if($this->input->post('create')){
		$catalogueid = base64_encode(json_encode($this->input->post('catalogueid'))); 
	}else{
		$catalogueid = base64_encode($moduleDetail['catalogueid'] ?? '');
	}
	if($this->input->post('create')){
		$supplierid = base64_encode(json_encode($this->input->post('supplierid'))); 
	}else{
		$supplierid = base64_encode($moduleDetail['supplierid'] ?? '');
	}

 ?>
<div id="page-wrapper" class="gray-bg dashbard-1 js_load_create_multi">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/header'); ?>
	</div>
	 <div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Thêm mới sản phẩm</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Thêm mới sản phẩm</strong></li>
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
			
        	<form method="post" role="form" action="" class="form-horizontal product js_create_multi">	
				<div class="ibox ">
					<div class="ibox-title m-b">
						<div class="uk-flex uk-flex-middle uk-flex-space-between">
								<h5>Thông tin cơ bản <small class="text-danger">(Điền đầy đủ các thông tin được hướng dẫn dưới đây.)</small></h5>
								<div class="uk-button">
									<button style="margin-right:2px;" class="btn btn-primary btn-sm" name="create" value="create" type="submit">Khởi tạo sản phẩm mới</button>
									<!-- <button class="btn btn-sm btn-warning" type="reset">Làm mới</button> -->
								</div>
						</div>
					</div>
                    <div class="ibox-content m-b">
                    	<div class="row">
                    		<div class="col-sm-6">
                        		<div class="form-group">
									<div class="uk-flex uk-flex-middle uk-flex-space-between">
										<div>
											<label>Nhóm sản phẩm </label> <a data-toggle="popover" data-placement="auto top" data-content="Nhóm sản phẩm như: hàng mới, hàng cũ" data-original-title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
										</div>
										<div><a href="" data-toggle="modal" data-target="#create_catalogueid">Thêm mới nhóm sản phẩm</a></div>
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
										<div><a href="" data-toggle="modal" data-target="#create_supplier">Thêm mới nhà cung cấp</a></div>
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
											'type' => 'number',
										);
										echo form_input($quantity_opening_stock, set_value('quantity_opening_stock'));
									?>
								</div>
                			</div>
                			
                		</div>
                    	<div class="form-group">
                    		<div class="row">
                        		<div class="col-sm-6">
                        			<label>Giá bán</label> <a data-toggle="popover" data-placement="auto top" data-content="Đây là giá mà bạn sẽ bán sản phẩm này cho những khách hàng đơn lẻ." data-original-title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
	                        		<div class="input-group">
				                        <?php 
			                        		$price_output = array(
			                        			'name'=>'price_output',
												'class'=> 'form-control int',
												'placeholder'=> '0'
												);
											echo form_input($price_output, set_value('price_output'),'autocomplete="off"');
										?>
				                        <span class="input-group-addon">đ</span>
			                        </div>
                        		</div>
                        		<div class="col-sm-6">
                        			<label>Giá nhập</label> <a data-toggle="popover" data-placement="auto top" data-content="Đây là giá mà bạn sẽ bán nhập sản phẩm này." data-original-title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
	                        		<div class="input-group">
		                        		<?php 
			                        		$price_input = array(
			                        			'name'=>'price_input',
												'class'=> 'form-control int',
												'placeholder'=> '0'
												);
											echo form_input($price_input, set_value('price_input'),'autocomplete="off"');
										?>
				                        <span class="input-group-addon">đ</span>
			                        </div>
                        		</div>
                        	</div>
                        </div>
                        <div class="form-group">
                    		<div class="row">
                        		<div class="col-sm-6">
                        			<label>Đơn vị</label> </a>
	                        		<div class="input-group">
		                        		<?php echo form_dropdown('measure',$this->configbie->data('measure'), set_value('measure',2), 'class="form-control " style="width:100%" ');?>
			                        </div>
                        		</div>
                        	</div>
                    	</div>
			        </div>
			        
                    <div class="ibox-content">
                    	<div id="notify" class="hidden alert alert-danger">
                    	</div>
                		<div class="form-group">
							<label class="p-w-sm">Chọn nhiều sản phẩm</label> 
							<form action="" method="post" enctype="multipart/form-data">
								<div class="row" id="list-img">
									<div class="col-sm-2">
										
										<div style="cursor: pointer;">
								        	<img src="template/not-found.png"  id="choose-img" class="upload-picture" style="width: 100%" onclick="openKCFinderSlide(this);return false;">
								        </div>
								        <!-- <input type="file" class="hidden" id="upload_file" name="image" multiple/>
								        <div style="cursor: pointer;">
								        	<img src="template/not-found.png" id="choose-img" alt="" style="width: 100%;">
								        </div> -->
									</div>
									<?php if(!empty($product)){ ?>
										<?php foreach ($product['image'] as $key => $val) { ?>
									        <div class="col-sm-2">
									        	<img class="img-prd" src="<?php echo $val ?>"  alt="Ảnh">
									        	<input type="text" name="product[title][]" value="<?php echo $product['title'][$key] ?>" class="text-center form-control m-b" />
									        	<input type="text" name="product[code][]" value="<?php echo $product['code'][$key] ?>" class="form-control input-sm text-center" />
									        	<input type="text" name="product[image][]" value="<?php echo $val ?>" class="hidden" />
									        </div>
									<?php }} ?>
								</div>
							</form>
						</div>
                    </div>
		           	<div class="ibox-title">
						<div class="uk-flex uk-flex-middle uk-flex-space-between">
							<div class="uk-flex uk-flex-middle">
								
							</div>
							<div class="uk-button">
								<button style="margin-right:2px;" class="btn btn-primary btn-sm" name="create" value="create" type="submit">Khởi tạo sản phẩm mới</button>
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
					<h4 class="modal-title">Thêm mới nhóm sản phẩm</h4>
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
