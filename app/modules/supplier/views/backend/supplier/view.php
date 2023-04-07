<div id="page-wrapper" class="gray-bg dashbard-1 js_load_view">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/header'); ?>
	</div>
	 <div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Quản lý nhà cung cấp</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Quản lý nhà cung cấp</strong></li>
			</ol>
		</div>
	</div>
	<div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-sm-8" style="padding-left:0;padding-right:0;">
                    <div class="ibox">
						<div class="ibox-title">
							<h5>Danh sách nhà cung cấp</h5>
							<div class="ibox-tools">
								<a class="collapse-link">
									<i class="fa fa-chevron-up"></i>
								</a>
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									<i class="fa fa-wrench"></i>
								</a>
								<ul class="dropdown-menu dropdown-user">
									<li><a type="button" class="ajax-recycle-all" data-title="Lưu ý: Số thành viên bị xóa sẽ không thể truy cập vào hệ thống quản trị được nữa!" data-module="user">Xóa tất cả</a>
									</li>
								</ul>
								<a class="close-link">
									<i class="fa fa-times"></i>
								</a>
							</div>
						</div>
                        <div class="ibox-content">
                            <div class="uk-flex uk-flex-middle uk-flex-space-between">	
								<div class="uk-button">
									<a href="<?php echo site_url('supplier/backend/supplier/create'); ?>"  class="btn btn-danger btn-sm create"><i class="fa fa-plus"></i> Thêm nhà cung cấp</a>
								</div>
								<form class="js_form_search" id="form"  action="">
									<div class="uk-flex uk-flex-middle uk-flex-space-between">
										<div class="input-group">
											<input type="text" style="width:250px;" name="keyword" value="<?php echo $this->input->get('keyword'); ?>" placeholder="Tìm theo nhà cung cấp" class="input form-control js_keyword" autocomplete="off">
										</div>
									</div>
									<button type="text" class="hidden submit"></button>
								</form>
							</div>
                            <div class="clients-list">
                            <div class="tab-content" id="supplierData">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="full-height-scroll">
                                           	<div class="table-responsive">
												<div class="text-small mb10">Hiển thị từ <span class="js_from">0</span> đến <span class="js_to">0</span> trên tổng số <span class="js_total_rows">0</span> bản ghi</div>
												<table class="table table-striped table-hover" >
													<thead>
														<tr>
															<th class="text-center" style="width: 50px">
																<input type="checkbox" id="checkbox-all">
																<label for="check-all" class="labelCheckAll"></label>
															</th>
															<th>Tên NCC</th>
															<th class="text-right">Tổng tiền phải trả</th>
															<th class="text-right">Tổng tiền đã trả</th>
															<th class="text-right"><b>Còn lại</b></th>
															<!-- <th class="text-center" style="width: 100px">Thao tác</th> -->
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
                </div>
                <div class="col-sm-4" style="padding-right:0;">
                    <div class="ibox ">
                        <div class="ibox-content">
                            <div class="tab-content">
                                <div id="contact-1" class="tab-pane active">
                                    <div class="row m-b">
                                    	<div class="col-md-12">
	                                        <h2 class="title">Noname</h2>
                                    	</div>
                                    </div>
                                    <div class="supplier-detail">
										<div class="full-height-scroll">
											<strong>Lịch sử giao dịch</strong>
											<hr>
											<ul>
				                            </ul>
										</div>
                                    </div>
									<div class="loader"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<?php $this->load->view('dashboard/backend/common/footer'); ?>
</div>
