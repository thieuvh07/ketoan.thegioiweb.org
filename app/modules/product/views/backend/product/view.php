<div id="page-wrapper" class="gray-bg dashbard-1 js_load_view">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/navbar'); ?>
	</div>
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Quản lý sản phẩm</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Quản lý sản phẩm</strong></li>
			</ol>
		</div>
	</div>
	<div class="wrapper wrapper-content  animated fadeInRight">
		<div class="row">
			<div class="col-sm-12" style="padding-left:0;padding-right:0;">
				<div class="ibox">
					<div class="ibox-title">
						<h5>Danh sách sản phẩm</h5>
						<div class="ibox-tools">
							<a class="collapse-link">
								<i class="fa fa-chevron-up"></i>
							</a>
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="fa fa-wrench"></i>
							</a>
							<ul class="dropdown-menu dropdown-user">
								<li><a type="button" class="ajax-recycle-all" data-title="Lưu ý: Số sản phẩm bị xóa sẽ không thể truy cập vào hệ thống quản trị được nữa!" data-module="user">Xóa tất cả</a>
								</li>
							</ul>
							<a class="close-link">
								<i class="fa fa-times"></i>
							</a>
						</div>
					</div>
					<div class="ibox-content">
						<?php $this->load->view('product/backend/product/blockSearch', $data ?? ''); ?>
						<div class="table-responsive">
							<div class="text-small mb10">Hiển thị từ <span class="js_from">0</span> đến <span class="js_to">0</span> trên tổng số <span class="js_total_rows">0</span> bản ghi</div>
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th style="width:20px">
											<input type="checkbox" id="checkbox-all">
											<label for="check-all" class="labelCheckAll"></label>
										</th>
										<th style="width:50px"></th>
										<th>Tên SP 
										</th>
										<th style="width:72px">Mã SP
										</th>
										<th style="width:85px" class="text-right">Tồn cuối
										</th>
										<th style="width:88px" class="text-right">Tồn đầu
										</th>
										<th style="width:80px" class="text-right">Giá bán
										</th>
										<th style="width:80px" class="text-right">Tổng vốn tồn
										</th>

										<th style="width:150px" >Loại sp</th>
										<th style="width:150px" >NCC</th>
										<th class="text-center" style="width:95px">Thao tác</th>
									</tr>
								</thead>
								<tbody class="js_content">
									
								</tbody>
							</table>
						</div>
						<div class="js_pagination">
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('dashboard/backend/common/footer'); ?>
	</div>
