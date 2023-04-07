<div id="page-wrapper" class="gray-bg dashbard-1 js_load_view">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/header'); ?>
	</div>
	 <div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Quản lý kì</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Quản lý kì</strong></li>
			</ol>
		</div>
	</div>
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Danh sách kì</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="fa fa-wrench"></i>
						</a>
						<ul class="dropdown-menu dropdown-cash">
						</ul>
						<a class="close-link">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content" style="position:relative;">
					<div class="table-responsive">
						<form action="" method="get" id="form">
						<div class="uk-flex m-b-sm">
						</div>
						</form>
						<table class="table table-striped table-bordered table-hover dataTables-example" id="table_cash_month" >
							
							<thead>
								<tr>
									<th style="width:30px">
										<input type="checkbox" id="checkbox-all">
										<label for="check-all" class="labelCheckAll"></label>
									</th>
									<th style="width:200px" class="text-center">Tiêu đề</th>
									<th class="text-center">Ngày bắt đầu</th>
									<th class="text-center">Ngày kết thúc</th>
									<th style="width:95px" class="text-right">Tiền đầu kì</th>
									<th style="width:95px" class="text-right">Tiền cuối kì</th>
									<th class="text-center">Ghi chú</th>
									<th class="text-center">Thao tác</th>
								</tr>
							</thead>
							<tbody class="js_content">
								
								
							</tbody>
						</table>
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