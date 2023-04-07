<form method="post" action="" class="form-horizontal box" enctype="multipart/form-data">
<?php echo form_dropdown('parentid', $this->nestedsetbie->dropdown(), set_value('parentid'), 'class="form-control m-b select3"');?>
<!-- VALIDATE FORM -->
<?php 
	$this->form_validation->set_rules('catalogueid', 'Danh mục chính', 'trim|is_natural_no_zero');
 ?>
<!--  INPUT -->
<?php echo form_input('name', set_value('name'), 'class="form-control" placeholder="" autocomplete="off"');?>

<!-- NGÀY THÁNG/ DATETIME -->
<?php echo form_input('birthday', set_value('birthday'), 'class="form-control" data-mask="99/99/9999" placeholder="dd/mm/Y"');?>

<!-- DROPDOWN -->
<?php $dropdown = $this->configbie->data('quantity_month') ?>
<?php 
	$dropdown = $this->common->dropdown(array(
		'table' => 'contract_catalogue',
		'text' => 'Chọn nhóm hợp đồng',
		'query' => $this->queryCommon,
	));
?>
<?php echo form_dropdown('catalogueid', $dropdown, set_value('catalogueid', $moduleDetail['catalogueid'] ?? ''), 'class="form-control js_select_catalogue"');?>

<!-- AUTO COMPLELTE -->
<?php echo form_input('price', set_value('price'), 'class="form-control"  data-provide="typeahead" data-source=\'["item 1","item 2","item 3"]\' placeholder="item..." autocomplete="off"');?>

<!-- CHECKBOX -->
<div class="i-checks"><label> 
	<input class="" type="checkbox" checked value="persion" name="customer_type"> Cá nhân
</label></div>

<!-- RADIO -->
<div class="i-checks"><label> 
	<input class="" type="radio" checked value="persion" name="customer_type" <?php echo set_radio('customer_type', 'persion', (isset($post['customer_type']) && $post['customer_type'] == 'persion') ? true : false ); ?> > Cá nhân
</label></div>
<div class="i-checks"><label> 
	<input type="radio" <?php echo set_radio('customer_type', 'company', (isset($post['customer_type']) && $post['customer_type'] == 'company') ? true : false ); ?>  class="" required value="company" name="customer_type"> Doanh nghiệp 
</label></div>

<div>
	target="_blank"
	style="";
	style="<?php echo $val['title'] ?>";

	content: '\f0d7';      caret fown
	content: '\f015';       home
	content: '\f095';       : phone
	content: '\f164';       thumb like
	content: '\f004';       heart
	content: '\f1e0';       share
	content: '\f099';       tiwew
	content: '\f030';      camera
	content: '\f075';       comment
	&nbsp;&nbsp;&nbsp;&nbsp;
</div>