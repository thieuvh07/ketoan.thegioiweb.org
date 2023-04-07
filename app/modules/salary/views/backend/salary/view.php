
<style type="text/css">
	table{
		min-width:900px;
	}
</style>
<div id="page-wrapper" class="gray-bg dashbard-1 js_load_view">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/header'); ?>
	</div>
	 <div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Quản lý lương</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Quản lý lương</strong></li>
			</ol>
		</div>
	</div>
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Danh sách lương</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="fa fa-wrench"></i>
						</a>
							<ul class="ajax-recycle-cash-all dropdown-menu dropdown-customer">
								<li><a>Xóa tất cả dòng được chọn</a></li>
							</ul>
						<ul class="dropdown-menu dropdown-cash">
						</ul>
						<a class="close-link">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="" style="overflow-x: scroll;">
						<form method="post" role="form" action="" class="form-horizontal product js_update_salary">
							<div class="uk-flex uk-flex-middle uk-flex-space-between m-b-sm">
								<div class="">
									<div class="js_dropdown" data-name="periodicid" data-module="periodic" data-key="id" data-value="title"></div>
								</div>
								<div class="uk-button">
									<button class="btn btn-primary btn-sm" name="create" value="create" type="submit">Cập nhật</button>
								</div>
							</div>
							<div class="js_content">
								
							</div>
						</form>
						
					</div>
					<div id="pagination">
						<?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>
					</div>
					<div class="loader"></div>
				</div>
			</div>
		</div>
		</div>
	</div>
	<?php $this->load->view('dashboard/backend/common/footer'); ?>
</div>