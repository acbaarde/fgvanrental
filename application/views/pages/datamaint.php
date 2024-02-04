<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h4>Data Maintenance</h4>

    <!-- <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
          <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
          <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
        <span data-feather="calendar"></span>
        This week
        </button>
    </div> -->
</div>

<?php $segment = $this->uri->segment(3);?>

<div class="row">
    <div class="col-md-12">
        
        <ul class="nav nav-tabs nav-justified">
            <li class="nav-item">
                <a <?php echo (($segment==''||$segment=='view') ? ' class="nav-link active"':  ' class="nav-link"');?> href="<?php echo base_url('datamaint/view');?>">Drivers</a>
            </li>
            <li class="nav-item">
                <a <?php echo $segment=='operators' ? ' class="nav-link active"':  ' class="nav-link"';?> href="<?php echo base_url('datamaint/view/operators');?>">Operators</a>
            </li>
            <li class="nav-item">
                <a <?php echo $segment=='routes' ? ' class="nav-link active"':  ' class="nav-link"';?> href="<?php echo base_url('datamaint/view/routes');?>">Routes</a>
            </li>
            <li class="nav-item">
                <a <?php echo $segment=='vehicles' ? ' class="nav-link active"':  ' class="nav-link"';?> href="<?php echo base_url('datamaint/view/vehicles');?>">Vehicles</a>
            </li>
            <li class="nav-item">
                <a <?php echo $segment=='company' ? ' class="nav-link active"':  ' class="nav-link"';?> href="<?php echo base_url('datamaint/view/company');?>">Company</a>
            </li>
            <li class="nav-item">
                <a <?php echo $segment=='periods' ? ' class="nav-link active"':  ' class="nav-link"';?> href="<?php echo base_url('datamaint/view/periods');?>">Periods</a>
            </li>
            <li class="nav-item">
                <a <?php echo $segment=='department' ? ' class="nav-link active"':  ' class="nav-link"';?> href="<?php echo base_url('datamaint/view/department');?>">Department</a>
            </li>
        </ul>
        <div class="tab-content">
            <?php $this->load->view( ($segment == '' || $segment=='view') ? 'pages/datamaint/drivers' : 'pages/datamaint/'.$segment);?>
        </div>

    </div>
</div>


<!-- <div id="nav-body"></div>

<div id="confirmdialog" class="confirmdialog">
    <p id="confirmdialogbody"></p>    
</div>

<script>
    const __navs = {
        self: "",
        initialize: function () {
            self = this;
            self.events();
        },

        events: function () {
            $('#nav-body').navs({
                items: ["Drivers","Operators","Routes","Vehicles","Company","Periods"],
                link:  ["datamaint/loadDrivers","datamaint/loadOperators","datamaint/loadRoutes","datamaint/loadVehicles","datamaint/loadCompany","datamaint/loadPeriods"],
            });
        },

        opendialog: function (dialogheader = '', dialogbody = '') {
            $(".no-close .ui-button-text:contains('Accept')").text('Yes');
            $(".no-close .ui-button-text:contains('Decline')").text('No');
            $('#confirmdialogbody').html(dialogbody);
            $('#confirmdialog').dialog('open');
            $('#confirmdialog').dialog("option", "title", dialogheader);
        },

        dialog_execute: function (yes, no) {
            $('#confirmdialog').dialog({
                buttons: {
                    'Yes': function() {
                        $('#confirmdialog').dialog('close');
                        if(yes != undefined) {
                            yes.call();
                        }
                    },
                    'No': function() {
                        $('#confirmdialog').dialog('close');
                        if(no != undefined) {
                            no.call();
                        }
                    }
                }
            });
        }

    };
    __navs.initialize();
</script> -->