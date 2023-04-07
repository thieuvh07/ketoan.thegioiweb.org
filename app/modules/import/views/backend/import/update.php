<form method="post" role="form" action="" class="form-horizontal js_update js_load_update">
<input type="text" class="hidden" value="<?php echo $moduleDetail['id'] ?>" name = "id">	
<div id="page-wrapper" class="gray-bg dashbard-1">
	<div class="wrapper animated fadeInRight import">
		<div class="row">
            <div class="col-sm-12" style="padding-left:0;padding-right:0;">
                <div class="ibox">
					<div class="ibox-title uk-flex uk-flex-middle uk-flex-space-between">
						<h3>Cập nhật đơn nhập hàng
							<small class="text-danger">(Điền đầy đủ các thông tin được hướng dẫn dưới đây.)</small>
						</h3>
					</div>
					<div class="ibox-content">
						<div class="box-body">
							<?php $error = validation_errors(); echo !empty($error)?'<div class="alert alert-danger">'.$error.'</div>':'';?>
						</div><!-- /.box-body -->
						<div class="row m-b-xs">
							<div class="col-md-3">
								<div class="input-group icon-left">
									<i class="fa fa-user" aria-hidden="true"></i>
									<div class="js_dropdown" data-name="supplierid" data-module="supplier" data-text="Chọn NCC" data-value="title" data-disabled="true" data-checked="<?php echo $moduleDetail['supplierid'] ?>"></div>
	                                <ul id="list-supplier">
	                                </ul>
	                            </div>
							</div>
							<div class="col-md-3">
								<div class="input-group icon-left">
									<i class="fa fa-search"></i>
	                                <?php echo form_input('product', '', 'class="form-control " autocomplete="off"   placeholder="Chọn sản phẩm"');?>
	                                <ul id="list-product">
	                                </ul>
	                            </div>
							</div>
							<div class="col-md-3">
								<div class="input-group">
	                               <?php echo form_input('code', 'Mã đơn: '.$moduleDetail['code'], 'class="form-control " placeholder="Mã đơn nhập hàng" autocomplete="off" readonly');?>
	                            </div>
	                        </div>
							<div class="col-md-3">
								<div class="input-group width-100">
	                                <?php echo form_input('date_start',set_value('date_start', gettime($moduleDetail['date_start'] ?? '', 'd-m-Y')), 'class="form-control datetimepicker" placeholder="Chọn ngày khởi công"  autocomplete="off" ');?>
	                            </div>
							</div>
						</div>
						<div style="min-height: 290px! important">
							<div class="m-b"> Ngày: <?php echo gettime($moduleDetail['created']) ?></div>
                        	<table class="table">
	                            <thead>
		                            <tr class="">
		                                <th style="width:70px">Mã SP</th>
		                                <th>Tên SP</th>
		                                <th style="width:70px">SL nhập</th>
		                                <th style="width:70px">Đơn vị nhập</th>
		                                <th style="width:70px">SL quy đổi</th>
		                                <th style="width:70px">Đơn vị bán</th>
		                                <th style="width:100px">Giá nhập</th>
		                                <th style="width:100px">Thành tiền</th>
		                                <th style="width:20px"></th>
		                            </tr>
	                            </thead>
	                            <tbody class="js_content">
		                            <?php if(isset($moduleDetail['rela']) && is_array($moduleDetail['rela']) && count($moduleDetail['rela'])) { ?>
	                            	<?php foreach($moduleDetail['rela'] as $key => $val){ ?>
		                            <tr>
		                            	<?php 
			                            	$detail_product= $this->Autoload_Model->_get_where(array(
			                                	'table'=>'product',
			                                	'where'=>array('id'=>$val['productid']),
			                                	'select'=>'id, code, title, measure, price_input'
			                                ));
		                                ?>
								        <td><?php echo $detail_product['code'] ?></td>
								        <td><?php echo cutnchar($detail_product['title'], 73) ?> 
								        	<input type="text"  name="product[id][]" value="<?php echo $detail_product['id'] ?>" class="hidden">
								        </td>
								        <td>
								        	<div class="input-group">
								        		<input type="text" style="height: 25px " name="product[quantity_import][]" value="<?php echo $val['quantity_import'] ?? '' ?>" class="float text-right form-control" autocomplete="off">
								            </div>
								        </td>
								        <td>
								        	<div class="input-group">
								        		<input type="text" style="height: 25px " name="product[measure_import][]" value="<?php echo $val['measure_import'] ?>" class="text-right form-control" autocomplete="off">
								            </div>
								        </td>
								        <td>
								        	<div class="input-group">
								        		<input type="text" style="height: 25px " name="product[quantity][]" value="<?php echo $val['quantity'] ?>" class="float text-right form-control" autocomplete="off">
								            </div>
								        </td>
								        <td>
								        	<?php echo $this->configbie->data('measure',$detail_product['measure'])  ?>
								       	</td>
								        
								        <td>
								       		<div class="input-group">
								        		<input type="text" name="product[price][]" style="height: 25px" value="<?php echo number_format($val['price'],0,',','.') ?>" class="text-right form-control" autocomplete="off">
								        	</div>
								        </td>
								        <td>
											<div class="input-group">
								        		<input type="text" name="product[money][]" style="height: 25px"  value="<?php echo number_format($val['quantity']*$val['price'],0,',','.') ?>" class="text-right form-control" autocomplete="off"  readonly>
								            </div>
								        </td>
								        <td class="trash text-danger"> </td>
								    </tr>
									<?php }} ?>
	                            </tbody>
	                        </table>
                        </div>
                    </div>
                    <div class="ibox-title	">
                    	<div class="row">
                    		<div class="col-md-6">
                    			<?php echo form_textarea('note', set_value('note',$moduleDetail['note']), 'class="form-control m-b-xs" placeholder="Ghi chú đơn nhập" style="height: 70px"  ');?>
                    		</div>
                    		<div class="col-md-6">
                    			<div class="uk-flex uk-flex-space-between font-bold">
                    				<span>Thành tiền</span>
                    				<span class="total_money"><?php echo $moduleDetail['total_money'] ?></span>
                    			</div>
                    		</div>
                    	</div>
                    </div>
                    <div class="ibox-title">
						<div class="uk-flex uk-flex-middle uk-flex-space-between">
							<div class="uk-flex uk-flex-middle">
								
							</div>
							<div class="uk-button">
								<!-- <button style="margin-right:2px;" class="btn btn-primary btn-sm" name="update" value="create" type="submit">Cập nhật đơn</button> -->
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
	</div>
</div>
</form>
