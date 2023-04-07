<div id="page-wrapper" class="gray-bg js_load_view">
    <div class="row border-bottom">
        <?php $this->load->view('dashboard/backend/common/header'); ?>
    </div>
    <div class="wrapper wrapper-content">
        <div class="uk-flex uk-flex-middle uk-flex-space-between m-b-sm">
            <div class="">
                <div class="js_dropdown" data-name="periodicid" data-module="periodic" data-key="id" data-value="title"></div>
            </div>
            <div class="uk-button">
            </div>
        </div>
       <!--     <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right">Tháng</span>
                        <h5>Tổng số đơn hàng mới</h5>
                    </div>
                    <div class="ibox-content">
                    	
                        <h1 class="no-margins"></h1>
                        <div class="stat-percent font-bold text-success"><i class="fa fa-bolt"></i></div>
                        <small>Đơn hàng</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Tổng số đơn hàng trong tháng</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"></h1>
                        <small>Đơn hàng</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Tổng số sản phẩm</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"></h1>
                        <small>Sản phẩm</small>
                    </div>
                </div>
            </div>
            
        </div> -->

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                     <div id="morris-bar-chart"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- orris -->
    <link href="template/backend/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
<!-- Morris -->
<script src="template/backend/js/plugins/morris/raphael-2.1.0.min.js"></script>
<script src="template/backend/js/plugins/morris/morris.js"></script>
<script>
    
</script>