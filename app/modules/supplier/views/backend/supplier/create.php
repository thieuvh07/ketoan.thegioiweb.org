<div id="page-wrapper" class="gray-bg dashbard-1 js_load_create">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/header'); ?>
	</div>
	 <div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Thêm nhóm sản phẩm</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Thêm nhóm sản phẩm</strong></li>
			</ol>
		</div>
	</div>
	<form method="post" action="" class="form-horizontal js_create">
		<div class="wrapper wrapper-content animated fadeInRight">
			<div class="row">
				<div class="box-body">
					<?php $error = validation_errors(); echo !empty($error)?'<div class="alert alert-danger">'.$error.'</div>':'';?>
				</div><!-- /.box-body -->
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<div class="toolbox">
								<h4>Thông tin chung</h4>
							</div>
						</div>
						<div class="ibox-content profile-content">
							<div class="form-group">
								<label class="col-md-3">
									<div class=" control-label">
										<span class="m-r">Tên nhà cung cấp <b class="text-danger">(*)</b></span>
										 <a data-toggle="popover" data-placement="auto top" data-content="Tên doanh nghiệp, tổ chức .. giao dịch với cửa hàng." data-original-title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
									</div>
								</label>
								<div class="col-md-6">
									<?php echo form_input('title', set_value('title', $moduleDetail['title'] ?? ''), 'class="form-control " placeholder="" autocomplete="off"');?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-3">
									<div class=" control-label">
										<span class="m-r">Mã nhà cung cấp </span>
										 <a data-toggle="popover" data-placement="auto top" data-content="Mã nhà cung cấp sẽ sử dụng để tìm kiếm" data-original-title="" title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
									</div>
								</label>
								<div class="col-md-6">
									<?php echo form_input('code', $moduleDetail['code'] ?? '', 'class="form-control " placeholder="" autocomplete="off"');?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-3">
									<div class=" control-label">
										<span class="m-r">Số điện thoại </span>
										 <a data-toggle="popover" data-placement="auto top" data-content="Số điện thoại của nhà cung cấp dùng để liên hệ khi đặt hàng hoặc giao dịch." data-original-title="" title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
									</div>
								</label>
								<div class="col-md-6">
									<?php echo form_input('phone', set_value('phone', $moduleDetail['phone'] ?? ''), 'class="form-control " placeholder="" autocomplete="off"');?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-3">
									<div class=" control-label">
										<span class="m-r">Email</span>
										 <a data-toggle="popover" data-placement="auto top" data-content="Email của nhà cung cấp dùng để liên hệ khi đặt hàng hoặc giao dịch." data-original-title="" title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
									</div>
								</label>
								<div class="col-md-6">
									<?php echo form_input('email', set_value('email', $moduleDetail['email'] ?? ''), 'class="form-control " placeholder="" autocomplete="off"');?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-3">
									<div class=" control-label">
										<span class="m-r">Website</span>
										 <a data-toggle="popover" data-placement="auto top" data-content="Website hoạt động của nhà cung cấp có thể có." data-original-title="" title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
									</div>
								</label>
								<div class="col-md-6">
									<?php echo form_input('website', set_value('website', $moduleDetail['website'] ?? ''), 'class="form-control " placeholder="" autocomplete="off"');?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-3">
									<div class=" control-label">
										<span class="m-r">Tài khoản ngân hàng</span>
										 <a data-toggle="popover" data-placement="auto top" data-content="Cung cấp số tài khoản để giao dịch" data-original-title="" title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
									</div>
								</label>
								<div class="col-md-6">
									<?php echo form_textarea('bank', set_value('bank', $moduleDetail['bank'] ?? ''), 'class="form-control " style="height:70px" placeholder="" autocomplete="off"');?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-3">
									<div class=" control-label">
										<span class="m-r">Số fax </span>
										 <a data-toggle="popover" data-placement="auto top" data-content="Số fax để liên lạc với nhà cung cấp." data-original-title="" title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
									</div>
								</label>
								<div class="col-md-6">
									<?php echo form_input('fax', set_value('fax', $moduleDetail['fax'] ?? ''), 'class="form-control " placeholder="" autocomplete="off"');?>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-3">
									<div class=" control-label">
										<span class="m-r">Mã số thuế</span>
										 <a data-toggle="popover" data-placement="auto top" data-content="Mã số thuế có thể được sử dụng trong các hoạt động thanh toán trực tuyến hoặc các giao dịch quan trọng." data-original-title="" title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
									</div>
								</label>
								<div class="col-md-6">
									<?php echo form_input('mst', set_value('mst', $moduleDetail['mst'] ?? ''), 'class="form-control " placeholder="" autocomplete="off"');?>
								</div>
							</div>
						</div>
						<div class="ibox-title">
							<div class="toolbox">
								<div class="uk-flex uk-flex-middle uk-flex-space-between">
									<h4>Thông tin liên hệ</h4>
								</div>
							</div>
						</div>
						<div class="ibox-content profile-content">
							<div class="form-group">
								<label class="col-md-3">
									<div class=" control-label">
										<span class="m-r">Địa chỉ</span>
										 <a data-toggle="popover" data-placement="auto top" data-content="Địa chỉ để liên lạc với nhà cung cấp." data-original-title="" title="" aria-describedby="popover871828" class="fa fa-info-circle"></a>
									</div>
								</label>
								<div class="col-md-6">
									<?php echo form_input('address', set_value('address', $moduleDetail['address'] ?? ''), 'class="form-control " placeholder="" autocomplete="off"');?>
								</div>
							</div>
							
							
							<div class="toolbox action clearfix">
								<div class="uk-flex uk-flex-middle uk-flex-space-between uk-button ">
									<div class="uk-flex uk-flex-middle">
									</div>
									<button class="btn btn-primary btn-sm" name="create" value="create" type="submit">Thêm mới nhà cung cấp</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	<?php $this->load->view('dashboard/backend/common/footer'); ?>
</div>
