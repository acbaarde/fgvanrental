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
                </div>
            </div>
        </div> 
    </div>
</div>

<div class="row">
    <div class="col-md-12" id="alert_id"></div>
</div>

<div class="row" id="perdayform" hidden>
    <!-- <div class="col-md-12" id="toprint" style="margin-bottom: 10px;"></div> -->
    <div class="col-md-12">
        <div class="card" id="card_id">
            <div class="card-body">
                <div class="form-group row">
                    <img src="../../assets/images/logofg.png" alt="fg" style="display: block; margin-left: auto; margin-right: auto; width:500px;height:100px">
                </div>
                <div class="form-group row">
                    <div class="col-md-12" style="text-align: center;">
                        <h5><strong>FG VAN RENTAL BILLING STATEMENT</strong></h5>
                        <h6><strong id="rpt_title"></strong></h6>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-md-8">
                        <ul class="list-unstyled">
                            <li>
                                <ul class="list-inline">
                                    <li style="width: 130px;">STATEMENT DATE:</li>
                                    <li style="display: inline"><strong id="rpt_stdate"></strong></li>
                                </ul>
                                <ul class="list-inline">
                                    <li style="width: 130px;">PERIOD:</li>
                                    <li style="display: inline"><strong id="rpt_period"></strong></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-unstyled" style="float: right;">
                            <li>
                                <ul class="list-inline">
                                    <li style="width: 130px;">REFERENCE NO.:</li>
                                    <li style="display: inline"><strong id="rpt_refno"></strong></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-responsive-sm table-sm">
                            <thead style="text-align: center">
                                <tr class="table-active">
                                    <th>UNIT</th>
                                    <!-- <th colspan="2">TRIPS</th> -->
                                    <th>CHARGE PER DAY</th>
                                    <th>DAYS</th>
                                    <th>TOTAL AMOUNT</th>
                                </tr>
                            </thead>
                            <tbody id="perdaylist"></tbody>
                            <tfoot>
                                <tr style="text-align: center;">
                                    <td style="text-align: right;" colspan="3"><strong>TOTAL :</strong></td>
                                    <td><strong id="total_amount"></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
    
                        <ul class="list-unstyled" style="text-align: center; margin-bottom: 0;">
                            <li><h6 style="margin-bottom: 0;">Gilbert Liban</h6></li>
                            <li>_________________________________________</li>
                            <li>Owner / Proprietor</li>
                        </ul>

                    </div>
                </div>
            </div> <!--end cardbody-->
        </div> <!--end card-->
    </div>
</div>

<script>
    $(function(){
        var perdayform = $('#perdayform');
        // perdayform.hide();
        const __perdayform = {
            initialize: function(){
                const self = this;
                this.loadForm();
            },

            loadForm: function(){
                const self = this;
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
                    data: { type: 'D'},
                    dataType: 'json',
                    success: function(result){
                        const obj = result;
                        var p_list = ['<option selected value>Please select Company...</option>'];
                        $.each(obj, function(i, val){
                            p_list.push($("<option></option>").html(this.abbr).val(this.company_id));
                        });
                        $("#mcompany").html(p_list);
                    }
                });


                $.ajax({
                    url: '<?php echo base_url('reports/getPeriod'); ?>',
                    type: 'post',
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
                self.loadEvents();
            },

            loadReports: function(){
                g_messageDialogViewModel.showWaitDialog();
                const self = this;
                $.ajax({
                    url: '<?php echo base_url('reports/getPerday_rpt'); ?>',
                    type: 'post',
                    data: { 
                        mdata: {
                            myear: $('#myear').val(),
                            mcompany: $('#mcompany').val(),
                            mperiod: $('#mperiod').val()
                        }
                    },
                    dataType: 'json',
                    // async: false,
                    success: function(result){
                        const obj = result;
                        if(obj.result.length > 0){
                            perdayform.prop('hidden', false);
                            $('#alert_id').html('');
                            $('#toprint').empty().append($('<button>').addClass('btn btn-primary btn-sm').attr('type','submit').text('PRINT'));
                        }else{
                            perdayform.prop('hidden', true);
                            $('#toprint').empty();
                            $('#alert_id').html($('<div>').addClass('alert alert-info').attr('role','alert').text('NO RECORDS FOUND!!!'));
                        }

                        perdayform.find('#rpt_title').text('for ' + obj['company']['company_name']);
                        perdayform.find('#rpt_stdate').text(formatDateString(obj['period']['pperiod']));
                        perdayform.find('#rpt_period').text(formatFromToDate(obj['period']['cfrom'],obj['period']['cto']));
                        perdayform.find('#rpt_refno').text(obj['company']['refno']);
                        var total_amount = 0;
                        perdayform.find('#perdaylist').empty();
                        $.each(obj['result'], function(i,v){
                            perdayform.find('#perdaylist')
                                .append($('<tr>')
                                    .append($('<td>')
                                        .append($('<ul>').addClass('list-unstyled').attr('style','margin-bottom:0')
                                            .append($('<li>')
                                                .append($('<ul>').addClass('list-inline')
                                                    .append($('<li>')
                                                        .append($('<strong>').text(this.unit))
                                                    )
                                                )
                                                .append($('<ul>').addClass('list-inline')
                                                    .append($('<li>').text('Plate No.:').attr('style','width: 80px;'))
                                                    .append($('<li>').attr('style','display: inline')
                                                        .text(this.plate_number)
                                                    )
                                                )
                                                .append($('<ul>').addClass('list-inline')
                                                    .append($('<li>').text('Driver:').attr('style','width: 80px;'))
                                                    .append($('<li>').attr('style','display: inline')
                                                        .text(this.driver_name)
                                                    )
                                                )
                                            )
                                        )
                                    )

                                    .append($('<td>').text(toparseFloat(this.chargeperday)).attr('style','text-align: center; vertical-align: middle;'))
                                    .append($('<td>').text(this.days).attr('style','text-align: center; vertical-align: middle;'))
                                    .append($('<td>').text(toparseFloat(parseInt(this.totalamount))).attr('style','text-align: center; vertical-align: middle;'))
                                )
                                .append($('<tr>').append($('<td>')).append($('<td>')).append($('<td>')).append($('<td>')))
                            total_amount += parseInt(this.totalamount);
                        });

                        perdayform.find('#total_amount').text(toparseFloat(total_amount));

                        self.loadEvents();
                        g_messageDialogViewModel.hideWaitDialog();
                    }
                });
            },

            loadEvents: function(){
                const self = this;

                $('#toprint').on('click', function(){
                    $('#toprint').empty();

                    var printContents = document.getElementById('card_id').innerHTML;
                    var originalContents = document.body.innerHTML;
                    document.body.innerHTML = printContents;
                    window.print();
                    document.body.innerHTML = originalContents;

                    location.reload();
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

                    self.loadReports();
                });
            },

        }
        __perdayform.initialize();
    });
</script>