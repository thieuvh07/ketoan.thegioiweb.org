<div id="page-wrapper" class="gray-bg dashbard-1 js_load_view">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/navbar'); ?>
	</div>
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Quản lý Bộ phận (phòng ban)</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Quản lý Bộ phận (phòng ban)</strong></li>
			</ol>
		</div>
	</div>
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Danh sách Bộ phận (phòng ban)</h5>
						<div class="ibox-tools">
							<a class="collapse-link">
								<i class="fa fa-chevron-up"></i>
							</a>
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="fa fa-wrench"></i>
							</a>
							<ul class="dropdown-menu dropdown-user">
								<li>
									<a type="button" class="ajax_delete_all">Xóa tất cả</a>
								</li>
							</ul>
							<a class="close-link">
								<i class="fa fa-times"></i>
							</a>
						</div>
					</div>
					<div class="ibox-content" style="position:relative;">
						
						<?php 
							$data['buttonCreate'] = '<a href="'.site_url('user/backend/catalogue/create').'" class="btn btn-danger btn-sm"><i class="fa fa-plus"></i> Thêm Bộ phận (phòng ban)</a>';
						?>
						<?php $this->load->view('dashboard/backend/common/blockCataSearch', $data); ?>

						<div class="table-responsive">
							<div class="text-small mb10">Hiển thị từ <span class="js_from">0</span> đến <span class="js_to">0</span> trên tổng số <span class="js_total_rows">0</span> bản ghi</div>
							<table class="table table-striped table-bordered table-hover dataTables-example" >
								<thead>
									<tr>
										<th class="text-center"  class="width-50">
											<input type="checkbox" id="checkbox-all">
											<label for="check-all" class="labelCheckAll"></label>
										</th>
										<th class="text-center width-50">ID</th>
										<th >Tiêu đề</th>
										<th class="text-center" style="width:115px;">Số thành viên</th>
										<th class="text-center" style="width:175px;">Khởi tạo</th>
										<th class="text-center" style="width:105px;">Thao tác</th>
									</tr>
								</thead>
								<tbody class="js_content">
									
								</tbody>
							</table>
						</div>
						<div class="js_pagination">
							<?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>
						</div>
						<div class="loader"></div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('dashboard/backend/common/footer'); ?>
	</div>
</div>