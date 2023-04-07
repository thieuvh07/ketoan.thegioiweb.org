<div id="page-wrapper" class="gray-bg dashbard-1 js_load_update">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/header'); ?>
	</div>
	 <div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Cập nhật nhóm cash</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Cập nhật nhóm cash</strong></li>
			</ol>
		</div>
	</div>
	<form method="post" action="" class="form-horizontal js_update">
		<input type="text" class="hidden" name="id" value="<?php echo $moduleDetail['id'] ?>">
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
										<span class="m-r">Tên nhóm tiền mặt </span>
									</div>
								</label>
								<div class="col-md-6">
									<?php echo form_input('title', set_value('title', isset($moduleDetail['title'])?$moduleDetail['title']:''), 'class="form-control " placeholder="" autocomplete="off"');?>
									<?php echo form_input('title_original', $moduleDetail['title'], 'class="hidden"');?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3">
									<div class=" control-label">
										<span class="m-r">Mô tả</span>
									</div>
								</label>
								<div class="col-md-6">
									<?php echo form_input('description', set_value('description', $moduleDetail['description'] ?? ''), 'class="form-control " placeholder="" autocomplete="off"');?>
								</div>
							</div>
						</div>
						<div class="ibox-content profile-content">
							<div class="toolbox action clearfix">
								<div class="uk-flex uk-flex-middle uk-flex-space-between uk-button ">
									<div class="uk-flex uk-flex-middle">
									</div>
									<button class="btn btn-primary btn-sm" name="update" value="update" type="submit">Cập nhật nhóm cash</button>
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
