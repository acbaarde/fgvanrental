<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$cfrom = substr($pperiod['cfrom'],8,2);
$cto = substr($pperiod['cto'],8,2);
$pperiod = $pperiod['cfrom'];
$fullname = $info['FULLNAME'];
$driver_id = $info['driver_id'];
$unit = $info['unit'];
$plate_no =  $info['plate_number'];
$company_name = $info['company_name'];
$refno = $info['refno'];
$company_id = $info['company_id'];
?>

<br>
<div class="row" id="trnxperdayForm">
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
                                    <input type="hidden" id="company_id" value="<?php echo $company_id; ?>">
                                    <input type="hidden" id="pperiod" value="<?php echo $pperiod; ?>">
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
                                    <li style="width:110px;"><strong>PERIOD:</strong></li>
                                    <li style="display: inline;"><?php echo $pperiod; ?></li>     
                                </ul>
                                <ul class="list-inline">
                                    <li style="width:110px;"><strong>REFERENCE #.:</strong></li>
                                    <li style="display: inline;"><?php echo $refno; ?></li>     
                                </ul>
                            </li>       
                        </ul>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <table class="table table bordered table-responsive-sm table-sm">
                            <thead class="thead-light">
                                <tr style="text-align:center;">
                                    <th>CHARGE PER DAY</th>
                                    <th>DAYS</th>
                                    <th>TOTAL AMOUNT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="text-align:center;">
                                    <td><input type="text" size=10 maxlength=7 placeholder=0 id="chargeperday" value></td>
                                    <td><input type="text" size=5 maxlength=3 placeholder=0 id="days" value></td>
                                    <td><input type="text" size=10 maxlength=7 placeholder=0 id="total_amount" value disabled></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div style="margin: 5px 5px 5px 0px;">
                            <input id="btnsave" type="button" class="btn btn-primary btn-sm" style="width: 110px; margin-right: 5px;" value="SAVE">
                            <!-- <input id="btncancel" type="button" class="btn btn-success btn-sm" style="width: 110px; margin-right: 5px;" value="CANCEL">
                            <input id="btnclear" type="button" class="btn btn-danger btn-sm" style="width: 110px; margin-right: 5px;" value="CLEAR"> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<script>
    var trnxperdayform = $('#trnxperdayForm');
    $(function(){
        const __trnxperdayform = {
            initialize: function(){
                const self = this;
                this.loadForm();
            },

            loadForm: function(){
                const self = this;
                $.ajax({
                    url: 'loadTrnxperday',
                    type: 'post',
                    data: { 
                        mdata: {
                                driver_id: $('#driver_id').val(),
                                company_id: $('#company_id').val(), 
                                pperiod: $('#pperiod').val()
                            }
                    },
                    dataType: 'json',
                    async: false,
                    success: function(result){
                        const obj = result;
                        console.log(obj);
                        if(obj){
                            trnxperdayform.find('#chargeperday').val(obj['chargeperday']);
                            trnxperdayform.find('#days').val(obj['days']);
                            trnxperdayform.find('#total_amount').val(obj['totalamount']);
                        }
                        

                        self.loadEvents();
                    }
                    
                });
            },

            loadEvents: function(){
                trnxperdayform.find('#btnSave').on('click', function(){
                    $.ajax({
                        url: 'saveTrnxperday',
                        type: 'post',
                        data: { 
                            mdata: {
                                driver_id: $('#driver_id').val(),
                                company_id: $('#company_id').val(), 
                                pperiod: $('#pperiod').val(),
                                chargeperday: $('#chargeperday').val(),
                                days: $('#days').val(),
                                total_amount: $('#total_amount').val()
                            }
                        },
                        dataType: 'json',
                        async: false,
                        success: function(result){
                            const obj = result;
                            console.log(obj);
                            if(obj==true){
                                alert("Record Saved!!!");
                                location.reload();
                            }else{
                                alert("Error: on SAVING...");
                                return false;
                            }
                        }
                    });
                });
            },
        }
        __trnxperdayform.initialize();
    });
</script>