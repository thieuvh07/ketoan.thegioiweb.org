<div id="page-wrapper" class="gray-bg dashbard-1 js_load_view js_load_month" >
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/header'); ?>
	</div>
	 <div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Quản lý sản phẩm trong kì</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Quản lý sản phẩm trong kì</strong></li>
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
									<ul class="ajax-recycle-product-all dropdown-menu dropdown-customer">
										<li><a>Xóa tất cả dòng được chọn</a></li>
									</ul>
								<a class="close-link">
									<i class="fa fa-times"></i>
								</a>
							</div>
						</div>

					
						<div class="ibox-content">
                            <div class="clients-list mt0 ">
		                        <div class="tab-content">
		                        	
		                        	<?php $this->load->view('product/backend/product/blockSearchMonth', $data ?? ''); ?>

		                        	<div class="text-small mb10">Hiển thị từ <span class="js_from">0</span> đến <span class="js_to">0</span> trên tổng số <span class="js_total_rows">0</span> bản ghi</div>
		                            <div class="table-responsive">
		                                <table class="table table-striped table-hover">
											<thead>
												<tr>
													<th style="width:20px">
														<input type="checkbox" id="checkbox-all">
														<label for="check-all" class="labelCheckAll"></label>
													</th>
													<th style="width:50px"></th>
													<th>Tên SP </th>
													<th style="width:68px">Mã SP</th>
													<th style="width:88px" class="text-right">Tồn đầu</th>
													<th style="width:80px" class="text-right">Tồn cuối</th>
													<th style="width:88px" class="text-right">Nhập</th>
													<th style="width:88px" class="text-right">Xuất</th>
												</tr>
											</thead>
		                                    <tbody class="js_content">
												
		                                    </tbody>
		                                </table>
		                                <div class="js_pagination">
										</div>
		                            </div>
		                            
		                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<?php $this->load->view('dashboard/backend/common/footer'); ?>
</div>
