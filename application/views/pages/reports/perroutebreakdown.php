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
                    <select id="mroutetype" style="margin-left: 5px;">
                        <option selected value>Please select Route type...</option>
                        <option value="regular">Regular</option>
                        <option value="extended">Extended</option>
                        <option value="special">Special</option>
                    </select>
                </div>
            </div>
        </div> 
    </div>
</div>

<div class="row">
    <div class="col-md-12" id="alert_id"></div>
</div>

<div class="row" id="perroutebreakdownform" hidden>
    <div class="col-md-12">
        <div class="card" id="card_id">
            <div class="card-body">
                <div class="form-group row">
                    <img src="../../assets/images/logofg.png" alt="fg" style="display: block; margin-left: auto; margin-right: auto; width:500px;height:100px">
                </div>
                <div class="form-group row"  style="margin-bottom: 5px;">
                    <div class="col-md-12">
                        <h5 style="margin-bottom: 0"><strong>FG VAN RENTAL</strong></h5>
                    </div>
                </div>
                <div class="form-group row" style="margin-bottom: 5px;">
                    <div class="col-md-4">
                        <div class="form-group row" style="margin-bottom: 0;">
                            <div class="col-md-12">
                                <ul class="list-unstyled" style="margin-bottom: 0;">
                                    <li>
                                        <ul class="list-inline">
                                            <li style="width: 125px;">STATEMENT DATE:</li>
                                            <li style="display: inline"><strong id="rpt_stdate"></strong></li>
                                        </ul>
                                        <ul class="list-inline">
                                            <li style="width: 125px;">PERIOD:</li>
                                            <li style="display: inline"><strong id="rpt_period"></strong></li>
                                        </ul>
                                        <ul class="list-inline">
                                            <li style="width: 125px;">REF NO.:</li>
                                            <!-- <li style="display: inline"><strong id="rpt_refno"></strong></li> -->
                                            <li style="display: inline"><input value id="ref" type="text" size="3" maxlength="6" placeholder="000000"></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row" style="margin-bottom: 0;">
                            <div class="col-md-12">
                                <!-- <ul class="list-unstyled" style="margin-bottom: 0;">
                                    <li>
                                        <ul class="list-inline">
                                            <li style="width: 130px;">REGULAR TRIP:</li>
                                            <li style="display: inline" id="rpt_amnt_regular"></li>
                                        </ul>
                                        <ul class="list-inline">
                                            <li style="width: 130px;">EXTENDED TRIP:</li>
                                            <li style="display: inline" id="rpt_amnt_extended"></li>
                                        </ul>
                                        <ul class="list-inline">
                                            <li style="width: 130px;">SPECIAL TRIP:</li>
                                            <li style="display: inline" id="rpt_amnt_special"></li>
                                        </ul>
                                    </li>
                                </ul> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
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
                                    <th style="vertical-align:middle;text-align:center; width: 150px;" id="form_title"></th>
                                    <th class="thcolspan" style="text-align:center;">DAY / TRIP</th>
                                </tr>
                                <tr class="thdays" style="text-align: center;">
                                    <!-- <th>ROUTE</th>
                                    <th>RATES</th> -->
                                </tr>
                            </thead>
                            <tbody id="perroutebreakdownlist"></tbody>
                            <tfoot>
                                <tr style="text-align: center;">
                                    <td style="text-align: right;" class="tfoot_colspan"><strong>TOTAL :</strong></td>
                                    <td><strong id="total_trips"></strong></td>
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
        var perroutebreakdownform = $('#perroutebreakdownform');
        // perroutebreakdownform.hide();
        const __perroutebreakdownform = {
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
                // g_messageDialogViewModel.showWaitDialog();
                const self = this;
                $.ajax({
                    url: '<?php echo base_url('reports/getperroutebreakdown_rpt'); ?>',
                    type: 'post',
                    data: { 
                        mdata: {
                            myear: $('#myear').val(),
                            mcompany: $('#mcompany').val(),
                            mperiod: $('#mperiod').val(),
                            mroutetype: $('#mroutetype').val()
                        }
                    },
                    dataType: 'json',
                    // async: false,
                    success: function(result){
                        const obj = result;

                        console.log(obj);
                        if(obj.routetype.length > 0 ){
                            perroutebreakdownform.prop('hidden', false);
                            $('#alert_id').html('');
                            $('#toprint').empty().append($('<button>').addClass('btn btn-primary btn-sm').attr('type','submit').text('PRINT'));
                        }else{
                            perroutebreakdownform.prop('hidden', true);
                            $('#toprint').empty();
                            $('#alert_id').html($('<div>').addClass('alert alert-info').attr('role','alert').text('NO RECORDS FOUND!!!'));
                        }

                        perroutebreakdownform.find('#form_title').text(formatUpperCase($('#mroutetype').val()));
                        perroutebreakdownform.find('#rpt_stdate').text(formatDateString(obj['rpt_info']['pperiod']));
                        perroutebreakdownform.find('#rpt_period').text(formatFromToDate(obj['rpt_info']['pperiod'],obj['rpt_info']['cto']));
                        perroutebreakdownform.find('#rpt_refno').text(obj['rpt_info']['refno']);

                        // $('#toprint').empty().append($('<button>').addClass('btn btn-primary btn-sm').attr('type','submit').text('PRINT'));

                        var days = obj['rpt_info']['days'];
                        var thcolspan = 3;
                        var from = new Date(obj['rpt_info']['cfrom']);
                        var to = new Date(obj['rpt_info']['cto']);
                        perroutebreakdownform.find('.thdays').empty();
                        perroutebreakdownform.find('.thdays').append($('<th>').text('ROUTES')).append($('<th>').text('RATES'));
                        for(var i = from.getDate() ; i <= to.getDate() ; i++){
                            thcolspan++;
                            perroutebreakdownform.find('.thdays').append($('<th>').text(parseInt(i)));
                        }
                        perroutebreakdownform.find('.thdays').append($('<th>').text('TRIPS')).append($('<th>').text('AMOUNT'));
                        perroutebreakdownform.find('.thcolspan').attr('colspan', thcolspan);
                        perroutebreakdownform.find('.tfoot_colspan').attr('colspan', thcolspan - 1);
                        
                        var ttrips = 0; ttotal = 0;
                        // var types = ['regular','extended','special']; 
                        // $.each(types, function(i,v){
                            var totaltrips = 0; var totalamount = 0;
                        //     var typ = this;
                            perroutebreakdownform.find('#perroutebreakdownlist').empty();
                            // if(obj.routetype.length > 0){
                                $.each(obj.routetype, function(ii,vv){
                                    perroutebreakdownform.find('#perroutebreakdownlist')
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
                                        totalamount += parseInt(this.rate) * parseInt(this.total_trip);
                                        totaltrips += parseInt(this.total_trip);
                                });
                            // }
                            perroutebreakdownform.find('#total_trips').text(totaltrips);
                            perroutebreakdownform.find('#total_amount').text(toparseFloat(totalamount));
                            // perroutebreakdownform.find('#rpt_amnt_'+typ).text(toparseFloat(totalamount));

                            ttrips += parseInt(totaltrips);
                            ttotal += parseInt(totalamount);
                        // });

                        for(var i = 1; i <= days; i++){
                            $('.day_'+i).show();
                        }

                        perroutebreakdownform.find('#rpt_total_trips').text(ttrips);
                        perroutebreakdownform.find('#rpt_total_amnt').text(toparseFloat(ttotal));
                        
                        g_messageDialogViewModel.hideWaitDialog();
                    }
                });
            },

            loadEvents: function(){
                const self = this;

                $('#toprint').on('click', function(){
                    perroutebreakdownform.find('#ref').attr('value', $('#ref').val());

                    perroutebreakdownform.find('#toprint').empty();
                    // perroutebreakdownform.removeClass('table-responsive-sm');
                    var printContents = document.getElementById('card_id').innerHTML;
                    var originalContents = document.body.innerHTML;
                    document.body.innerHTML = printContents;
                    window.print();
                    document.body.innerHTML = originalContents;

                    location.reload();
                });

                $("#mroutetype").on('change', function(){
                    if($('#myear').val() == ''){
                        alert('Please Select Year ...');
                        $("#mroutetype").val('');
                        return false;
                    }
                    if($('#mcompany').val() == ''){
                        alert('Please Select Company ...');
                        $("#mroutetype").val('');
                        return false;
                    }
                    if($('#mperiod').val() == ''){
                        alert('Please Select Period ...');
                        $("#mroutetype").val('');
                        return false;
                    }
                    self.loadReports();
                });

                $('#ref').on('keypress', function(){
                    $('#ref').val(this.value);
                });
            },

        }
        __perroutebreakdownform.initialize();
    });
</script>