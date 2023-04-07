
<form method="post" role="form" action="" class="form-horizontal js_update js_load_update">	
<input type="text" name="id" class="hidden" value="<?php echo $moduleDetail['id'] ?>">
<div id="page-wrapper" class="gray-bg dashbard-1">
	<div class="wrapper animated fadeInRight import">
		<div class="row">
            <div class="col-sm-9" style="padding-left:0;padding-right:0;">
                <div class="ibox">
					<div class="ibox-title">
						<h3>Cập nhật đơn xuất hàng
							<small class="text-danger">(Điền đầy đủ các thông tin được hướng dẫn dưới đây.)</small>
						</h3>
					</div>
					<div class="ibox-content">
						<div class="row m-b-xs">
							<div class="col-md-3">
								<div class="input-group icon-left">
									<i class="fa fa-user" aria-hidden="true"></i>
									 <?php echo form_input('customerid', set_value('customerid',$moduleDetail['customerid'] ?? ''), 'class="form-control customerid hidden" ');?>
	                                <?php echo form_input('customer', set_value('customer','Khách hàng: '.($moduleDetail['customer'] ?? '')), 'class="form-control" placeholder="Chọn khách hàng" autocomplete="off" readonly');?>
	                            </div>
							</div>
							<div class="col-md-3">
								<div class="input-group">
	                                 <?php echo form_input('construction_title',set_value('construction_title','Nhóm công trình: '.($moduleDetail['catalogue']?? '')), 'class="form-control" id="" autocomplete="off" placeholder="Tên công trình" readonly');?>
	                            </div>
							</div>
							<div class="col-md-3">
								<div class="input-group">
	                                <?php echo form_input('construction_title',set_value('construction_title','Tên công trình: '.($moduleDetail['title'] ?? '')), 'class="form-control" id="" autocomplete="off" placeholder="Tên công trình" readonly');?>
	                            </div>
							</div>
								<div class="col-md-3">
								<div class="input-group">
	                                <?php echo form_input('code', 'Mã đơn: '.($moduleDetail['code'] ?? ''), 'class="form-control" id="code" autocomplete="off" placeholder="Mã công trình" readonly');?>
	                            </div>
							</div>
						</div>
						<div class="row m-b-xs">
							<div class="col-md-3">
								<div class="input-group icon-left">
									<i class="fa fa-search"></i>
	                                <?php echo form_input('product', '', 'class="form-control" id="product" autocomplete="off" placeholder="Chọn sản phẩm" readonly');?>
	                                <ul id="list-product">
	                                </ul>
	                            </div>
							</div>
							<div class="col-md-3">
								<div class="input-group">
	                                <?php echo form_input('user_charge', 'NVKD: '.($moduleDetail['userid_charge'] ?? ''), 'class="form-control" id="user_charge" autocomplete="off" readonly ');?>
	                            </div>
							</div>
							<div class="col-md-3">
								<div class="input-group">
	                                <?php echo form_input('date_start',set_value('date_start', 'Ngày khởi công: '.($moduleDetail['date_start'] ?? '')), 'class="form-control"  autocomplete="off" readonly ');?>
	                            </div>
							</div>
							<div class="col-md-3">
							</div>
						</div>
						<div style="min-height: 290px! important">
                        	<table class="table">
	                            <thead>
		                            <tr class="">
		                                <th>Mã SP</th>
		                                <th style="width:180px">Tên SP</th>
		                                <th style="width:90px">Đơn vị</th>
		                                <th class="text-right" style="width:80px">Thực dán</th>
		                                <th class="text-right">Đơn giá</th>
	                                	<th class="text-right hidden">Giá trả</th>
		                                <th class="text-right">Thành tiền</th>
		                                <th class="text-right" style="width:80px">Trên phiếu</th>
		                            </tr>
	                            </thead>
	                            <tbody = class="js_content">
		                            <?php if(isset($moduleDetail['data_json']) && is_array($moduleDetail['data_json']) && count($moduleDetail['data_json'])) { ?>
	                            	<?php foreach($moduleDetail['data_json'] as $key => $val){ ?>
		                            <tr>
		                            	<?php 
			                            	$deatail_product= $this->Autoload_Model->_get_where(array(
			                                	'table'=>'product',
			                                	'where'=>array('id'=>$val['id']),
			                                	'select'=>'measure'
			                                ));
			                                $measure=$this->configbie->data('measure', (int)$deatail_product['measure']);
											
		                                 ?>
								        <td class="code">
								        	<?php echo $val['code'] ?>
								        	<?php echo form_input('product[code][]', $val['code'], 'class="form-control hidden"');?>
							        	</td>
								        <td class="title" style="width:250px"><?php echo cutnchar($val['title'],60) ?> 
								       		<?php echo form_input('product[title][]',(isset($val['title'])) ? $val['title'] : 0 , 'class="form-control hidden"');?>
								       		<?php echo form_input('product[id][]',(isset($val['id'])) ? $val['id'] : 0 , 'class="form-control hidden"');?>
								       		<?php echo form_input('product[quantity_closing_stock][]',0 , 'data-id="'.$val['id'].'" class="form-control hidden js_get_quantity_closing_stock"');?>
								       		<?php echo form_input('product[quantity_old][]',(isset($val['quantity'])) ? $val['quantity'] : 0, 'class="form-control hidden"');?>
								        </td>
								        <td class="measure">
								        	<?php echo $measure ?>
								        	<?php echo form_input('product[measure][]',$measure, 'class="form-control hidden"');?>
								        <td>
								        	<div class="input-group">
							        		<?php 
							        			$quantity = (isset($val['quantity'])) ? $val['quantity'] : 0;
							        		 ?>
							        		<?php echo form_input('product[quantity][]',$quantity, ' data-quantity-old="" class="form-control text-right float" placeholder="" 	autocomplete="off"  style="height: 25px"');?>
							           		</div>
								        </td>
								        <td>
								       		<div class="input-group">
								        		<input type="text" name="product[price_output][]" style="height: 25px " value="<?php echo number_format($val['price_output'],0,',','.') ?>" class="text-right form-control" readonly>
								        	</div>
								        </td>
								        
								        <td class="money text-right">
											<?php 
												$val['quantity_paid'] = (isset($val['quantity_paid'])) ? $val['quantity_paid'] : 0;
												$val['quantity'] = (isset($val['quantity'])) ? $val['quantity']: 0;
												$val['quantity_error'] = (isset($val['quantity_error'])) ? $val['quantity_error']: 0;
												echo number_format(($val['quantity']-$val['quantity_paid']-$val['quantity_error'])*$val['price_output'],0,',','.'); 
											?>
								        </td>
								       
								        <td class="trenphieu">
								       		<?php echo form_input('product[trenphieu][]',(isset($val['trenphieu'])) ? $val['trenphieu'] : 0 , 'class="form-control text-right float" placeholder="" 
										autocomplete="off"  style="height: 25px"');?>
								        </td>
								    </tr>
									<?php }} ?>
	                            </tbody>
	                           
	                        </table>
                        </div>
                    </div>
                    <div class="ibox-title	">
                    	<div class="row">
                    		<div class="col-md-6">
                    			<?php echo form_textarea('note', set_value('note',($moduleDetail['export_note'] ?? '' ) ), 'class="form-control m-b-xs" placeholder="Ghi chú đơn xuất" style="height: 70px"  ');?>
                    		</div>
                    		<div class="col-md-6">
                    			<div class="uk-flex uk-flex-space-between font-bold">
                    				<span>Thành tiền</span> 
                    				<span class="total_money"></span>
                    			</div>
                    		</div>
                    	</div>
                    </div>
                    <div class="ibox-title">
						<div class="uk-flex uk-flex-middle uk-flex-space-between">
							<div class="uk-flex uk-flex-middle">
								
							</div>
							<div class="uk-button">
									<button style="margin-right:2px;" class="btn btn-primary btn-sm" name="update" value="create" type="submit">Cập nhật đơn</button>
							</div>
						</div>
					</div>
                </div>
            </div>
            <div class="col-sm-3 m-b-xs" style="padding-right:0;">
        		<div class="ibox-title " >
            		<h3><i class="fa fa-file-text m-r-sm" aria-hidden="true"></i>Tạo phiếu xuất kho</h3>
            	</div>
            	<div class="ibox-content uk-clearfix">
            		<div class="m-b-sm">Thời gian tạo đơn hàng: <?php echo gettime($moduleDetail['created'] ?? '') ?></div>
        			<div class="m-b-sm">Thời gian xuất hàng: <?php echo $detailData['time_finish']  ?? '' ;?></div>
					
            	</div>
            </div>
        </div>
	</div>
</div>
</form>
