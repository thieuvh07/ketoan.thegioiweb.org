<style>
	@media print {
		table td{
			border:1px solid #000;
		}
		*{
			font-family:'Time News Roman' !important;
			font-size:16px !important;
		}
		.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
			border-top: 1px solid #000 !important;
		}
		.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td{
			border: 1px solid #000 !important;
		}
		table{
			font-size:16px !important;
		}
	}
</style>
<div id="page-wrapper" class="gray-bg dashbard-1 js_load_view"  style="margin-left: 0px">
	 <div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Chi tiết nhóm thợ</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo site_url('admin'); ?>">Home</a>
				</li>
				<li class="active"><strong>Chi tiết lương</strong></li>
			</ol>
		</div>
	</div>
	<div class="box-header">
		
	</div><!-- /.box-header -->
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
			<div class="ibox float-e-margins">
				
				<div class="ibox-content">
					<form action="" method="get" id="form">
						<div class="uk-flex uk-flex-middle uk-flex-space-between m-b-sm">
							<div class="">
								<div class="js_dropdown" data-name="periodicid" data-module="periodic" data-key="id" data-value="title"></div>
							</div>
							<div class="uk-button">
							</div>
						</div>
					</form>
					
					<div id="print">
						<div class="row">
							<div class="col-sm-12 js_content">
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
	<div class="row"><div class="col-lg-12"><div class="ibox float-e-margins"><div class="ibox-content">
	<h2 class="text-center">Bảng danh sách công trình trong kì</h2>
	<table class="table table-striped table-bordered table-hover dataTables-example js_content_construction">
		
	</table>
	<h2 class="text-center">Bảng ứng lương của nhân viên trong kì</h2>
	<table class="table table-striped table-bordered table-hover dataTables-example js_content_cash">
		
	</table>
	</div></div></div></div>
	<?php $this->load->view('dashboard/backend/common/footer'); ?>
</div>
<script>
	function printDiv(divName) {
		 var printContents = document.getElementById(divName).innerHTML;
		 var originalContents = document.body.innerHTML;
		 document.body.innerHTML = printContents;
		 window.print();
		 document.body.innerHTML = originalContents;
	}
</script>