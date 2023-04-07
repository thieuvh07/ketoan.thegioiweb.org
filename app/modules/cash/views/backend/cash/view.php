<div id="page-wrapper" class="gray-bg dashbard-1 js_load_view">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/navbar'); ?>
	</div>
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Quản lý tiền mặt</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Quản lý tiền mặt</strong></li>
			</ol>
		</div>
	</div>
	<div class="wrapper wrapper-content  animated fadeInRight">
		<div class="row">
			<div class="col-sm-12" style="padding-left:0;padding-right:0;">
				<div class="ibox">
					<div class="ibox-title">
						<h5>Danh sách tiền mặt</h5>
						<div class="ibox-tools">
							<a class="collapse-link">
								<i class="fa fa-chevron-up"></i>
							</a>
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="fa fa-wrench"></i>
							</a>
							<ul class="dropdown-menu dropdown-user">
								<li><a type="button" class="ajax-recycle-all" data-title="Lưu ý: Số tiền mặt bị xóa sẽ không thể truy cập vào hệ thống quản trị được nữa!" data-module="user">Xóa tất cả</a>
								</li>
							</ul>
							<a class="close-link">
								<i class="fa fa-times"></i>
							</a>
						</div>
					</div>
					<div class="ibox-content">
						<?php $this->load->view('cash/backend/cash/blockSearch', $data ?? ''); ?>
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover dataTables-example">
								<thead>
									<tr>
										<th style="width:30px">
											<input type="checkbox" id="checkbox-all">
											<label for="check-all" class="labelCheckAll"></label>
										</th>
										<th style="width:200px" class="text-center"> Ngày tháng</th>
										<th class="text-right" class="text-right">Thu</th>
										<th class="text-right" class="text-right">Chi</th>
										<th class="text-right">Tồn</th>
										<th class="text-center">Thao tác</th>
									</tr>
									<tr class="gradeX bg-active">
										<td></td>
										<td class="text-center">Tồn đầu kì</td>
										<td class="text-right money_opening" style="font-weight: bold"></td>
										<td class="text-right"></td>
										<td class="text-right money_closing" style=" font-size:20px!important;font-weight: bold"></td>
										<td class="text-center"></td>
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
