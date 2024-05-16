<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>


<div class="row" id="vehiclesform">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12"  style="margin: 10px 0px 10px 0px">
                <div class="form-inline float-right">
                    <!-- <div class="form-group">
                        <label for="search">Search:</label>
                    </div> -->
                    <div class="form-group">
                        <input type="text" placeholder="Search" size="25" style="margin-left: 5px;">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" style="margin-left: 5px;"><i class="fa fa-search"></i></button>
                    </div>
                    <div class="form-group">
                        <input type="button" id="btnAddvehicle" class="btn btn-success btn-sm" style="margin-left: 5px;" data-toggle="modal" data-target="#vehiclesModal" value="Add Vehicle">
                        <input type="hidden" id="btnUpdatevehicle" data-toggle="modal" data-target="#vehiclesModal">
                    </div>
                </div> 
            </div>
        </div>

        <div class="row">   
            <div class="col-md-12"> 
                <table class="table table-responsive-sm table-hover table-bordered table-sm">
                    <thead class="thead-light">
                        <tr style="text-align: center;">
                            <th>PLATE #</th>
                            <th>UNIT</th>
                            <th>OPERATOR</th>
                            <th>STATUS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody id="vehiclelist"></tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="pagination-demo"></div>
            </div>
        </div>
    </div>

    <!-- ADD Modal -->
    <div class="modal fade" id="vehiclesModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 50%;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModal">ADD</h5>
                    <input type="hidden" id="recid">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="form-group">
                                <label for="seloperator">Operator:</label>
                                    <select class="form-control form-control-sm" id="seloperator">
                                        <!-- <option selected>Please Select Vehicle...</option> -->
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="unit">Unit:</label>
                                <input type="text" class="form-control form-control-sm" id="unit">
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="plate_number">Plate #.:</label>
                                        <input type="text" class="form-control form-control-sm" id="plate_number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="stat">Status:</label>
                                            <select class="form-control form-control-sm" id="stat">
                                                <option selected value="Y">ACTIVE</option>
                                                <option value="N">INACTIVE</option>
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
        const vehiclesform = $('#vehiclesform');
        const vehiclesmodal = $('#vehiclesModal');
        const __vehiclesform = {
            initialize: function(){
                const self = this;
                this.loadForm();
            },

            loadForm: function(){
                const self = this;
                $.ajax({
                    url: '<?php echo base_url('datamaint/getAllvehicles'); ?>',
                    type: 'post',
                    dataType: 'json',
                    async: false,
                    success: function(result){
                        const obj = result;
                        $('#pagination-demo').pagination({
                            dataSource: obj,
                            pageSize: 10,
                            showSizeChanger: true,
                            showNavigator: true,
                            formatNavigator: '<%= rangeStart %>-<%= rangeEnd %> of <%= totalNumber %> items',
                            position: 'top',
                            callback: function(data, pagination){
                                vehiclesform.find('#vehiclelist').empty();
                                $.each(data, function(i,v){
                                    vehiclesform.find('#vehiclelist').append($('<tr>').attr('style', 'text-align: center;')
                                                                .append($('<td>').text(this.plate_number))
                                                                .append($('<td>').text(this.unit))
                                                                .append($('<td>').text(this.operator))
                                                                .append($('<td>').addClass(this.active=='Y'?'classStatusActive':'classStatusInactive').text(this.active == 'Y' ? 'ACTIVE' : 'INACTIVE'))
                                                                .append($('<td>')
                                                                    .append($('<button>').addClass('btn btn-warning btn-sm').attr('type','button').attr('id','btnUpdate').attr('style','margin-right: 5px;').attr('value', this.id)
                                                                        .append($('<i>').addClass('fa fa-edit'))
                                                                    )
                                                                    .append($('<button>').addClass('btn btn-danger btn-sm').attr('type','button').attr('id','btnDelete').attr('value', this.id)
                                                                        .append($('<i>').addClass('fa fa-trash'))
                                                                    )
                                                                )
                                                            )
                                });
                                self.loadEvents();
                            }
                        });
                    }
                });
            },

            loadEvents: function(){
                const self = this;
                vehiclesform.find('#btnAddvehicle').on('click', function(){
                    vehiclesform.find('#titleModal').text('ADD');
                    vehiclesform.find('#btnSave').text('ADD');
                    vehiclesform.find('input:text').val('');

                    $.ajax({
                        url: '<?php echo base_url('datamaint/getOperators'); ?>',
                        type: 'post',
                        dataType: 'json',
                        async: false,
                        success: function(result){
                            const obj = result;
                            var p_list = ['<option selected value></option>'];
                            $.each(obj, function(i, val){
                                p_list.push($("<option></option>").html(this.lastname+', '+this.firstname+' '+this.middlename).val(this.id));
                            });
                            $("#seloperator").html(p_list);
                        }
                    });

                });

                vehiclesform.find('#btnSave').on('click', function(){
                    var plate_number = vehiclesmodal.find('#plate_number').val();
                    var unit = vehiclesmodal.find('#unit').val();
                    var seloperator = vehiclesmodal.find('#seloperator').val();
                    var stat = vehiclesmodal.find('#stat').val();
                    var type = vehiclesmodal.find('#titleModal').text();
                    var recid = vehiclesmodal.find('#recid').val();
                    
                    $.ajax({
                        url: '<?php echo base_url('datamaint/saveVehicle'); ?>',
                        type: 'post',
                        data: {
                            type: type,
                            mdata: {
                                recid: recid,
                                plate_number: plate_number,
                                unit: unit,
                                seloperator: seloperator,
                                stat: stat
                            }
                        },
                        dataType: 'json',
                        async: false,
                        success: function(result){
                            const obj = result;
                            if(obj==true){
                                if(alert("Record Saved!!!")){
                                    location.reload();
                                }
                            }else{
                                alert("Error: Inserting!!!");
                                console.log(obj);
                                return false;
                            }
                            
                        }
                    });
                });

                vehiclesform.find('#btnUpdate:button').on('click', function(){
                    console.log(this.value);
                    vehiclesform.find('#btnUpdatevehicle:input').click();
                    vehiclesform.find('#titleModal').text('UPDATE');
                    vehiclesform.find('#btnSave').text('UPDATE');
                    vehiclesform.find('input:text').val('');

                    $.ajax({
                        url: '<?php echo base_url('datamaint/getVehicleinfo'); ?>',
                        type: 'post',
                        data: { vid: this.value },
                        dataType: 'json',
                        async: false,
                        success: function(result){
                            const obj = result;
                            vehiclesform.find('#recid').val(obj['id']);
                            vehiclesform.find('#plate_number').val(obj['plate_number']);
                            vehiclesform.find('#unit').val(obj['unit']);
                            vehiclesform.find('#stat').val(obj['active']);
                            
                            $.ajax({
                                url: '<?php echo base_url('datamaint/getOperators'); ?>',
                                type: 'post',
                                dataType: 'json',
                                async: false,
                                success: function(result){
                                    const com = result;
                                    var p_list = ['<option value></option>'];
                                    $.each(com, function(i, val){
                                        if(obj['operator_id'] == this.id){
                                            p_list.push($("<option selected></option>").html(this.lastname+', '+this.firstname+' '+this.middlename).val(this.id));
                                        }else{
                                            p_list.push($("<option></option>").html(this.lastname+', '+this.firstname+' '+this.middlename).val(this.id));
                                        }
                                        
                                    });
                                    $("#seloperator").html(p_list);
                                }
                            });

                        }
                    });
                    

                });
                vehiclesform.find('#btnDelete:button').on('click', function(){
                    var conf = confirm("Do you want to delete this record???");
                    if(conf){
                        $.ajax({
                            url: '<?php echo base_url('datamaint/masterDelete'); ?>',
                            type: 'post',
                            data: { 
                                id: this.value,
                                table_name: 'vehicles'
                            },
                            dataType: 'json',
                            success: function(result){
                                console.log(result);
                                if(result.status){
                                    alert(result.message);
                                    window.location.reload();
                                }
                            } 
                        });
                    }
                });

            },
        }

        __vehiclesform.initialize();
    });
</script>