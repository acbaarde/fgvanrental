<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>


<div class="row" id="periodsform">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12"  style="margin: 10px 0px 10px 0px">

                <!-- <div class="form-inline float-left">
                    <div class="form-group">
                        <label for="viewfilter">SHOW:</label>
                            <select class="form-control form-control-sm" id="viewfilter" style="margin-left: 5px;">
                                <option selected value>ALL</option>
                                <option value="R">REGULAR</option>
                                <option value="E">EXTENDED</option>
                                <option value="S">SPECIAL</option>
                            </select>
                    </div>
                </div> -->
                <div class="form-inline float-right">
                    <div class="form-group">
                        <input type="text" placeholder="Search" size="25" style="margin-left: 5px;">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" style="margin-left: 5px;"><i class="fa fa-search"></i></button>
                    </div>
                    <div class="form-group">
                        <input type="button" id="btnAddperiod" class="btn btn-success btn-sm" style="margin-left: 5px;" data-toggle="modal" data-target="#periodsModal" value="Add Period">
                        <input type="hidden" id="btnUpdateperiod" data-toggle="modal" data-target="#periodsModal">
                    </div>
                </div> 
            </div>
        </div>

        <div class="row">   
            <div class="col-md-12"> 
                <table class="table table-responsive-sm table-hover table-bordered table-sm">
                    <thead class="thead-light">
                        <tr style="text-align: center;">
                            <th>PERIOD</th>
                            <th>FROM</th>
                            <th>TO</th>
                            <th>DAYS</th>
                            <th>STATUS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody id="periodlist"></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ADD Modal -->
    <div class="modal fade" id="periodsModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 50%;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModal">ADD</h5>
                    <input type="hidden" id="period_id">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="pperiod">PERIOD:</label>
                                        <input type="date" class="form-control form-control-sm" id="pperiod">
                                    </div>
                                </div>
                            </div>
                                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cfrom">FROM:</label>
                                        <input type="date" class="form-control form-control-sm" id="cfrom">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cto">TO:</label>
                                        <input type="date" class="form-control form-control-sm" id="cto">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_days">DAYS:</label>
                                        <input type="text" class="form-control form-control-sm" id="no_days" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="selpost">STATUS:</label>
                                            <select class="form-control form-control-sm" id="selpost">
                                                <option selected value>OPEN</option>
                                                <option value="P">POSTED</option>
                                            </select>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" class="btn btn-primary" data-dismiss="modal" style="width: 100px">Save</button>
                    <button type="button" id="btnCancel" class="btn btn-secondary" data-dismiss="modal"  style="width: 80px">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(function(){
        const periodsform = $('#periodsform');
        const periodsmodal = $('#periodsModal');

        const __periodsform = {
            initialize: function(){
                const self = this;
                this.loadForm();
            },

            loadForm: function(){
                const self = this;
                $.ajax({
                    url: '<?php echo base_url('datamaint/getPeriods'); ?>',
                    type: 'post',
                    dataType: 'json',
                    async: false,
                    success: function(result){
                        const obj = result;
                        $.each(obj, function(i,v){
                            periodsform.find('#periodlist').append($('<tr>').attr('style', 'text-align: center;')
                                                        .append($('<td>').text(this.pperiod))
                                                        .append($('<td>').text(this.cfrom))
                                                        .append($('<td>').text(this.cto))
                                                        .append($('<td>').text(this.days))
                                                        .append($('<td>').attr('style', this.ppost=='P'?'color:#bb2124':'color:#22bb33').text(this.ppost == 'P' ? 'POSTED' : 'OPEN'))
                                                        .append($('<td>')
                                                            .append($('<button>').addClass('btn btn-warning btn-sm').attr('type','button').attr('id','btnUpdate').attr('style','margin-right: 5px;').attr('value', this.id)
                                                                .append($('<i>').addClass('fa fa-edit'))
                                                            )
                                                            .append($('<button>').addClass('btn btn-danger btn-sm').attr('type','button').attr('id','btnDelete').attr('value', [this.id,this.pperiod])
                                                                .append($('<i>').addClass('fa fa-trash'))
                                                            )
                                                        )
                                                    )
                        });
                        self.loadEvents();
                        self.actionbtn();
                    }
                });
            },

            loadEvents: function(){
                const self = this;
                periodsform.find('#btnAddperiod').on('click', function(){
                    periodsform.find('#titleModal').text('ADD');
                    periodsform.find('#btnSave').text('ADD');
                    periodsform.find('input[type="date"]').val('');
                    periodsform.find('#no_days:input').val('');

                    self.changedatebtn();
                });

                periodsform.find('#btnSave:button').on('click', function(){
                    var pperiod = periodsmodal.find('#pperiod').val();
                    var cfrom = periodsmodal.find('#cfrom').val();
                    var cto = periodsmodal.find('#cto').val();
                    var no_days = periodsmodal.find('#no_days').val();
                    var selpost = periodsmodal.find('#selpost').val();
                    var type = periodsmodal.find('#titleModal').text();
                    var period_id = periodsmodal.find('#period_id').val();
                    
                    $.ajax({
                        url: '<?php echo base_url('datamaint/savePeriod'); ?>',
                        type: 'post',
                        data: {
                            type: type,
                            mdata: {
                                period_id: period_id,
                                pperiod: pperiod,
                                cfrom: cfrom,
                                cto: cto,
                                no_days: no_days,
                                selpost: selpost
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
                                alert("Error: Inserting!!!");
                                return false;
                            }
                            
                        }
                    });
                });

            },

            actionbtn: function(){
                const self = this;
                periodsform.find('#btnUpdate:button').on('click', function(){
                    periodsform.find('#btnSave').removeAttr('disabled');
                    periodsform.find('#btnUpdateperiod:input').click();
                    periodsform.find('#titleModal').text('UPDATE');
                    periodsform.find('#btnSave').text('UPDATE');
                    periodsform.find('input:text').val('');

                    $.ajax({
                        url: '<?php echo base_url('datamaint/getPeriodinfo'); ?>',
                        type: 'post',
                        data: { period_id: this.value },
                        dataType: 'json',
                        async: false,
                        success: function(result){
                            const obj = result;
                            periodsform.find('#period_id').val(obj['id']);
                            periodsform.find('#pperiod').val(obj['pperiod']);
                            periodsform.find('#cfrom').val(obj['cfrom']);
                            periodsform.find('#cto').val(obj['cto']);
                            periodsform.find('#no_days').val(obj['days']);
                            periodsform.find('#selpost').val(obj['ppost']);

                        }
                    });
                    self.changedatebtn();
                });

                periodsform.find('#btnDelete:button').on('click', function(){
                    var value = this.value.split(",");
                    var id = value[0];
                    var pperiod = value[1].split('-');
                    var year = pperiod[0]; //get year
                    
                    var conf = confirm("Do you want to delete payperiod " + pperiod + " ???");
                    if(conf){
                        $.ajax({
                            url: '<?php echo base_url('datamaint/masterDelete'); ?>',
                            type: 'post',
                            data: { 
                                id: id,
                                table_name: 'pp'+year
                             },
                            dataType: 'json',
                            success: function(result){
                                if(result.status){
                                    alert(result.message);
                                    window.location.reload();
                                }
                            } 
                        });
                    }
                });
            },

            changedatebtn: function(){
                periodsmodal.find('#cto:input').on('change', function(){
                        console.log(this);
                        var cfrom = new Date($('#cfrom').val());
                        var cto = new Date($('#cto').val());
                        var diff = new Date(cto - cfrom);
                        var days = (diff/1000/60/60/24) + 1;

                        if(days > 16){
                            alert('Total days must be maximum to 16 days');
                            periodsform.find('#btnSave').prop('disabled', true);
                        }

                        periodsform.find('#no_days').val(days);
                    });
            },
        }

        __periodsform.initialize();


    });
</script>