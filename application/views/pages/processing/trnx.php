<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$cfrom = substr($pperiod['cfrom'],8,2);
$cto = substr($pperiod['cto'],8,2);
$pperiod = $pperiod['pperiod'];
$fullname = $info['FULLNAME'];
$driver_id = $info['driver_id'];
$unit = $info['unit'];
$plate_no =  $info['plate_number'];
$company_name = $info['company_name'];
$refno = $info['refno'];
?>

<br>
<div class="row" id="trnxForm">
    <!-- <div class="col-md-12"> -->
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-12">
                        <h3 class="page-header"><?php echo strtoupper($fullname); ?></h3>
                    </div>
                    <div class="col-md-5"> 
                        <ul class="list-unstyled">
                            <li>
                                <ul class="list-inline">
                                    <input type="hidden" id="driver_id" value="<?php echo $driver_id; ?>">
                                    <li style="width:80px;"><strong>ID:</strong></li>
                                    <li style="display: inline;"><?php echo $driver_id; ?></li>     
                                </ul>
                                <ul class="list-inline">
                                    <li style="width:80px;"><strong>UNIT:</strong></li>
                                    <li style="display: inline;"><?php echo $unit; ?></li>     
                                </ul>
                                <ul class="list-inline">
                                    <li style="width:80px;"><strong>PLATE #.:</strong></li>
                                    <li style="display: inline;"><?php echo $plate_no;?></li>     
                                </ul>
                            </li>       
                        </ul>
                    </div>
                    <div class="col-md-7">
                        <ul class="list-unstyled">
                            <li>
                                <ul class="list-inline">
                                    <li style="width:110px;"><strong>COMPANY:</strong></li>
                                    <li style="display: inline;"><?php echo $company_name;?></li>     
                                </ul>
                                <ul class="list-inline">
                                    <input type="hidden" id="pperiod" value="<?php echo $pperiod; ?>">
                                    <li style="width:110px;"><strong>PERIOD:</strong></li>
                                    <li style="display: inline; color: #C21807;"><strong><?php echo $pperiod; ?></strong></li>     
                                </ul>
                                <ul class="list-inline">
                                    <li style="width:110px;"><strong>REFERENCE #.:</strong></li>
                                    <li style="display: inline;"><?php echo $refno; ?></li>     
                                </ul>
                            </li>       
                        </ul>
                    </div>
                </div>             

                <div id="nav-body"></div>

                <div id="confirmdialog" class="confirmdialog">
                    <p id="confirmdialogbody"></p>    
                </div>
</div>

<script>
    const __navs = {
        self: "",
        initialize: function () {
            self = this;
            self.events();

            $('a[data-toggle="tab"]').parent().on('show.bs.tab', function(e) {
                localStorage.setItem('activeTab', $(e.currentTarget).attr('id'));
            });

            var activeTab = localStorage.getItem('activeTab');
            if(activeTab){
                $('#'+activeTab).find('a').click();
            }

        },

        events: function () {
            $('#nav-body').navs({
                items: ["Regular Trips","Combined Trips","Special Trips","Manual Trips"],
                link:  ["loadRegularForm","loadExtendedForm","loadSpecialForm","loadManualForm"],
            });
            // $('#confirmdialog').dialog({
            //     dialogClass: 'no-close',
            //     autoOpen: false,
            //     resizable: false,
            //     modal: true,
            //     width: 'auto',
            //     closeOnEscape: false,
            // });
        },

        opendialog: function (dialogheader = '', dialogbody = '') {
            $(".no-close .ui-button-text:contains('Accept')").text('Yes');
            $(".no-close .ui-button-text:contains('Decline')").text('No');
            $('#confirmdialogbody').html(dialogbody);
            $('#confirmdialog').dialog('open');
            $('#confirmdialog').dialog("option", "title", dialogheader);
            
            // this.loadEvents();
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
        },

        // loadEvents: function(){
        //     console.log("TEST")
        //     $("#trnxform").find('.nav nav-tabs').on('click', function(){
        //             var activeTab = localStorage.getItem('activeTab');
        //             if(activeTab){
        //                 var tabnum = activeTab.slice(-1);
        //                 console.log(tabnum)
        //                 console.log($('#nav-body_li_menu0 a[href="' + activeTab + '"]'))
        //             }
        //         }
        //     );
        // },

        
    };
    __navs.initialize();


</script>