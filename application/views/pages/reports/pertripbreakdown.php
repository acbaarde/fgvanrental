<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-md-12"  style="margin: 10px 0px 10px 0px">
        <div id="toprint" class="form-inline float-left"></div>
        <div class="form-inline float-right">
            <div class="form-vertical">
                <div class="form-group">
                    <select id="myear"><option selected value hidden>Please select Year...</option></select>
                    <select id="mcompany" style="margin-left: 5px;"><option selected value hidden>Please select Company...</option></select>
                    <input type="text" id="refno" placeholder="Reference no." style="margin-left: 5px; padding: 0 0;"> 
                    <select id="mperiod" style="margin-left: 5px;"><option selected value hidden>Please select Period...</option></select>
                </div>
            </div>
        </div> 
    </div>
</div>

<div class="row">
    <div class="col-md-12" id="alert_id"></div>
</div>

<div class="row" id="pertripbreakdownform" hidden>
    <div class="col-md-12">
        <div class="card" id="card_id">
            <div class="card-body">
                <?php $this->load->view('pages/reports/rptheader'); ?>

                <div class="form-group row" style="margin-bottom: 5px;">
                    <div class="col-sm-4">
                        <div class="form-group row" style="margin-bottom: 0;">
                            <div class="col-md-12">
                                <ul class="list-unstyled" style="margin-bottom: 0;">
                                    <li>
                                        <ul class="list-inline">
                                            <li style="width: 130px;">STATEMENT DATE:</li>
                                            <li style="display: inline"><strong id="rpt_stdate"></strong></li>
                                        </ul>
                                        <ul class="list-inline">
                                            <li style="width: 130px;">PERIOD:</li>
                                            <li style="display: inline"><strong id="rpt_period"></strong></li>
                                        </ul>
                                        <ul class="list-inline">
                                            <li style="width: 130px;">REF NO.:</li>
                                            <!-- <li style="display: inline"><strong id="rpt_refno"></strong></li> -->
                                            <li style="display: inline"><strong id="refno_value"></strong></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group row" style="margin-bottom: 0;">
                            <div class="col-md-12">
                                <ul class="list-unstyled" style="margin-bottom: 0;">
                                    <li>
                                        <ul class="list-inline">
                                            <li style="width: 130px;">REGULAR TRIP:</li>
                                            <li style="display: inline" id="rpt_amnt_regular"></li>
                                        </ul>
                                        <ul class="list-inline">
                                            <li style="width: 130px;">COMBINED TRIP:</li>
                                            <li style="display: inline" id="rpt_amnt_extended"></li>
                                        </ul>
                                        <ul class="list-inline">
                                            <li style="width: 130px;">SPECIAL TRIP:</li>
                                            <li style="display: inline" id="rpt_amnt_special"></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group row" style="margin-bottom: 0;">
                            <div class="col-md-12">
                                <ul class="list-unstyled" style="margin-bottom: 0;">
                                    <li>
                                        <ul class="list-inline">
                                            <li style="width: 130px;"><strong></strong></li>
                                            <li style="display: inline"><strong></strong></li>
                                        </ul>
                                        <ul class="list-inline">
                                            <li style="width: 130px;"><strong>TOTAL TRIPS:</strong></li>
                                            <li style="display: inline"><strong id="rpt_total_trips"></strong></li>
                                        </ul>
                                        <ul class="list-inline">
                                            <li style="width: 130px;"><strong>TOTAL AMOUNT:</strong></li>
                                            <li style="display: inline;"><strong id="rpt_total_amnt"></strong></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <!-- REGULAR FORM -->
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-responsive-sm table-sm">
                            <thead class="thead-light" style="text-align: center">
                                <tr>
                                    <th style="vertical-align:middle;text-align:center; width: 150px;">REGULAR</th>
                                    <th class="thcolspan" style="text-align:center;">DAY / TRIP</th>
                                </tr>
                                <tr class="thdays" style="text-align: center;">
                                    <!-- <th>ROUTE</th>
                                    <th>RATES</th> -->
                                </tr>
                            </thead>
                            <tbody id="pertripbreakdownlist_regular"></tbody>
                            <tfoot>
                                <tr style="text-align: center;">
                                    <td style="text-align: right;" class="tfoot_colspan"><strong>TOTAL :</strong></td>
                                    <td><strong id="total_trips_regular"></strong></td>
                                    <td><strong id="total_amount_regular"></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- EXTENDED FORM -->
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-responsive-sm table-sm">
                            <thead class="thead-light" style="text-align: center">
                                <tr>
                                    <th style="vertical-align:middle;text-align:center; width: 150px;">COMBINED</th>
                                    <th class="thcolspan" style="text-align:center;">DAY / TRIP</th>
                                </tr>
                                <tr class="thdays" style="text-align: center;">
                                    <!-- <th>ROUTE</th>
                                    <th>RATES</th> -->
                                </tr>
                            </thead>
                            <tbody id="pertripbreakdownlist_extended"></tbody>
                            <tfoot>
                                <tr style="text-align: center;">
                                    <td style="text-align: right;" class="tfoot_colspan"><strong>TOTAL :</strong></td>
                                    <td><strong id="total_trips_extended"></strong></td>
                                    <td><strong id="total_amount_extended"></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- SPECIAL FORM -->
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-responsive-sm table-sm">
                            <thead class="thead-light" style="text-align: center">
                                <tr>
                                    <th style="vertical-align:middle;text-align:center; width: 150px;">SPECIAL</th>
                                    <th class="thcolspan" style="text-align:center;">DAY / TRIP</th>
                                </tr>
                                <tr class="thdays" style="text-align: center;">
                                    <!-- <th>ROUTE</th>
                                    <th>RATES</th> -->
                                </tr>
                            </thead>
                            <tbody id="pertripbreakdownlist_special"></tbody>
                            <tfoot>
                                <tr style="text-align: center;">
                                    <td style="text-align: right;" class="tfoot_colspan"><strong>TOTAL :</strong></td>
                                    <td><strong id="total_trips_special"></strong></td>
                                    <td><strong id="total_amount_special"></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <img src="../../assets/images/signature.png" alt="fg" style="display: block; margin-left: auto; margin-right: auto; width:200;height:100px">
                        <!-- <ul class="list-unstyled" style="text-align: center; margin-bottom: 0;">
                            <li><h6 style="margin-bottom: 0;">Gilbert Liban</h6></li>
                            <li>_________________________________________</li>
                            <li>Owner / Proprietor</li>
                        </ul> -->

                    </div>
                </div>
                

            </div> <!--end cardbody-->
        </div> <!--end card-->
    </div>
</div>

<script>
    $(function(){
        var pertripbreakdownform = $('#pertripbreakdownform');
        // pertripbreakdownform.hide();
        const __pertripbreakdownform = {
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
                    data: { type: 'T'},
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

                self.loadEvents();
            },

            loadReports: function(){
                g_messageDialogViewModel.showWaitDialog();
                const self = this;
                $.ajax({
                    url: '<?php echo base_url('reports/getpertripbreakdown_rpt'); ?>',
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

                        console.log(obj);
                        if(obj.regular.length > 0 || obj.extended.length > 0 || obj.special.length > 0){
                            pertripbreakdownform.prop('hidden', false);
                            $('#alert_id').html('');
                            $('#toprint').empty().append($('<button>').addClass('btn btn-primary btn-sm').attr('type','submit').text('PRINT'));
                        }else{
                            pertripbreakdownform.prop('hidden', true);
                            $('#toprint').empty();
                            $('#alert_id').html($('<div>').addClass('alert alert-info').attr('role','alert').text('NO RECORDS FOUND!!!'));
                        }

                        pertripbreakdownform.find('#rpt_stdate').text(formatDateString(obj['rpt_info']['pperiod']));
                        pertripbreakdownform.find('#rpt_period').text(formatFromToDate(obj['rpt_info']['pperiod'],obj['rpt_info']['cto']));
                        // pertripbreakdownform.find('#rpt_refno').text(obj['rpt_info']['refno']);
                        pertripbreakdownform.find('#refno_value').text($('#refno').val());

                        // $('#toprint').empty().append($('<button>').addClass('btn btn-primary btn-sm').attr('type','submit').text('PRINT'));

                        var days = obj['rpt_info']['days'];
                        var thcolspan = 3;
                        var from = new Date(obj['rpt_info']['cfrom']);
                        var to = new Date(obj['rpt_info']['cto']);
                        pertripbreakdownform.find('.thdays').empty();
                        pertripbreakdownform.find('.thdays').append($('<th>').text('ROUTES')).append($('<th>').text('RATES'));
                        for(var i = from.getDate() ; i <= to.getDate() ; i++){
                            thcolspan++;
                            pertripbreakdownform.find('.thdays').append($('<th>').text(parseInt(i)));
                        }
                        pertripbreakdownform.find('.thdays').append($('<th>').text('TRIPS')).append($('<th>').text('AMOUNT'));
                        pertripbreakdownform.find('.thcolspan').attr('colspan', thcolspan);
                        pertripbreakdownform.find('.tfoot_colspan').attr('colspan', thcolspan - 1);
                        
                        var ttrips = 0; ttotal = 0;
                        var types = ['regular','extended','special']; 
                        $.each(types, function(i,v){
                            var totaltrips = 0; var totalamount = 0;
                            var typ = this;
                            pertripbreakdownform.find('#pertripbreakdownlist_'+typ).empty();
                            if(obj[typ].length > 0){
                                $.each(obj[typ], function(ii,vv){
                                    pertripbreakdownform.find('#pertripbreakdownlist_'+typ)
                                        .append($('<tr>').attr('id',this.id).attr('style','text-align:center;')
                                            .append($('<td>').text(this.route_name))
                                            .append($('<td>').text(this.rate))
                                            .append($('<td>').addClass('day_1').attr('style','display: none;')
                                                .text(this.day_1 > 0 ? this.day_1 : ''))
                                            .append($('<td>').addClass('day_2').attr('style','display: none;')
                                                .text(this.day_2 > 0 ? this.day_2 : ''))
                                            .append($('<td>').addClass('day_3').attr('style','display: none;')
                                                .text(this.day_3 > 0 ? this.day_3 : ''))
                                            .append($('<td>').addClass('day_4').attr('style','display: none;')
                                                .text(this.day_4 > 0 ? this.day_4 : '')) 
                                            .append($('<td>').addClass('day_5').attr('style','display: none;')
                                                .text(this.day_5 > 0 ? this.day_5 : ''))
                                            .append($('<td>').addClass('day_6').attr('style','display: none;')
                                                .text(this.day_6 > 0 ? this.day_6 : ''))
                                            .append($('<td>').addClass('day_7').attr('style','display: none;')
                                                .text(this.day_7 > 0 ? this.day_7 : ''))
                                            .append($('<td>').addClass('day_8').attr('style','display: none;')
                                                .text(this.day_8 > 0 ? this.day_8 : ''))
                                            .append($('<td>').addClass('day_9').attr('style','display: none;')
                                                .text(this.day_9 > 0 ? this.day_9 : ''))
                                            .append($('<td>').addClass('day_10').attr('style','display: none;')
                                                .text(this.day_10 > 0 ? this.day_10 : ''))
                                            .append($('<td>').addClass('day_11').attr('style','display: none;')
                                                .text(this.day_11 > 0 ? this.day_11 : ''))
                                            .append($('<td>').addClass('day_12').attr('style','display: none;')
                                                .text(this.day_12 > 0 ? this.day_12 : ''))
                                            .append($('<td>').addClass('day_13').attr('style','display: none;')
                                                .text(this.day_13 > 0 ? this.day_13 : ''))
                                            .append($('<td>').addClass('day_14').attr('style','display: none;')
                                                .text(this.day_14 > 0 ? this.day_14 : ''))
                                            .append($('<td>').addClass('day_15').attr('style','display: none;')
                                                .text(this.day_15 > 0 ? this.day_15 : ''))
                                            .append($('<td>').addClass('day_16').attr('style','display: none;')
                                                .text(this.day_16 > 0 ? this.day_16 : ''))
                                            .append($('<td>').text(this.total_trip))
                                            .append($('<td>').attr('id','totalamnt_'+this.id).text(toparseFloat(this.rate * this.total_trip)))
                                        )
                                        totalamount += parseFloat(this.rate) * parseInt(this.total_trip);
                                        totaltrips += parseInt(this.total_trip);
                                });
                            }
                            pertripbreakdownform.find('#total_trips_'+typ).text(totaltrips);
                            pertripbreakdownform.find('#total_amount_'+typ).text(toparseFloat(totalamount));
                            pertripbreakdownform.find('#rpt_amnt_'+typ).text(toparseFloat(totalamount));

                            ttrips += parseInt(totaltrips);
                            ttotal += parseFloat(totalamount);
                        });

                        for(var i = 1; i <= days; i++){
                            $('.day_'+i).show();
                        }

                        pertripbreakdownform.find('#rpt_total_trips').text(ttrips);
                        pertripbreakdownform.find('#rpt_total_amnt').text(toparseFloat(ttotal));
                        
                        g_messageDialogViewModel.hideWaitDialog();
                    }
                });
            },

            loadEvents: function(){
                const self = this;

                $('#toprint').on('click', function(){
                    pertripbreakdownform.find('#ref').attr('value', $('#ref').val());
                    pertripbreakdownform.find('#toprint').empty();
                    // pertripbreakdownform.removeClass('table-responsive-sm');
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
                            url: '<?php echo base_url('reports/getPeriod'); ?>',
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

                    self.loadReports();
                });
            },

        }
        __pertripbreakdownform.initialize();
    });
</script>