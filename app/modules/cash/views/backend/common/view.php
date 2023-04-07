<div id="page-wrapper" class="gray-bg dashbard-1 js_load_view">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/navbar'); ?>
	</div>
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Quản lý thu chi mặc định</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Quản lý thu chi mặc định</strong></li>
			</ol>
		</div>
	</div>
	<div class="wrapper wrapper-content  animated fadeInRight">
		<div class="row">
			<div class="col-sm-12" style="padding-left:0;padding-right:0;">
				<div class="ibox">
					<div class="ibox-title">
						<h5>Danh sách thu chi mặc định</h5>
						<div class="ibox-tools">
							<a class="collapse-link">
								<i class="fa fa-chevron-up"></i>
							</a>
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="fa fa-wrench"></i>
							</a>
							<ul class="dropdown-menu dropdown-user">
								<li><a type="button" class="ajax-recycle-all" data-title="Lưu ý: Số thu chi mặc định bị xóa sẽ không thể truy cập vào hệ thống quản trị được nữa!" data-module="user">Xóa tất cả</a>
								</li>
							</ul>
							<a class="close-link">
								<i class="fa fa-times"></i>
							</a>
						</div>
					</div>
					<div class="ibox-content">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover dataTables-example" id="table_cash">
								<thead>
									<tr>
										<th style="width:30px">
											<input type="checkbox" id="checkbox-all">
											<label for="check-all" class="labelCheckAll"></label>
										</th>
										<th class="">Diễn giải</th>
										<th class="text-center" style="width:92px">Nhóm</th>
										<th class="">Mở rộng</th>
										<th class="text-right" class="text-right">Thu</th>
										<th class="text-right" class="text-right">Chi</th>
										<th class="text-right">Ghi chú</th>
										<th class="text-center" style="width:95px">Thao tác</th>
									</tr>
									
									<tr class="">
										<td></td>
										<td class="text-center">
											<?php echo form_input('title', set_value('title',$this->input->get('title')), 'class="form-control " autocomplete="off"');?>
										</td>
										<td class="text-center">
											<div class="js_dropdown" data-name="catalogueid" data-module="cash_catalogue" data-value="title" data-checked="<?php echo $this->input->get('catalogueid') ?>"></div>
										</td>
										<td class="text-right extend">
											
										</td>
										<td class="text-right">
											<?php echo form_input('input', set_value('input',$this->input->get('input')), 'class="form-control int text-right" autocomplete="off"');?>
										</td>
										<td class="text-right">
											<?php echo form_input('output', set_value('output',$this->input->get('output')), 'class="form-control int text-right" autocomplete="off"');?>
										</td>
										<td class="text-center">
											<?php echo form_input('note', set_value('note',$this->input->get('note')), 'class="form-control " autocomplete="off"');?>
										</td>
										<td class="text-center">
											<a type="button" class="btn btn-sm btn-primary js_create"><i class="fa fa-plus"></i> Thêm</a>
										</td>
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
