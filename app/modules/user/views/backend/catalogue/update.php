<div id="page-wrapper" class="gray-bg dashbard-1 js_load_update">
	<div class="row border-bottom">
		<?php $this->load->view('dashboard/backend/common/navbar'); ?>
	</div>
	 <div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Cập nhật Bộ phận (phòng ban) </h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Cập nhật Bộ phận (phòng ban) </strong></li>
			</ol>
		</div>
	</div>
	<div class="wrapper wrapper-content animated fadeInRight">
		<form method="post" action="" class="form-horizontal js_update">
			<input type="text" name="id" class="hidden" value="<?php echo $moduleDetail['id'] ?>">
			<div class="row">
				<div class="box-body">
					<?php $error = validation_errors(); echo !empty($error)?'<div class="alert alert-danger">'.$error.'</div>':'';?>
				</div><!-- /.box-body -->
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="ibox float-e-margins">
						<div class="ibox-title">
							<div class="toolbox">
								<div class="uk-flex uk-flex-middle uk-flex-space-between">
									<h5>Thông tin cơ bản <small class="text-danger">(Điền đầy đủ các thông tin được hướng dẫn dưới đây.)</small></h5>
									<div class="uk-button">
										<button style="margin-right:2px;" class="btn btn-primary btn-sm" name="update" value="create" type="submit">Cập nhật Bộ phận (phòng ban) </button>
									</div>
								</div>
							</div>
						</div>
						<div class="ibox-content">
								<div class="form-group">
									<label class="col-md-2 control-label text-left">
										<span>Tên nhóm người dùng</span>
									</label>
									<div class="col-md-10">
										<?php echo form_input('title', set_value('title', ((isset($moduleDetail['title'])) ? $moduleDetail['title'] : '')), 'class="form-control static-link" placeholder="" autocomplete="off"');?>
										<?php echo form_hidden('title_original', set_value('title_original', $moduleDetail['title']), 'class="form-control" placeholder="" autocomplete="off"');?>
									</div>
								</div>
								
								<div class="hr-line-dashed"></div>
								<?php 
									$dir = 'app/modules';
									$folder = scandir($dir);
									$permission = $this->input->post('permission');
									if(!isset($permission) || is_array($permission) == false || count($permission) == 0){
										$permission = json_decode($moduleDetail['permission']);
									}
								?>
								<?php if(isset($folder) && is_array($folder) && count($folder)){  ?>
								<?php foreach($folder as $keyFolder=> $valFolder){ ?>
								<?php if(in_array($valFolder, array('.', '..'))) continue; ?>
								<?php if(!file_exists($dir.'/'.$valFolder.'/config.xml')) continue; ?>
								<?php 
									$xml = simplexml_load_file($dir.'/'.$valFolder.'/config.xml') or die('Error: Cannot create object '.$dir.'/'.$valFolder.'/config.xml');  
									$xml = json_decode(json_encode((array)$xml), TRUE);
								?>
								<?php if(isset($xml['permissions']) && is_array($xml['permissions']) && count($xml['permissions'])){ ?>
								<?php foreach($xml['permissions'] as $keyPermission => $valPermission){   ?>
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
												<label><input name="permission[]" <?php echo (isset($permission) && is_array($permission) && in_array($valItems['param'], $permission))?'checked="checked"':'';?> type="checkbox" value="<?php echo $valItems['param']; ?>"> <i></i> <?php echo $valItems['description']; ?></label>
											</div>
											<?php } ?>
										</div>
									</div>
									<?php } ?>
								</div>
								<div class="hr-line-dashed"></div>
								<?php }}}} ?>
								
								<div class="hr-line-dashed"></div>
								<div class="toolbox action clearfix">
									<div class="uk-flex uk-flex-middle uk-button pull-right">
										<button class="btn btn-primary btn-sm" name="update" value="update" type="submit">Cập nhật Bộ phận (phòng ban) </button>
									</div>
								</div>
						</div>
					</div>
				</div>
			</div>
			
		</form>
	</div>
	<?php $this->load->view('dashboard/backend/common/footer'); ?>
</div>
