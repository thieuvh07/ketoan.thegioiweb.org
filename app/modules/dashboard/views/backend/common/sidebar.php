
<nav class="navbar-default navbar-static-side" role="navigation">
	<div class="sidebar-collapse">
		<ul class="nav metismenu" id="side-menu">
			<li class="nav-header">
				<div class="dropdown profile-element"> <span>
					<img alt="image" class="img-circle" style="height:50px;" src="<?php echo getthumb($this->auth['avatar'], false); ?>" />
				</span>
				<a data-toggle="dropdown" class="dropdown-toggle" href="#">
					<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold" style="color:#fff;font-weight:500;"><?php echo $this->auth['fullname']; ?></strong>
					</span> <span class="text-muted text-xs block"><?php echo implode($this->auth['titleCata'] ?? [], ','); ?> <b style="color:#8095a8;" class="caret"></b></span> </span> </a>
					<ul class="dropdown-menu animated fadeInRight m-t-xs">
						<li><a href="<?php echo site_url('user/backend/account/profile'); ?>">Hồ sõ cá nhân</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo site_url('user/backend/auth/logout'); ?>">Ðăng xuất</a></li>
					</ul>
				</div>
				<div class="logo-element">
					HT+
				</div>
			</li>
			<li class="landing_link">
				<a href="dashboard/home/statistical"><i class="fa fa-star"></i> <span class="nav-label">Dashboard</span> </a>
			</li>

			
			
			<li class="<?php echo ($this->router->module == 'periodic') ? 'active' : '' ?>">
				<a href="<?php echo site_url('periodic/backend/periodic/view'); ?>"><i class="fa fa-calendar"></i> <span class="nav-label">Quản lý kì</span> </a>
			</li>

			<li class="<?php echo ($this->router->module == 'user') ? 'active' : '' ?>">
				<a href="#"><i class="fa fa-user"></i> <span class="nav-label">QL Nhân sự</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level collapse">
					<li><a href="<?php echo site_url('user/backend/catalogue/view'); ?>">Bộ phận (phòng ban) </a></li>
					<li><a href="<?php echo site_url('user/backend/user/view'); ?>">Nhân sự</a></li>
				</ul>
			</li>

			<li class="<?php echo ($this->router->module == 'salary') ? 'active' : '' ?>">
				<a href=""><i class="fa fa-book" aria-hidden="true"></i> <span class="nav-label">BCTH</span> <span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li><a href="<?php echo site_url('salary/backend/salary/timekeeping') ?>">Chấm công</a></li>
					<li><a href="<?php echo site_url('salary/backend/salary/view') ?>">QL Lương nhân viên</a></li>
					<li><a href="<?php echo site_url('salary/backend/salary/BCTH') ?>">QL BCTH</a></li>
				</ul>
			</li>

			<li class="<?php echo ($this->router->module == 'cash') ? 'active' : '' ?>">
				<a href=""><i class="fa fa-money"></i> <span class="nav-label">QL Tiền mặt</span> <span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li><a href="<?php echo site_url('cash/backend/cash/view') ?>">QL Tiền mặt</a></li>
					<li><a href="<?php echo site_url('cash/backend/catalogue/view') ?>">QL Nhóm tiền mặt</a></li>
					<li><a href="<?php echo site_url('cash/backend/common/view') ?>">QL Thu chi mặc định</a></li>
				</ul>
			</li>

			<li class="<?php echo ($this->router->module == 'accountant') ? 'active' : '' ?>">
				<a href="<?php echo site_url('accountant/backend/accountant/view'); ?>"><i class="fa fa-building"></i> <span class="nav-label">KTVP</a>
			</li>
			
			<li class="<?php echo ($this->router->module == 'supplier'||$this->router->module == 'customer') ? 'active' : '' ?>">
				<a href="<?php echo site_url('supplier/backend/supplier/view'); ?>"><i class="fa fa-handshake-o" aria-hidden="true"></i><span class="nav-label">QL Đối tác</span> </a>
			</li>

			<?php 
				$class = '';
				$temp = array(
					'construction/backend/catalogue/view',
					'construction/backend/catalogue/create',
					'construction/backend/catalogue/update',
					'construction/backend/construction/view',
					'construction/backend/construction/create',
					'construction/backend/construction/update',
				);
				if(in_array($this->router->uri->uri_string, $temp)){
					$class = 'active';
				}
			 ?>
			<li class="<?php echo $class ?? '' ?>">
				<a href="<?php echo site_url('construction/backend/construction/view'); ?>"><i class="fa fa-building"></i> <span class="nav-label">Đơn hàng</span> <span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li><a href="<?php echo site_url('construction/backend/catalogue/view')?>">QL Nhóm công trình</a></li>
					<li><a href="<?php echo site_url('construction/backend/construction/view')?>">QL Đơn hàng</a></li>
				</ul>
			</li>
			<?php 
				$class = '';
				$temp = array(
					'product/backend/catalogue/view',
					'product/backend/catalogue/create',
					'product/backend/catalogue/update',
					'product/backend/product/view',
					'product/backend/product/create',
					'product/backend/product/update',
				);
				if(in_array($this->router->uri->uri_string, $temp)){
					$class = 'active';
				}
			 ?>
			<li class="<?php echo $class ?? '' ?>">
				<a href="<?php echo site_url('product/backend/product/view'); ?>"><i class="fa fa-diamond"></i> <span class="nav-label">Quản lý sản phẩm</span> <span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li class=""><a href="<?php echo site_url('product/backend/catalogue/view') ?>">QL Nhóm sản phẩm</a></li>
					<li><a href="<?php echo site_url('product/backend/product/view') ?>">QL Sản phẩm</a></li>
				</ul>
			</li>
			
			<?php 
				$class = '';
				$temp = array(
					'construction/backend/export/view',
					'construction/backend/export/create',
					'construction/backend/export/update',
					'import/backend/import/view',
					'import/backend/import/create',
					'import/backend/import/update',
					'repay/backend/repay/view',
					'repay/backend/repay/create',
					'repay/backend/repay/update',
					'product/backend/product/month',
				);
				if(in_array($this->router->uri->uri_string, $temp)){
					$class = 'active';
				}
			 ?>
			<li class="<?php echo $class ?? '' ?>">
				<a href="<?php echo site_url('import/backend/import/view'); ?>"><i class="fa fa-home"></i> <span class="nav-label">Quản lý kho</span> <span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li><a href="<?php echo site_url('construction/backend/export/view') ?>">Xuất hàng</a></li>
					<li><a href="<?php echo site_url('import/backend/import/view') ?>">Nhập hàng</a></li>
					<li><a href="<?php echo site_url('repay/backend/repay/view') ?>">Trả hàng</a></li>
					<li><a href="<?php echo site_url('product/backend/product/month') ?>">Sản phẩm trong kì</a></li>
				</ul>
			</li>
		</ul>
	</div>
</nav>

