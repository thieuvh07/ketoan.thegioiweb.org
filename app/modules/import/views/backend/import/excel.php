<div id="page-wrapper" class="gray-bg dashbard-1">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/navbar'); ?>
	</div>
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Quản lý nhập hàng</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Quản lý nhập hàng</strong></li>
			</ol>
		</div>
	</div>
	<div class="wrapper wrapper-content  animated fadeInRight">
		<div class="row">
			<div class="col-sm-12" style="padding-left:0;padding-right:0;">
				<div class="ibox">
					<div class="ibox-title">
						<h5>Danh sách nhập hàng</h5>
						
					</div>
					<div class="ibox-content">
						<div class="uk-flex uk-flex-middle uk-flex-space-between m-b-sm" >
							<div class="col-sm-3 p-l-none">
								<div class="js_dropdown" data-name="supplierid" data-module="supplier" data-text="Chọn NCC" data-value="title"></div>
							</div>
							<div class="col-sm-3">
								<div class="btn btn-success btn-sm js_excel">Xuất exel</div>
							</div>
							<div class="col-sm-3">
							</div>
							<div class="col-sm-3 p-r-none">
							</div>
						</div>

						
				 		
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('dashboard/backend/common/footer'); ?>
	</div>
</div>
