<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-md-12"  style="margin: 10px 0px 10px 0px">
        <div id="toprint" class="form-inline float-left"></div>
        <div class="form-inline float-right">
            <div class="form-vertical">
                <div class="form-group">
                    <select id="myear"><option selected value hidden>Please select Year...</option></select>
                    <select id="mcompany" style="margin-left: 5px;"><option selected value hidden>Please select Company...</option></select>
                    <select id="mperiod" style="margin-left: 5px;"><option selected value hidden>Please select Period...</option></select>
                    <select id="mdepartment" style="margin-left: 5px;"><option selected value hidden>Please select Department...</option></select>
                    <!-- <select id="mdates" style="margin-left: 5px;"><option selected value hidden>Please select Dates...</option></select> -->
                    <input type="text" id="multidates" data-provide="datepicker" placeholder="Please select Dates..." style="margin-left: 5px; padding: 0 0;">
                    <input type="button" id="btnProcess" value="Process" class="btn btn-primary btn-sm" style="margin-left: 5px;">
                </div>
            </div>
        </div> 
    </div>
</div>

<div class="row">
    <div class="col-md-12" id="alert_id"></div>
</div>

<div class="row" id="manualbillingform" hidden>
    <div class="col-md-12">
        <div class="card" id="card_id">
            <div class="card-body">
                <div class="form-group row">
                    <img src="../../assets/images/logofg.png" alt="fg" style="display: block; margin-left: auto; margin-right: auto; width:500px;height:100px">
                </div>

                <div class="form-group row">
                    <div class="col-md-12" style="text-align: center;">
                        <h5><strong>FG VAN RENTAL BILLING STATEMENT <span id="rpt_title"></span></strong></h5>
                        <h6><strong>SALES INVOICE</strong></h6>
                        <h6  style="text-align: left; padding: 0 5px;"><strong>SPECIAL TRIP</strong></h6>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-md-8">
                        <ul class="list-unstyled">
                            <li>
                                <ul class="list-inline">
                                    <li style="width: 130px;">STATEMENT DATE:</li>
                                    <li style="display: inline"><input value id="dateref" type="text"></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-unstyled" style="float: right;">
                            <li>
                                <ul class="list-inline">
                                    <li style="width: 130px;">REFERENCE NO.:</li>
                                    <li style="display: inline"><input value id="ref" type="text" size="3" maxlength="6" placeholder="000000"></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-sm" style="table-layout: fixed; width: 100%;">
                            <thead style="text-align: center">
                                <tr class="table-active">
                                    <th>ROUTE</th>
                                    <th>ARTICLE</th>
                                    <th>AMOUNT</th>
                                </tr>
                            </thead>
                            <tbody id="manualbillinglist">
                                <!-- <tr>
                                    <td style="text-align: center ">ALABANG TO EK (VICE VERSA)</td>
                                    <td style="text-align: center">REQUESTED BY: OPTODEV DECEMBER 11, 2023</td>
                                    <td style="text-align: center">10,020.00</td>
                                </tr> -->
                            </tbody>
                            <tfoot>
                                <tr style="text-align: center;">
                                    <td style="text-align: right;" colspan="2"><strong>TOTAL :</strong></td>
                                    <td><strong id="total_amount"></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <img src="../../assets/images/signature.png" alt="fg" style="display: block; margin-left: auto; margin-right: auto; width:200;height:100px">
                    </div>
                </div>
            </div> <!--end cardbody-->
        </div> <!--end card-->
    </div>
</div>

<script>
    $(function(){
        var manualbillingform = $('#manualbillingform');
        const __manualbillingform = {
            initialize: function(){
                const self = this;
                this.loadForm();
            },

            loadForm: function(){
                const self = this;
                g_messageDialogViewModel.showWaitDialog();
                $.ajax({
                    url: '<?php echo base_url('reports/getAllYear'); ?>',
                    type: 'post',
                    dataType: 'json',
                    success: function(result){
                        const obj = result;
                        var p_list = ['<option selected value>Please select Year...</option>'];
                        $.each(obj, function(i, val){
                            p_list.push($("<option></option>").html(this.year).val(this.year));
                        });
                        $("#myear").html(p_list);
                    }
                });

                $.ajax({
                    url: '<?php echo base_url('reports/getCompany'); ?>',
                    type: 'post',
                    data: { type: 'T'}, //T as PER TRIP
                    dataType: 'json',
                    success: function(result){
                        const obj = result;
                        // console.log(obj);
                        var p_list = ['<option selected value>Please select Company...</option>'];
                        $.each(obj, function(i, val){
                            p_list.push($("<option></option>").html(this.abbr).val(this.company_id));
                        });
                        $("#mcompany").html(p_list);
                    }
                });

                $.ajax({
                    url: '<?php echo base_url('datamaint/getDepartment'); ?>',
                    type: 'post',
                    dataType: 'json',
                    async: false,
                    success: function(result){
                        const obj = result;
                        var arrDept = ["<option selected value>Please select Department...</option>"];
                        $.each(obj, function(i, v){
                            if(this.active=='Y'){
                                arrDept.push("<option value="+this.id+" >"+this.dept_name+"</option>");
                            }
                        });
                        $("#mdepartment").html(arrDept);
                    }
                });

                self.loadEvents();
                g_messageDialogViewModel.hideWaitDialog();
            },

            loadEvents: function(){
                const self = this;

                $('#multidates').datepicker({
                    multidate: true,
                    format: 'yyyy-mm-dd'
                });

                $('#btnProcess').on('click', function(){
                    g_messageDialogViewModel.showWaitDialog();
                    var myear = $('#myear').val();
                    var mcompany_id = $('#mcompany').val();
                    var mperiod = $('#mperiod').val();
                    var mdepartment_id = $('#mdepartment').val();
                    var mdates = $('#multidates').val();
                    var cDate = new Date();
                    manualbillingform.find('#rpt_stdate').text(formatDateString(cDate));

                    $.ajax({
                        url: '<?php echo base_url('reports/getManualBilling'); ?>',
                        type: 'post',
                        data: {
                            mdata: {
                                group_by: 'route,dated',
                                order_by: 'dated,route',
                                myear: myear,
                                mcompany_id: mcompany_id,
                                mperiod: mperiod,
                                mdepartment_id: mdepartment_id,
                                mdates: mdates,
                            }
                        },
                        dataType: 'json',
                        async: false,
                        success: function(result){
                            const obj = result;
                            if(obj.result.length > 0){
                                manualbillingform.prop('hidden', false);
                                $('#alert_id').html('');
                                manualbillingform.find('#rpt_title').text('for ' + obj.result[0].company_name);
                                $('#toprint').empty().append($('<button>').addClass('btn btn-primary btn-sm').attr('type','submit').text('PRINT'));
                            }else{
                                manualbillingform.prop('hidden', true);
                                $('#toprint').empty();
                                $('#alert_id').html($('<div>').addClass('alert alert-info').attr('role','alert').text('NO RECORDS FOUND!!!'));
                            }
                            var total_amount = 0;
                            manualbillingform.find('#manualbillinglist').empty();
                            $.each(obj['result'], function(i, v){
                                manualbillingform.find('#manualbillinglist')
                                    .append($('<tr>')
                                        .append($('<td>').attr('style', 'text-align: center').text(this.route))
                                        .append($('<td>').attr('style', 'text-align: center').html("REQUESTED BY: "+this.dept_name+"<br>"+this.dated))
                                        .append($('<td>').attr('style', 'text-align: center').text(this.amount))
                                    )
                                    total_amount += parseFloat(this.amount);
                            });

                            manualbillingform.find('#total_amount').text(toparseFloat(total_amount));
                            g_messageDialogViewModel.hideWaitDialog();
                        }
                    });
                });

                $('#toprint').on('click', function(){
                    manualbillingform.find('#dateref').attr('value', $('#dateref').val());
                    manualbillingform.find('#dateref').attr('style', 'border: 0;');
                    manualbillingform.find('#ref').attr('value', $('#ref').val());
                    $('#toprint').empty();
                    
                    var printContents = document.getElementById('card_id').innerHTML;
                    var originalContents = document.body.innerHTML;
                    document.body.innerHTML = printContents;
                    window.print();
                    document.body.innerHTML = originalContents;

                    location.reload();
                });

                $("#myear").on('change', function(){
                    if($('#myear').val() == null || $('#myear').val() == ""){
                        var p_list = ['<option selected value>Please select Period...</option>'];
                        $("#mperiod").html(p_list);
                    }else{
                        $.ajax({
                            url:  '<?php echo base_url('reports/getPeriod'); ?>',
                            type: 'post',
                            data: {
                                mdata: $('#myear').val()
                            },
                            dataType: 'json',
                            success: function(result){
                                const obj = result;
                                var p_list = ['<option selected value>Please select Period...</option>'];
                                $.each(obj, function(i, val){
                                    p_list.push($("<option></option>").html(this.cfrom).val(this.cfrom));
                                });
                                $("#mperiod").html(p_list);
                            }
                        });
                    }
                });

                $("#mperiod").on('change', function(){
                    if($('#myear').val() == ''){
                        alert('Please Select Year ...');
                        $("#mperiod").val('');
                        return false;
                    }
                    if($('#mcompany').val() == ''){
                        alert('Please Select Company ...');
                        $("#mperiod").val('');
                        return false;
                    }

                    // self.loadReports();
                });
            },

        }
        __manualbillingform.initialize();
    });
</script>