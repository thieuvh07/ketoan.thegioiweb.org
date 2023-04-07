<div id="page-wrapper" class="gray-bg dashbard-1 js_load_view">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/header'); ?>
	</div>
	 <div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Bảng chấm công</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Bảng chấm công</strong></li>
			</ol>
		</div>
	</div>
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Danh sách nhân viên</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="fa fa-wrench"></i>
						</a>
						<ul class="dropdown-menu dropdown-customer">
							
						</ul>
						<a class="close-link">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
				
				<div class="ibox-content" style="position:relative;">
					<div class="table-responsive">
						<form action="" method="get" id="form">
							<div class="uk-flex uk-flex-middle uk-flex-space-between m-b-sm">
								<div class="js_dropdown" data-name="periodicid" data-module="periodic" data-key="id" data-value="title"></div>
								<div>
									<div class="btn btn-warning js_change_all">Chấm công tất cả</div>
									<div class="btn btn-success js_update">Cập nhật</div>
								</div>
							</div>
						</form>
						<table class="table table-striped table-hover js_content table-timekeeping">
						</table>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
	<?php $this->load->view('dashboard/backend/common/footer'); ?>
</div>
