<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>


<div class="row" id="driversform">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12"  style="margin: 10px 0px 10px 0px">
                <div class="form-inline float-right">
                    <!-- <div class="form-group">
                        <label for="search">Search:</label>
                    </div> -->
                    <div class="form-group">
                        <input id="txtsearch" type="text" placeholder="Search" size="25" style="margin-left: 5px;">
                    </div>
                    <div class="form-group">
                        <button id="btnSearch" type="submit" class="btn btn-primary" style="margin-left: 5px;"><i class="fa fa-search"></i></button>
                    </div>
                    <div class="form-group">
                        <input type="button" id="btnAdddriver" class="btn btn-success btn-sm" style="margin-left: 5px;" data-toggle="modal" data-target="#driversModal" value="Add Driver">
                        <input type="hidden" id="btnUpdatedriver" data-toggle="modal" data-target="#driversModal">
                    </div>
                </div> 
            </div>
        </div>

        <div class="row">   
            <div class="col-md-12"> 
                <table class="table table-responsive-sm table-hover table-bordered table-sm">
                    <thead class="thead-light">
                        <tr style="text-align: center;">
                            <th>ID</th>
                            <th>LASTNAME</th>
                            <th>FIRSTNAME</th>
                            <th>MIDDLENAME</th>
                            <th>CONTACT</th>
                            <th>ADDRESS</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody id="driverlist"></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ADD Modal -->
    <div class="modal fade" id="driversModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 90%;" role="document">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">First Name:</label>
                                <input type="text" class="form-control form-control-sm" id="firstname">
                            </div>
                            <div class="form-group">
                                <label for="middlename">Middle Name: </label>
                                <input type="text" class="form-control form-control-sm" id="middlename">
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last Name: </label>
                                <input type="text" class="form-control form-control-sm" id="lastname">
                            </div>
                            <div class="form-group">
                                <label for="address">Address: </label>
                                <input type="text" class="form-control form-control-sm" id="address">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selcompany">Company:</label>
                                    <select class="form-control form-control-sm" id="selcompany">
                                        <!-- <option selected>Please Select Company...</option> -->
                                    </select>
                            </div>

                            <div class="form-group">
                                <label for="selvehicle">Vehicle:</label>
                                    <select class="form-control form-control-sm" id="selvehicle">
                                        <!-- <option selected>Please Select Vehicle...</option> -->
                                    </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="textoperator">Operator:</label>
                                        <input type="text" class="form-control form-control-sm" id="textoperator" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="textplateno">Plate no.:</label>
                                        <input type="text" class="form-control form-control-sm" id="textplateno" disabled>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contactno">Contact no.:</label>
                                        <input type="text" class="form-control form-control-sm" id="contactno" maxlength="11">
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

                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="reg-tab" data-toggle="tab" href="#reg" role="tab" aria-controls="reg" aria-selected="true">Regular Routes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="ext-tab" data-toggle="tab" href="#ext" role="tab" aria-controls="ext" aria-selected="false">Extended Routes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="spe-tab" data-toggle="tab" href="#spe" role="tab" aria-controls="spe" aria-selected="false">Special Routes</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="reg" role="tabpanel" aria-labelledby="reg-tab">
                                    <div class="col-md-12" style="margin: 10px 0px 10px 0px;">
                                        <table class="table table-bordered table-responsive-lg table-sm">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th></th>
                                                    <th style="width: 100px">NAME</th>
                                                    <th>LANDMARK</th>
                                                    <th>RATES</th>
                                                </tr>
                                            </thead>
                                            <tbody id="checkregularroutes">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="ext" role="tabpanel" aria-labelledby="ext-tab">
                                    <div class="col-md-12" style="margin: 10px 0px 10px 0px;">
                                        <table class="table table-bordered table-responsive-lg table-sm">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th></th>
                                                    <th>NAME</th>
                                                    <th>LANDMARK</th>
                                                    <th>RATES</th>
                                                </tr>
                                            </thead>
                                            <tbody id="checkextendedroutes">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="spe" role="tabpanel" aria-labelledby="spe-tab">
                                    <div class="col-md-12" style="margin: 10px 0px 10px 0px;">
                                        <table class="table table-bordered table-responsive-lg table-sm">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th></th>
                                                    <th>NAME</th>
                                                    <th>LANDMARK</th>
                                                    <th>RATES</th>
                                                </tr>
                                            </thead>
                                            <tbody id="checkspecialroutes">
                                            </tbody>
                                        </table>
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
        const driversform = $('#driversform');
        const driversmodal = $('#driversModal');
        const __driversform = {
            initialize: function(){
                const self = this;
                this.loadForm();
                
            },

            loadForm: function(){
                const self = this;
                $.ajax({
                    url: 'getDrivers',
                    type: 'post',
                    dataType: 'json',
                    async: false,
                    success: function(result){
                        const obj = result;
                        $.each(obj, function(i,v){
                            driversform.find('#driverlist').append($('<tr>').attr('style', 'text-align: center;')
                                                        .append($('<td>').append($('<u>').html(this.driver_id).val(this.driver_id)))
                                                        .append($('<td>').text(this.lastname.toUpperCase()))
                                                        .append($('<td>').text(this.firstname.toUpperCase()))
                                                        .append($('<td>').text(this.middlename.toUpperCase()))
                                                        .append($('<td>').text(this.contact.toUpperCase()))
                                                        .append($('<td>').text(this.address.toUpperCase()))
                                                        .append($('<td>').text(this.active == 'Y' ? 'ACTIVE' : 'INACTIVE'))
                                                    )
                        });

                        self.loadEvents();
                    }

                });
            },

            loadEvents: function(){
                const self = this;
                driversform.find('#btnAdddriver:input').on('click', function(){
                    
                    driversform.find('#titleModal').text('ADD');
                    driversform.find('#btnSave').text('ADD');
                    driversform.find('input:text').val('');

                    self.loadAllroutes();

                    driversform.find('input:checkbox').prop('checked',false);

                    $.ajax({
                        url: 'getCompanys',
                        type: 'post',
                        dataType: 'json',
                        async: false,
                        success: function(result){
                            const obj = result;
                            var p_list = ['<option selected value></option>'];
                            $.each(obj, function(i, val){
                                p_list.push($("<option></option>").html(this.company_name).val(this.company_id));
                            });
                            $("#selcompany").html(p_list);
                        }
                    });
                    $.ajax({
                        url: 'getVehicles',
                        type: 'post',
                        dataType: 'json',
                        async: false,
                        success: function(result){
                            const obj = result;
                            var p_list = ['<option selected value></option>'];
                            $.each(obj, function(i, val){
                                if(this.stat == 'A'){
                                    p_list.push($("<option></option>").html(this.unit + " - " + this.plate_number).val(this.id));
                                }
                            });
                            $("#selvehicle").html(p_list);
                        }
                    });    
                });

                driversform.find('#selvehicle').on('change', function(){
                    var vehicle_id = $('#selvehicle').val();
                    if(vehicle_id > 0){
                        $.ajax({
                            url: 'getVehicleinfo',
                            type: 'post',
                            data: { vid: vehicle_id  },
                            dataType: 'json',
                            async: false,
                            success: function(result){
                                const obj = result;
                                $("#textoperator").val(obj['operator']); $("#textplateno").val(obj['plate_number']);
                            }
                        });
                    }else{
                        driversform.find('#textoperator').val('');
                        driversform.find('#textplateno').val('');
                    }
                    
                });

                driversform.find('#btnSave:button').on('click', function(){
                        var firstname = driversmodal.find('#firstname').val();
                        var middlename = driversmodal.find('#middlename').val();
                        var lastname = driversmodal.find('#lastname').val();
                        var address = driversmodal.find('#address').val();
                        var contact = driversmodal.find('#contactno').val();
                        var selcompany = driversmodal.find('#selcompany').val();
                        var selvehicle = driversmodal.find('#selvehicle').val();
                        var stat = driversmodal.find('#stat').val();
                        var type = driversmodal.find('#titleModal').text();
                        var recid = driversmodal.find('#recid').val();
                        var chkdcount = driversmodal.find('input:checked');
                        var routes_id = '';
                        
                        $.each(chkdcount, function(i,v){
                            routes_id += this.value + 'xOx';
                        });

                        $.ajax({
                            url: 'saveDriver',
                            type: 'post',
                            data: {
                                type: type,
                                mdata: {
                                    recid: recid,
                                    firstname: firstname,
                                    middlename: middlename,
                                    lastname: lastname,
                                    address: address,
                                    contact: contact,
                                    selcompany: selcompany,
                                    selvehicle: selvehicle,
                                    stat: stat,
                                    routes_id: routes_id
                                }
                            },
                            dataType: 'json',
                            async: false,
                            success: function(result){
                                const obj = result;                         
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


                driversform.find('u').on('click', function(){
                    driversform.find('#btnUpdatedriver:input').click();
                    driversform.find('#titleModal').text('UPDATE');
                    driversform.find('#btnSave').text('UPDATE');
                    driversform.find('input:text').val('');
                    self.loadAllroutes();
                    driversform.find('input:checkbox').prop('checked', false);

                    $.ajax({
                        url: 'getDriverinfo',
                        type: 'post',
                        data: { driver_id: this.value },
                        dataType: 'json',
                        async: false,
                        success: function(result){
                            const obj = result;
                            driversform.find('#recid').val(obj['id']);
                            driversform.find('#firstname').val(obj['firstname']);
                            driversform.find('#lastname').val(obj['lastname']);
                            driversform.find('#middlename').val(obj['middlename']);
                            driversform.find('#address').val(obj['address']);
                            driversform.find('#textoperator').val(obj['operator']);
                            driversform.find('#textplateno').val(obj['plate_number']);
                            driversform.find('#contactno').val(obj['contact']);
                            driversform.find('#stat').val(obj['active']);

                            $.ajax({
                                url: 'getCompanys',
                                type: 'post',
                                dataType: 'json',
                                async: false,
                                success: function(result){
                                    const com = result;
                                    var p_list = ['<option value></option>'];
                                    $.each(com, function(i, val){
                                        if(obj['company'] == this.company_id){
                                            p_list.push($("<option selected></option>").html(this.company_name).val(this.company_id));
                                        }else{
                                            p_list.push($("<option></option>").html(this.company_name).val(this.company_id));
                                        }
                                        
                                    });
                                    $("#selcompany").html(p_list);
                                }
                            });

                            $.ajax({
                                url: 'getVehicles',
                                type: 'post',
                                dataType: 'json',
                                async: false,
                                success: function(result){
                                    const veh = result;
                                    var p_list = ['<option value></option>'];
                                    $.each(veh, function(i, val){
                                        if(obj['vehicle_id'] == this.id){
                                            p_list.push($("<option selected></option>").html(this.unit + " - " + this.plate_number).val(this.id));
                                        }else{
                                            if(this.stat == 'A'){
                                                p_list.push($("<option></option>").html(this.unit + " - " + this.plate_number).val(this.id));
                                            }
                                        }
                                        
                                    });
                                    $("#selvehicle").html(p_list);
                                }
                            });

                            $.each(obj['reg_routes'].split('xOx'), function(i,v){
                                if(this != ""){
                                    $('#'+this+':input:checkbox').prop('checked', true);
                                }
                            })
                            $.each(obj['ext_routes'].split('xOx'), function(i,v){
                                if(this != ""){
                                    $('#'+this+':input:checkbox').prop('checked', true);
                                }
                            })
                            $.each(obj['spe_routes'].split('xOx'), function(i,v){
                                if(this != ""){
                                    $('#'+this+':input:checkbox').prop('checked', true);
                                }
                            })

                        }
                    });

                });

                 driversform.find('#btnSearch').on('click', function(){
                    g_messageDialogViewModel.showWaitDialog();
                    $.ajax({
                        url: 'searchDriver',
                        type: 'post',
                        data: { mdata: $('#txtsearch').val() },
                        dataType: 'json',
                        async: false,
                        success: function(result){
                            const obj = result;
                            driversform.find('#driverlist').empty();
                            $.each(obj, function(i,v){
                                driversform.find('#driverlist').append($('<tr>').attr('style', 'text-align: center;')
                                                            .append($('<td>').append($('<u>').html(this.driver_id).val(this.driver_id)))
                                                            .append($('<td>').text(this.lastname.toUpperCase()))
                                                            .append($('<td>').text(this.firstname.toUpperCase()))
                                                            .append($('<td>').text(this.middlename.toUpperCase()))
                                                            .append($('<td>').text(this.contact.toUpperCase()))
                                                            .append($('<td>').text(this.address.toUpperCase()))
                                                            .append($('<td>').text(this.active == 'Y' ? 'ACTIVE' : 'INACTIVE'))
                                                        )
                            });
                            self.loadEvents();
                            g_messageDialogViewModel.hideWaitDialog();
                        }
                    });
                 });
            },

            loadAllroutes: function(){
                $.ajax({
                    url: 'getAllroutes',
                    type: 'post',
                    dataType: 'json',
                    async: false,
                    success: function(result){
                        const obj = result;
                        var regrouteslist = [];
                        var extrouteslist = [];
                        var sperouteslist = [];
                        $.each(obj, function(i,v){
                            if(this.route_trip == 'R'){
                                regrouteslist.push($('<tr>')
                                                .append($('<td>')
                                                    .append($('<input>').attr('type','checkbox').attr('id',this.id).val(this.id))
                                                )
                                                .append($('<td>').text(this.route_name))
                                                .append($('<td>').text(this.landmark))
                                                .append($('<td>').text(this.rate))
                                            );
                            }else if(this.route_trip == 'E'){
                                extrouteslist.push($('<tr>')
                                                .append($('<td>')
                                                    .append($('<input>').attr('type','checkbox').attr('id',this.id).val(this.id))
                                                )
                                                .append($('<td>').text(this.route_name))
                                                .append($('<td>').text(this.landmark))
                                                .append($('<td>').text(this.rate))
                                            );
                            }else if(this.route_trip == 'S'){
                                sperouteslist.push($('<tr>')
                                                .append($('<td>')
                                                    .append($('<input>').attr('type','checkbox').attr('id',this.id).val(this.id))
                                                )
                                                .append($('<td>').text(this.route_name))
                                                .append($('<td>').text(this.landmark))
                                                .append($('<td>').text(this.rate))
                                            );
                            }

                            driversform.find('#checkregularroutes').html(regrouteslist);
                            driversform.find('#checkextendedroutes').html(extrouteslist);
                            driversform.find('#checkspecialroutes').html(sperouteslist);
                        });
                    }
                });
            },
        }

        __driversform.initialize();
    });
</script>