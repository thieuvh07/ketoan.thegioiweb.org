<div id="page-wrapper" class="gray-bg dashbard-1 js_load_create">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/header'); ?>
	</div>
	 <div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Thêm mới nhóm cash</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Thêm mới nhóm cash</strong></li>
			</ol>
		</div>
	</div>
	<form method="post" action="" class="form-horizontal js_create">
		<div class="wrapper wrapper-content animated fadeInRight ">
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
										<span class="m-r">Tên nhóm tiền mặt</span>
									</div>
								</label>
								<div class="col-md-6">
									<?php echo form_input('title', set_value('title'), 'class="form-control " placeholder="" autocomplete="off"');?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3">
									<div class=" control-label">
										<span class="m-r">Mô tả</span>
									</div>
								</label>
								<div class="col-md-6">
									<?php echo form_input('description', set_value('description'), 'class="form-control " placeholder="" autocomplete="off"');?>
								</div>
							</div>
						</div>
						<div class="ibox-content profile-content">
							<div class="toolbox action clearfix">
								<div class="uk-flex uk-flex-middle uk-flex-space-between uk-button ">
									<div></div>
									<button class="btn btn-primary btn-sm" name="create" value="create" type="submit">Thêm mới nhóm tiền mặt</button>
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
