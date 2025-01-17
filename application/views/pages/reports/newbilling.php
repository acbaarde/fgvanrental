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
                    <input type="text" id="refno" placeholder="Reference no." style="margin-left: 5px; padding: 0 0;">
                    <select id="mdepartment" style="margin-left: 5px;"><option selected value hidden>Please select Department...</option></select>

                </div>
            </div>
        </div> 
    </div>
</div>

<div class="row">
    <div class="col-md-12" id="alert_id"></div>
</div>

<div class="row" id="newbillingform" hidden>
    <div class="col-md-12">
        <div class="card" id="card_id">
            <div class="card-body">
                <?php $this->load->view('pages/reports/rptheader'); ?>

                <div class="form-group row">
                    <div class="col-md-12" style="text-align: center;">
                        <h5><strong>BILLING STATEMENT</strong></h5>
                        <!-- <h6><strong id="rpt_title"></strong></h6> -->
                    </div>
                </div>
                
                <div class="form-group row" style="padding: 0 5rem 0 5rem;">
                    <ul class="list-unstyled">
                        <li>
                            <ul class="list-inline">
                                <li style="width: 80px;">Client: </li>
                                <li><strong id="companyName"></strong></li>
                            </ul>
                            <ul class="list-inline">
                                <li style="width: 80px;">Address: </li>
                                <li><strong id="companyAddress"></strong></li>
                            </ul>
                            <ul class="list-inline">
                                <li style="width: 80px;">TIN no.: </li>
                                <li><strong id="companyTinno"></strong></li>
                            </ul>
                            <ul class="list-inline">
                                <li style="width: 80px;">Date: </li>
                                <li><strong id="currentDate"></strong></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="form-group row" style="padding: 0 3rem 0 3rem;">
                    <div class="col-md-12">
                        <table id="tblData" class="table table-bordered table-sm">
                            <thead style="text-align: center">
                                <tr class="table-active">
                                    <th style="width:80%;">DESCRIPTION</th>
                                    <th>AMOUNT</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr style="text-align: center;">
                                    <td style="text-align: right;"><strong>Total Amount (Incl. 12% Vat): </strong></td>
                                    <td><strong id="total_amount"></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="form-group row" style="text-align: center;">
                    <div class="col-md-12">
                        <table class="table table-sm"  style="text-align: center;  margin-top: 2rem;">
                            <thead>
                                <tr>
                                    <th style="width: 50%;border: none !important;"></th>
                                    <th style="width: 50%;border: none !important;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="border: none !important;" id="preparedby"></td>
                                    <td style="border: none !important;">
                                        <img src="../../assets/images/biancasigna.png" alt="biancasigna.png" style="position: absolute; width:100px; height:100px;">
                                        <span id="checkedby"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none !important;">__________________________________</td>
                                    <td style="border: none !important;">__________________________________</td>
                                </tr>
                                <tr>
                                    <td style="border: none !important;">Prepared by:</td>
                                    <td style="border: none !important;">Checked by:</td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-sm"  style="text-align: center; margin-top: 4rem;">
                            <thead>
                                <tr>
                                    <th style="width: 50%;border: none !important;"></th>
                                    <th style="width: 50%;border: none !important;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="border: none !important;" id="approvedby"></td>
                                    <td style="border: none !important;"></td>
                                </tr>
                                <tr>
                                    <td style="border: none !important;">__________________________________</td>
                                    <td style="border: none !important;"></td>
                                </tr>
                                <tr>
                                    <td style="border: none !important;">Approved by:</td>
                                    <td style="border: none !important;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!--end cardbody-->
        </div> <!--end card-->
    </div>
</div>

<script>
    $(function(){
        

        var newbillingform = $('#newbillingform')
        const __newbillingform = {
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

                //LOAD SIGNATORIES
                $.ajax({
                    url: '<?php echo base_url('datamaint/getSigna'); ?>',
                    type: 'post',
                    dataType: 'json',
                    success: function(result){
                        $.each(result, function(i, v){
                            if(this.type == 'A'){
                                $('#approvedby')
                                    .append($('<img>').attr({
                                        src: "../../assets/images/" + this.signature,
                                        alt: this.signature,
                                        style: "position: absolute; width:100px; height:100px;"
                                    }))
                                    .append($('<span>').text(this.name))
                            }
                            if(this.type == 'C'){
                                $('#checkedby')
                                    .append($('<img>').attr({
                                        src: "../../assets/images/" + this.signature,
                                        alt: this.signature,
                                        style: "position: absolute; width:100px; height:100px;"
                                    }))
                                    .append($('<span>').text(this.name))
                            }
                            if(this.type == 'P'){
                                $('#preparedby')
                                    .append($('<img>').attr({
                                        src: "../../assets/images/" + this.signature,
                                        alt: this.signature,
                                        style: "position: absolute; width:100px; height:100px;"
                                    }))
                                    .append($('<span>').text(this.name))
                            }
                        })
                    }
                })

                self.loadEvents();
                g_messageDialogViewModel.hideWaitDialog();
            },

            loadEvents: function(){
                const self = this;

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

                $("#mdepartment").on('change', function(){
                    if($('#myear').val() == ''){
                        alert('Please Select Year ...');
                        $("#mdepartment").val('');
                        return false;
                    }
                    if($('#mcompany').val() == ''){
                        alert('Please Select Company ...');
                        $("#mdepartment").val('');
                        return false;
                    }
                    if($('#mperiod').val() == ''){
                        alert('Please Select Payperiod ...');
                        $("#mdepartment").val('');
                        return false;
                    }

                    self.loadReports();
                });
            },

            loadReports: function(){
                const self = this;
                var refno = $('#refno').val();
                var mdepartment =  $('#mdepartment').val();

                var cDate = new Date();
                newbillingform.find('#currentDate').text(formatDateString(cDate));

                $.ajax({
                    url: '<?php echo base_url('reports/getNewBiling'); ?>',
                    type: 'post',
                    data: {
                        mdata: {
                            group_by: 'dept_id,month(datetime)',
                            order_by: 'datetime',
                            myear: $('#myear').val(),
                            mcompany_id: $('#mcompany').val(),
                            mperiod: $('#mperiod').val(),
                            mdepartment_id: mdepartment
                        }
                    },
                    dataType: 'json',
                    async: false,
                    success: function(result){
                        const obj = result;
                        
                        if(obj.result.length > 0){
                            newbillingform.prop('hidden', false);
                            $('#alert_id').html('');
                            newbillingform.find('#companyName').text(obj.result[0].company_name);
                            newbillingform.find('#companyAddress').text(obj.result[0].address);
                            newbillingform.find('#companyTinno').text(obj.result[0].tinno);
                            $('#toprint').empty().append($('<button>').addClass('btn btn-primary btn-sm').attr('type','submit').text('PRINT'));
                        }else{
                            newbillingform.prop('hidden', true);
                            $('#toprint').empty();
                            $('#alert_id').html($('<div>').addClass('alert alert-info').attr('role','alert').text('NO RECORDS FOUND!!!'));
                        }
                        var total_amount = 0;
                        newbillingform.find('#tblData tbody').empty();
                        newbillingform.find('.total_amount').empty();
                        $.each(obj['result'], function(i, v){
                            if(typeof this.id == 'undefined'){
                                var cfrom = obj.rpt_info['cfrom'];
                                var cto = obj.rpt_info['cto'];
                                
                                var ddte = new Date(cfrom);
                                var month = ddte.toLocaleString('default', { month: 'long' })

                                var datetext = month + ' ' + cfrom.slice(8,10) + '-' + cto.slice(8,10) + ', ' + cfrom.slice(0,4);

                                newbillingform.find('#tblData tbody')
                                    .append($('<tr>')
                                        .append($('<td>').css({ "padding": "1rem" }).html('SOA no. <strong>' + refno + '</strong> | ' + datetext + ' (REGULAR, COMBINED, and SPECIAL TRIPS) with total trips of ' + this.total_trip))
                                        .append($('<td>').css({ "text-align": "center", "padding": "1rem 0 1rem 0" }).text(toparseFloat(this.amount)))
                                    )
                            }else{
                                newbillingform.find('#tblData tbody')
                                    .append($('<tr>')
                                        .append($('<td>').css({ "padding": "1rem" }).html('SOA no. <strong>' + refno + '</strong> | ' + this.dmonth + ' ' + this.ddays + ', ' + this.dyear + ' SPECIAL TRIP Requested by ' + this.dept_name))
                                        .append($('<td>').css({ "text-align": "center", "padding": "1rem 0 1rem 0" }).text(toparseFloat(this.amount)))
                                    )
                            }
                            
                            total_amount += parseFloat(this.amount);
                        });
                        newbillingform.find('#total_amount').text(toparseFloat(total_amount));
                    }
                });

                $('#toprint').on('click', function(){
                    newbillingform.find('#dateref').attr('value', $('#dateref').val());
                    newbillingform.find('#dateref').attr('style', 'border: 0;');
                    newbillingform.find('#ref').attr('value', $('#ref').val());
                    $('#toprint').empty();
                    
                    var printContents = document.getElementById('card_id').innerHTML;
                    var originalContents = document.body.innerHTML;
                    document.body.innerHTML = printContents;
                    window.print();
                    document.body.innerHTML = originalContents;

                    location.reload();
                });

            }
        }

        __newbillingform.initialize();
    });

</script>

<style>
p{
    font-size: 1rem;
    margin: 0;
}
</style>