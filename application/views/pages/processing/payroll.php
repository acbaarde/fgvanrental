<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h4>Process Payroll</h4>
    <!-- <div class="btn-toolbar mb-2 mb-md-0">
    	<div class="form-vertical">
    		<div class="form-group">
    			<select id="myear"><option selected value>Please select Year...</option></select>
    			<select id="mcompany"><option selected value>Please select Company...</option></select>
		    	<select id="mperiod"><option selected value>Please select Period...</option></select>
    		</div>
    	</div>
    </div> -->
</div>

<div class="row" id="payrollForm">
    <div class="col-md-12">
        <div class="form-horizontal">
            <div class="form-group row">
                <div class="col-md-8 alert alert-info" role="alert" style="margin-bottom: 0;">
                    <i class="fa fa-exclamation">&nbsp;Important Reminders:</i> 
                    <p style="margin-bottom: 0;">Payroll processing is done only once. All adjustments after the successfull process will be done on the next payroll period.
                        Please check the PERIOD carefully!!!</p>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-8" id="alert_id"></div>
            </div>
            <div class="form-group row">
                <div class="col-md-2">
                    PERIOD:
                </div>
                <div class="col-md-6">
                    <select id="mperiod" class="form-control form-control-sm"></select>
                </div>
            </div>
            <!-- <div class="form-group row">
                <div class="col-md-2">
                    COMPANY:
                </div>
                <div class="col-md-6">
                    <select id="mcompany" class="form-control form-control-sm"></select>
                </div>
            </div> -->
            <div class="form-group row">
                <div class="col-md-2">
                  
                </div>
                <div class="col-md-6">
                    <input id="btnProcess" type="button" class="btn btn-primary btn-sm form-control form-control-sm" value="Process"></input>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    var payrollform = $("#payrollForm");
    const __payroll = {
        initialize: function(){
            const self = this;
            this.loadForm();
        },

        loadForm: function(){
            const self = this;
    
            // $.ajax({
            //     url: '',
            //     type: 'post',
            //     dataType: 'json',
            //     async: false,
            //     success: function(result){
            //         const obj = result;
            //         var p_list = [];
            //         p_list.push("<option selected value>Please select Company...</option>");
            //         $.each(obj, function(i, val){
            //             p_list.push("<option value="+this.company_id+">"+this.abbr+"</option>");
            //         });
            //         $("#mcompany").html(p_list);
            //     }
            // });

            $.ajax({
                url: '<?php echo base_url('processing/getActivePeriod');?>',
                type: 'post',
                dataType: 'json',
                async: false,
                success: function(result){
                    const obj = result;
                    var p_list = [];
                    p_list.push("<option selected value>Please select Period...</option>");
                    $.each(obj, function(i, val){
                        p_list.push("<option value="+this.cfrom+">"+this.cfrom+"</option>");
                    });
                    $("#mperiod").html(p_list);
                }
            });

            self.loadEvents();
        },

        loadEvents: function(){
            payrollform.find('#btnProcess').on('click', function(){
                
                var mperiod = payrollform.find('#mperiod').val();
                var mcompany = payrollform.find('#mcompany').val();

                var conf = confirm("Are you sure you want to process? This only Done Once...");

                if(conf){
                    g_messageDialogViewModel.showWaitDialog();
                    $.ajax({
                        url: '<?php echo base_url('processing/ProcessPayroll');?>',
                        type: 'post',
                        data: {
                            mdata: {
                                mperiod: mperiod
                            }
                        },
                        dataType: 'json',
                        success: function(result){
                            const obj = result;
                            console.log(obj);
                            if(obj == true){
                                payrollform.find('#alert_id').append($('<div>').addClass('alert alert-success').attr('role','alert').text('PAYROLL PROCESS SUCCESS!!!'));
                                
                                setTimeout(function(){
                                    location.reload(1);
                                }, 3000);
                            
                            }else if(obj == 'posted'){
                                payrollform.find('#alert_id').append($('<div>').addClass('alert alert-info').attr('role','alert').text('PAYROLL PERIOD ALREADY POSTED!!!'));
                            }
                            else{
                                payrollform.find('#alert_id').append($('<div>').addClass('alert alert-danger').attr('role','alert').text('ERROR PROCESSING PAYROLL!!!'));
                            }
                            payrollform.find('#mperiod').val('');
                            g_messageDialogViewModel.hideWaitDialog();
                        }
                    });
                }         
                       
            });
        },
    }

    __payroll.initialize();
</script>