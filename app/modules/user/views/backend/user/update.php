<div id="page-wrapper" class="gray-bg dashbard-1 js_load_update">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/navbar'); ?>
	</div>
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Cập nhật nhận sự</h2> <ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Cập nhật nhận sự</strong></li>
			</ol>
		</div>
	</div>
	<form method="post" action="" class="form-horizontal box js_update" enctype="multipart/form-data">
		<?php echo form_input('id', set_value('id', $moduleDetail['id']), 'class="hidden" readonly="true"');?>
		<div class="wrapper wrapper-content animated fadeInRight">
			<div class="row">
				<div class="box-body">
					<?php $error = validation_errors(); echo !empty($error)?'<div class="alert alert-danger">'.$error.'</div>':'';?>
				</div><!-- /.box-body -->
			</div>
			<div class="row">
				<div class="col-lg-5">
					<div class="panel-head">
						<h2 class="panel-title">Thông tin chung</h2>
						<div class="panel-description">
							Một số thông tin cơ bản của người sử dụng.
						</div>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="ibox m0">
						<div class="ibox-content">
							<div class="row mb15">
								<div class="col-lg-6">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Tài khoản <b class="text-danger" style="font-weight:400;">( không được sửa )</b></span>
										</label>
										<?php echo form_input('account', htmlspecialchars_decode(html_entity_decode(set_value('account', $moduleDetail['account']))), 'class="form-control" readonly="true" placeholder="" autocomplete="off"');?>
										<input class="hidden" type="text" name="account_original" value="<?php echo $moduleDetail['account'] ?>" >
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Họ tên <b class="text-danger">(*)</b></span>
										</label>
										<?php echo form_input('fullname', set_value('fullname', $moduleDetail['fullname']), 'class="form-control " placeholder="" autocomplete="off"');?>
									</div>
								</div>
							</div>
							<div class="row mb15">
								
								<div class="col-lg-6">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Nhóm nhận sự <b class="text-danger">(*)</b></span>
										</label>
										<?php echo form_dropdown('catalogue[]', '', NULL, 'class="form-control selectMultipe" multiple="multiple"  style="width: 100%;" data-module="user_catalogue" data-selected="'.(base64_encode($moduleDetail['catalogue'] ?? '')).'"'); ?>
									</div>
								</div>
								
								<!-- <div class="col-lg-6">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Chức vụ <b class="text-danger">(*)</b></span>
										</label>
										<div class="js_dropdown" data-name="positionid" data-module="position" data-text="Chọn chức vụ" data-checked="<?php echo $moduleDetail['positionid'] ?>"></div>
									</div>
								</div> -->


							</div>
							<div class="row mb15">
								<?php
									if($this->input->post('gender')){
										$gender = (int)$this->input->post('gender');
									}else{
										$gender = (int)$moduleDetail['gender'];
									}
								?>
								<div class="col-lg-6">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Giới tính <b class="text-danger"></b></span>
										</label>
										<div class="uk-flex uk-flex-middle">
											<div class="i-checks mr30"><label> <input <?php echo ($gender == 1) ? 'checked' : '' ?> class="popup_gender_1 gender" type="radio" value="1"  name="gender"> <i></i> Nam</label></div>
											<div class="i-checks"><label> <input type="radio" <?php echo ($gender == 2) ? 'checked' : '' ?> class="popup_gender_0 gender" required value="2" name="gender"> <i></i> Nữ </label></div>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Ngày sinh <b class="text-danger"></b></span>
										</label>
										<?php echo form_input('birthday', set_value('birthday',  gettime($moduleDetail['birthday'],'d/m/Y')), 'class="form-control" data-mask="99/99/9999" placeholder="dd/mm/Y"');?>
									</div>
								</div>

							</div>

							<div class="row mb15">
								<div class="col-lg-6">
								    <div class="form-row">
								        <label class="control-label text-left">
								            <span>Email <b class="text-danger">(*)</b></span>
								        </label>
								        <?php echo form_input('email', set_value('email', $moduleDetail['email']), 'class="form-control " placeholder="" autocomplete="off"');?>
								        <input class="hidden" type="text" name="email_original" value="<?php echo $moduleDetail['email'] ?>" >
								    </div>
								</div>
								<div class="col-lg-6">
									<div class="form-row">
										<label class="control-label text-left">
											<!-- <span>Avatar <b class="text-danger"></b></span> -->
										</label>
										<div>
										<!-- 	<a href="" title="" class="uploadMultiImage" onclick="openKCFinderImage(this);return false;">Upload hình ảnh</a>
											
										<?php echo form_input('avatar', $moduleDetail['avatar'], 'class="form-control " onclick="openKCFinder(this)" placeholder="" autocomplete="off"');?> -->
											<!-- form_upload -->
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-lg-5">
					<div class="panel-head">
						<h2 class="panel-title">Địa chỉ</h2>
						<div class="panel-description">
							Các thông tin liên hệ chính với người sử dụng này.
						</div>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="ibox m0">
						<div class="ibox-content">
							<div class="row mb15">
								<div class="col-lg-6">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Địa chỉ</span>
										</label>
										<?php echo form_input('address', htmlspecialchars_decode(html_entity_decode(set_value('address', $moduleDetail['address']))), 'class="form-control " placeholder="" autocomplete="off"');?>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Số điện thoại</span>
										</label>
										<?php echo form_input('phone', htmlspecialchars_decode(html_entity_decode(set_value('phone', $moduleDetail['phone']))), 'class="form-control " placeholder="" autocomplete="off"');?>
									</div>
								</div>
							</div>

							<div class="row mb15">
								<div class="col-lg-6">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Tỉnh/Thành Phố</span>
										</label>
										
										<?php
											if(isset($cityPost) && !empty($cityPost)){
										?>
											<script>
												var cityid = '<?php echo $this->input->post('cityid') ?>';
												var districtid = '<?php echo $this->input->post('districtid') ?>';
												var wardid = '<?php echo $this->input->post('wardid') ?>';
											</script>
										<?php }else{ ?>
											<script>
												var cityid = '<?php echo $moduleDetail['cityid']; ?>';
												var districtid = '<?php echo $moduleDetail['districtid'] ?>';
												var wardid = '<?php echo $moduleDetail['wardid'] ?>';
											</script>
										<?php } ?>

										<div data-id="city" class="js_dropdown_vn" data-name="cityid" data-module="vn_province" data-text="Chọn tỉnh/thành phố" data-key="provinceid" data-value="name" data-query=""></div>


									</div>
								</div>

								<div class="col-lg-6">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Quận/Huyện</span>
										</label>
										<select name="districtid" id="district" class="form-control m-b location">
											<option value="0">Chọn Quận/Huyện</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row mb15">
								<div class="col-lg-6">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Phường xã</span>
										</label>
										<select name="wardid" id="ward" class="form-control m-b location">
											<option value="0">Chọn Phường/Xã</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Ghi chú</span>
										</label>
										<?php echo form_input('description', htmlspecialchars_decode(html_entity_decode(set_value('description', $moduleDetail['description']))), 'class="form-control " placeholder="" autocomplete="off"');?>
									</div>
								</div>
							</div>
							<div class="toolbox action clearfix">
								<div class="uk-flex uk-flex-middle uk-button pull-right">
									<button class="btn btn-primary btn-sm" name="update" value="update" type="submit">Cập nhật</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-sm-12">
					<h3 class="m-b-lg"><b>Lựa chọn quyền cho hồ sơ:</b></h3>
					<?php if(isset($permission) && is_array($permission) && count($permission)){ ?>
						<?php foreach($permission as $keyPermission => $valPermission){  ?>
							<?php if(!isset($valPermission['title']) || empty($valPermission['title'])) continue ?>
							<div class="form-group">
								<label class="col-md-2 control-label text-left">
									<span><?php echo $valPermission['title']; ?></span>
								</label>
								<?php if(isset($valPermission['item']) && is_array($valPermission['item']) && count($valPermission['item'])){ ?>
								<div class="col-md-10">
									<div class="userGroupContainer clearfix">
										<?php foreach($valPermission['item'] as $keyItems => $valItems){ ?>
										<div class="i-checks">
											<label><input name="permission[]" <?php echo (isset($permissionPost) && is_array($permissionPost) && in_array($valItems['param'], $permissionPost))?'checked="checked"':'';?> type="checkbox" value="<?php echo $valItems['param']; ?>"> <i></i> <?php echo $valItems['description']; ?></label>
										</div>
										<?php } ?>
									</div>
								</div>
								<?php } ?>
							</div>
					<?php }} ?>
				</div>
			</div>

		</div>
	</form>
	<?php $this->load->view('dashboard/backend/common/footer'); ?>
</div>
