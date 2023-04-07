<div id="page-wrapper" class="gray-bg dashbard-1 js_load_view">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/header'); ?>
	</div>
	 <div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Quản lý nhóm sản phẩm</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Quản lý nhóm sản phẩm</strong></li>
			</ol>
		</div>
	</div>
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Danh sách nhóm sản phẩm</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="fa fa-wrench"></i>
						</a>
							<!-- <ul class="ajax-recycle-all dropdown-menu dropdown-customer">
								<li><a>Xóa tất cả dòng được chọn</a></li>
							</ul> -->
						<a class="close-link">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content" style="position:relative;">
					<div class="table-responsive">
						<div class="uk-flex uk-flex-middle uk-flex-space-between m-b">
							<div></div>
							<div class="toolbox">
								<div class="uk-flex uk-flex-middle uk-flex-space-between">
									<div class="uk-button">
										<a href="<?php echo site_url('product/backend/catalogue/create'); ?>" class="btn btn-danger btn-sm"><i class="fa fa-plus"></i> Thêm nhóm sản phẩm mới</a>
									</div>
								</div>
							</div>
						</div>
						<div class="table-responsive">
							<div class="text-small mb10">Hiển thị từ <span class="js_from">0</span> đến <span class="js_to">0</span> trên tổng số <span class="js_total_rows">0</span> bản ghi</div>
							<table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
									<tr>
										<th style="width: 50px">
											<input type="checkbox" id="checkbox-all">
											<label for="check-all" class="labelCheckAll"></label>
										</th>
										<th class="text-center" style="width: 50px">ID</th>
										<th>Loại sản phẩm</th>
										<!-- <th class="text-center">Mô tả</th> -->
										<th class="text-center" style="width: 100px"> Số sản phẩm</th>
										<th class="text-center" style="width: 100px"> Người tạo</th>
										<th class="text-center" style="width: 100px">Thao tác</th>
									</tr>
								</thead>
								<tbody class="js_content">
									
								</tbody>
							</table>
						</div>
						<div class="js_pagination">
							<?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
	<?php $this->load->view('dashboard/backend/common/footer'); ?>
</div>