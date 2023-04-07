<div id="page-wrapper" class="gray-bg dashbard-1 js_load_view">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/header'); ?>
	</div>
	 <div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Quản lý KTVP</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Quản lý KTVP</strong></li>
			</ol>
		</div>
	</div>
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Danh sách KTVP</h5>
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
						<form action="" method="get" id="form" class="js_form_search">
						<div class="uk-flex uk-flex-middle uk-flex-space-between m-b-sm">
							<div class="perpage">
								<div class="uk-flex uk-flex-middle mb10">
									<?php echo form_dropdown('perpage', $this->configbie->data('perpage'), set_value('perpage',$this->input->get('perpage')) ,'class="form-control input-sm "id="perpage"  data-url="'.site_url('customer/backend/catalogue/view').'"'); ?>
								</div>
							</div>
							<div class="toolbox">
								
							</div>
						</div>
						<div class="uk-flex m-b-sm">
							<div class="col-xs-2 p-l-none">
								<div class="js_dropdown" data-name="periodicid" data-module="periodic" data-key="id" data-value="title"></div>
							</div>
							<div class="col-xs-2">
								<?php echo form_input('date_start', set_value('date_start',$this->input->get('date_start')), 'class="form-control "  data-mask="99/99/9999" placeholder="dd/mm/Y" autocomplete="off"');?>
							</div>
							<div class="col-xs-2">
								<?php echo form_input('date_end', set_value('date_end',$this->input->get('date_end')), 'class="form-control "  data-mask="99/99/9999" placeholder="dd/mm/Y" autocomplete="off"');?>
							</div>
							<div class="col-xs-3">
								<div class="js_dropdown" data-name="userid_charge" data-module="user" data-text="Chọn nhân viên" data-value="fullname"></div>
							</div>
							<div class="col-xs-3 p-r-none">
								<input type="search" name="keyword"  class="js_keyword form-control input-sm m-r" placeholder="Nhập từ khóa tìm kiếm mọi thứ..." value="<?php echo $this->input->get('keyword'); ?>" >
							</div>
						</div>
						<div class="uk-flex m-b-sm">
							<div class="col-xs-2 p-l-none">
								<div class="js_dropdown" data-name="type_business"  data-text="Chọn PT KD" data-module="type_business" data-value="title"></div>
							</div>
							<div class="col-xs-2">
								<div class="js_dropdown" data-text="Chọn loại CT" data-name="construction_catalogue" data-module="construction_catalogue" data-value="title"></div>
							</div>
							<div class="col-xs-2">
								<div class="btn btn-success js_search" style="margin-bottom: 0px">Tìm kiếm</div>
							</div>
						</div>
						</form>
						<div class="uk-flex uk-flex-middle uk-flex-space-between m-b-sm">
							<div class="text-small mb10">Hiển thị từ <span class="js_from">1</span> đến <span class="js_to">0</span> trên tổng số <span class="js_total_rows">0</span> bản ghi</div>
						</div>
					
						<div class="tab-1">
							<table class=" table table-striped table-bordered table-hover dataTables-example table-sticky" data-sticky-top="tr:first-child" data-sticky-left="tr td:first-child" data-sticky-bottom="th:last-child" data-sticky-right="tr td:last-child">
								<tbody class="js_content">
									<tr style="background:#eee;">
										<td class="text-center hidden" style="width:86px;">
											<input type="checkbox" id="checkbox-all">
											<label for="check-all" class="labelCheckAll"></label>
										</td>
										<td class="text-center" style="width:50px;">Loại KD</td>
										<td class="text-center" style="width:100px;">NVKD</td>
										<td class="text-center" style="width:100px;">Tên CT</td>
										
										<td class="text-center" style="width:180px;">Diễn giải</td>

										<?php if(in_array('giam-doc', $this->auth['slugCata'] ?? []) ||
												in_array('kinh-doanh', $this->auth['slugCata'] ?? []) ||
												in_array('ke-toan-van-phong', $this->auth['slugCata'] ?? [])
										 ){ ?>

											<td class="text-right">Tổng thu</td>
											<td class="text-right">Doanh số thực</td>
											<td class="text-right">Lợi nhuận</td>
											<td class="text-right" style="width:90px;">Tổng thợ</td>
										<?php } ?>
										<td class="text-center">Ghi chú</td>
										<?php if(in_array('giam-doc', $this->auth['slugCata'] ?? []) ||
												in_array('ke-toan-van-phong', $this->auth['slugCata'] ?? [])
										 ){ ?>
											<td class="text-center">Hành động</td>
										<?php } ?>
									</tr>
								</tbody>
								
							</table>
						</div>
					</div>
					<div class="js_pagination">
						</div>
				</div>
			</div>
		</div>
		</div>
	</div>
	<?php $this->load->view('dashboard/backend/common/footer'); ?>
</div>
<div class="modal inmodal fade" id="modal" tabindex="-1" role="dialog"  aria-hidden="true">
	<form class="" method="" action="" >
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Nhập tiền cho thợ</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<div class="row">
							<div class="col-md-12">
								Tổng tiền KTVP: <span class="total_money_worker">0</span>
								<table class="table table-striped table-hover js_content">
									
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary js_update_money_worker">Cập nhật</button>
				</div>
			</div>
		</div>
	</form>
</div>