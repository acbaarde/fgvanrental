<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>


<div class="row" id="routesform">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12"  style="margin: 10px 0px 10px 0px">

                <div class="form-inline float-left">
                    <div class="form-group">
                        <label for="viewfilter">SHOW:</label>
                            <select class="form-control form-control-sm" id="viewfilter" style="margin-left: 5px;">
                                <option selected value>ALL</option>
                                <option value="R">REGULAR</option>
                                <option value="E">COMBINED</option>
                                <option value="S">SPECIAL</option>
                            </select>
                    </div>
                </div>
                <div class="form-inline float-right">
                    <div class="form-group">
                        <input type="text" placeholder="Search" size="25" style="margin-left: 5px;">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" style="margin-left: 5px;"><i class="fa fa-search"></i></button>
                    </div>
                    <div class="form-group">
                        <input type="button" id="btnAddroute" class="btn btn-success btn-sm" style="margin-left: 5px;" data-toggle="modal" data-target="#routesModal" value="Add Route">
                        <input type="hidden" id="btnUpdateroute" data-toggle="modal" data-target="#routesModal">
                    </div>
                </div> 
            </div>
        </div>

        <div class="row">   
            <div class="col-md-12 table-responsive"> 
                <table class="table table-responsive-sm table-hover table-bordered table-sm">
                    <thead class="thead-light">
                        <tr style="text-align: center;">
                            <th>ROUTE</th>
                            <th>LANDMARK</th>
                            <th>RATE</th>
                            <th>TYPE</th>
                            <th>STATUS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody id="routelist"></tbody>
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
    <div class="modal fade" id="routesModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 60%;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModal">ADD</h5>
                    <input type="hidden" id="route_id">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="route_name">Route:</label>
                                        <input type="text" class="form-control form-control-sm" id="route_name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="selroute_type">Type:</label>
                                            <select class="form-control form-control-sm" id="selroute_type">
                                                <option selected value="R">REGULAR</option>
                                                <option value="E">COMBINED</option>
                                                <option value="S">SPECIAL</option>
                                            </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="landmark">Landmark: </label>
                                <input type="text" class="form-control form-control-sm" id="landmark">
                            </div>
                    
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="rate">Rate: </label>
                                        <input type="text" class="form-control form-control-sm" id="rate">
                                    </div>
                                </div>
                                <div class="col-md-4">
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
        const routesform = $('#routesform');
        const routesmodal = $('#routesModal');

        const __routesform = {
            initialize: function(){
                const self = this;
                this.loadForm();
            },

            loadForm: function(){
                const self = this;
                $.ajax({
                    url: '<?php echo base_url('datamaint/getAllroutes'); ?>',
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
                                routesform.find('#routelist').empty();
                                $.each(data, function(i,v){
                                    routesform.find('#routelist').append($('<tr>').attr('style', 'text-align: center;')
                                                                .append($('<td>').text(this.route_name))
                                                                .append($('<td>').text(this.landmark))
                                                                .append($('<td>').text(this.rate))
                                                                .append($('<td>').text(this.route_trip=='R'? 'REGULAR':this.route_trip=='E'?'COMBINED':'SPECIAL'))
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
                                self.actionbtn();
                            }
                        });
                    }
                });
            },

            loadEvents: function(){
                const self = this;
                routesform.find('#btnAddroute').on('click', function(){
                    routesform.find('#titleModal').text('ADD');
                    routesform.find('#btnSave').text('ADD');
                    routesform.find('input:text').val('');
                });

                routesform.find('#btnSave:button').on('click', function(){
                    var route_name = routesmodal.find('#route_name').val();
                    var selroute_type = routesmodal.find('#selroute_type').val();
                    var landmark = routesmodal.find('#landmark').val();
                    var rate = routesmodal.find('#rate').val();
                    var stat = routesmodal.find('#stat').val();
                    var type = routesmodal.find('#titleModal').text();
                    var route_id = routesmodal.find('#route_id').val();
                    
                    $.ajax({
                        url: '<?php echo base_url('datamaint/saveRoute'); ?>',
                        type: 'post',
                        data: {
                            type: type,
                            mdata: {
                                route_id: route_id,
                                route_name: route_name,
                                selroute_type: selroute_type,
                                landmark: landmark,
                                rate: rate,
                                stat: stat
                            }
                        },
                        dataType: 'json',
                        async: false,
                        success: function(result){
                            const obj = result;
                            console.log(obj);
                            if(obj==true){
                                window.location.reload();
                            }else{
                                alert("Error: Inserting!!!");
                                return false;
                            }
                            
                        }
                    });
                });

                routesform.find('#viewfilter').on('change', function(){
                    var rtype = this.value == '' ? 'getAllroutes' : 'getRoutesbytype';

                    $.ajax({
                    url: '<?php echo base_url('datamaint/'); ?>' + rtype,
                    type: 'post',
                    data: { routetype: this.value },
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
                                routesform.find('#routelist').empty();
                                $.each(data, function(i,v){
                                    routesform.find('#routelist').append($('<tr>').attr('style', 'text-align: center;')
                                                                .append($('<td>').text(this.route_name))
                                                                .append($('<td>').text(this.landmark))
                                                                .append($('<td>').text(this.rate))
                                                                .append($('<td>').text(this.route_trip=='R'? 'REGULAR':this.route_trip=='E'?'COMBINED':'SPECIAL'))
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
                                self.actionbtn();
                            }
                        });
                    }
                });
            });

            },

            actionbtn: function(){
                routesform.find('#btnUpdate:button').on('click', function(){
                    routesform.find('#btnUpdateroute:input').click();
                    routesform.find('#titleModal').text('UPDATE');
                    routesform.find('#btnSave').text('UPDATE');
                    routesform.find('input:text').val('');

                    $.ajax({
                        url: '<?php echo base_url('datamaint/getRouteinfo'); ?>',
                        type: 'post',
                        data: { route_id: this.value },
                        dataType: 'json',
                        async: false,
                        success: function(result){
                            const obj = result;
                            routesform.find('#route_id').val(obj['id']);
                            routesform.find('#route_name').val(obj['route_name']);
                            routesform.find('#landmark').val(obj['landmark']);
                            routesform.find('#rate').val(obj['rate']);
                            routesform.find('#selroute_type').val(obj['route_trip']);
                            routesform.find('#stat').val(obj['active']);

                        }
                    });
                
                });

                routesform.find('#btnDelete:button').on('click', function(){
                    var conf = confirm("Do you want to delete this record???");
                    if(conf){
                        $.ajax({
                            url: '<?php echo base_url('datamaint/masterDelete'); ?>',
                            type: 'post',
                            data: { 
                                id: this.value,
                                table_name: 'routes'
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

        __routesform.initialize();


    });
</script>