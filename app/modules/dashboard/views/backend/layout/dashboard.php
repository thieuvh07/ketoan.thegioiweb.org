
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<base href="<?php echo BASE_URL; ?>">
    <title>HT CMS | Dashboard</title>
	<link rel="shortcut icon" href="template/favicon.ico" type="image/x-icon">

    <link href="template/backend/css/bootstrap.min.css" rel="stylesheet">
    <link href="template/backend/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="template/backend/css/plugins/toastr/toastr.min.css" rel="stylesheet">
	<link href="template/backend/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
	<link href="plugin/jquery-ui.css" rel="stylesheet">

	<link href="plugin/select2/dist/css/select2.min.css" rel="stylesheet" />

    <link href="template/backend/css/animate.css" rel="stylesheet">
    <link href="template/backend/css/customize.css" rel="stylesheet">

	<link href="template/backend/css/plugins/iCheck/custom.css" rel="stylesheet">
	<link href="template/backend/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

	<link href="template/backend/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

	<link href="template/backend/css/plugins/dropzone/basic.css" rel="stylesheet">
    <link href="template/backend/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
	<link href="template/backend/css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">

	<link rel="stylesheet" href="plugin/datetimepicker/build/jquery.datetimepicker.min.css">
    <link href="template/backend/css/style.css" rel="stylesheet">
	<!-- <script src="https://unpkg.com/react@16/umd/react.development.js" crossorigin></script> -->
	<!-- <script src="https://unpkg.com/react-dom@16/umd/react-dom.development.js" crossorigin></script> -->
	<!-- <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script> -->

	<script src="plugin/jquery-3.3.1.min.js"></script>
	<script src="plugin/ckeditor/ckeditor.js" charset="utf-8"></script>
	<script src="template/backend/js/plugins/iCheck/icheck.min.js"></script>


 	<script>
		var BASE_URL = '<?php echo BASE_URL; ?>';
	</script>

</head>
<body>
	<?php if(!isset($isSidebar) || $isSidebar == true){ ?>
		<?php $this->load->view('dashboard/backend/common/sidebar'); ?>
	<?php }?>
    <div id="wrapper">
		<?php $this->load->view((isset($template)) ? $template : ''); ?>
    </div>
    <?php $this->load->view('dashboard/backend/common/right-sidebar'); ?>
	<?php $this->load->view('dashboard/backend/common/notification'); ?>

	<div class="lds-css ng-scope loading" style="display: none"><div class="lds-eclipse"><div></div></div></div>

	

	<script type="text/javascript" src = "plugin/datetimepicker/build/jquery.datetimepicker.full.js"></script>
	<!-- menu sidebar -->
	<script src="template/backend/js/plugins/metisMenu/jquery.metisMenu.js"></script>
	<!-- other -->
	<script src="template/backend/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- GENERAL SCRIPT -->
    <script src="template/backend/js/bootstrap.min.js"></script>
    <script src="template/backend/js/inspinia.js"></script>
	<script src="template/backend/js/plugins/toastr/toastr.min.js"></script>
	<script src="template/backend/js/plugins/sweetalert/sweetalert.min.js"></script>
	<script src="plugin/select2/dist/js/select2.min.js"></script>
	<script src="template/backend/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

	<script src="template/backend/js/plugins/datapicker/bootstrap-datepicker.js"></script>
	<!-- Jasny -->
    <script src="template/backend/js/plugins/jasny/jasny-bootstrap.min.js"></script>
	<script src="template/backend/js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
	<script src="template/backend/js/plugins/clockpicker/clockpicker.js"></script>

	<!-- autocomplete -->
	<script src="template/backend/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>

	
	
	<?php
		
		$auth = $this->auth;
		unset($auth['permission']);
		unset($auth['permissionCata']);
	?>
	<script>
		var base_url = '<?php echo BASE_URL ?>';
		var api_url = '<?php echo API_URL ?>';

		var usercata_id_extension = 29 
		
		var json_auth = '<?php echo json_encode($auth) ?>';
		$('.tagsinput').tagsinput({
            tagClass: 'label custom-tagsinput'
        });
	</script>

	<script src="template/backend/libraryjs/function.js"></script>
	
	<?php if(isset($script) && !check_array($script)){ ?>
    	<script src="template/backend/libraryjs/<?php echo $script ?>.js" ></script>
	<?php } ?>

	<?php if(isset($script) && check_array($script)){ ?>
		<?php foreach ($script as $key => $value) {?>
    	<script src="template/backend/libraryjs/<?php echo $value ?>.js" ></script>
		<?php } ?>
	<?php } ?>
	
	<?php (DEBUG == 1)?$this->output->enable_profiler(TRUE):'';?>
</body>
</html>
