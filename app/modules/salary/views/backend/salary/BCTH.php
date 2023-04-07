<div id="page-wrapper" class="gray-bg dashbard-1 js_load_view">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/header'); ?>
	</div>
	 <div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Báo cáo tổng hợp</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Báo cáo tổng hợp</strong></li>
			</ol>
		</div>
	</div>
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
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
					<div class="uk-flex uk-flex-middle uk-flex-space-between m-b-sm">
						<div class="">
							<div class="js_dropdown" data-name="periodicid" data-module="periodic" data-key="id" data-value="title"></div>
						</div>
						<div class="uk-button">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">	</div>
						<div class="col-sm-6">
							<table class="table-salary table table-striped table-bordered table-hover dataTables-example" id="table_cash" >
								<tbody>
									<tr style="font-size: 23px; font-weight: 450">
										<th colspan="3" class="text-center">BÁO CÁO TỔNG HỢP</th>
									</tr>
									<tr style="font-size: 17px">
										<td colspan="3" class="text-center">Tổng tiền hàng tồn trong kho: <span class="js_total_price_in_stock"></span> đ</td>
									</tr>
									<tr>
										<th class="text-center">STT</th>
										<th class="text-center">Nội dung</th>
										<th class="text-center">Tổng tiền</th>
									</tr>
									<tr>
										<td class="text-center">1</td>
										<td>Tổng lợi nhuận từ bán hàng</td>
										<td class="text-right js_profit_real"></td>
									</tr>
									<tr>
										<td class="text-center">2</td>
										<td>Tổng lợi nhuận từ công thợ</td>
										<td class = "text-right js_total_money_worker_profit"></td>
									</tr>
									<tr>
										<td class="text-center">3</td>
										<td>Tổng chi phí lương</td>
										<td class = "text-right js_total_salary"></td>
									</tr>
									<tr>
										<td class="text-center">4</td>
										<td>Tổng chi phí hàng tháng</td>
										<td class = "text-right js_total_HT"></td>
									</tr>
									<tr>
										<td class="text-center">5</td>
										<td>Tổng chi phí phát sinh</td>
										<td class = "text-right js_total_PS"></td>
									</tr>
									<tr  style="font-size: 28px; font-weight: 450">
										<th class="text-center" colspan="2">Tổng lợi nhuận</th>
										<th class = "text-right js_total_profit"></th>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
	<?php $this->load->view('dashboard/backend/common/footer'); ?>
</div>