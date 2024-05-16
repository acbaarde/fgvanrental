<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>


<div class="row" id="operatorsform">
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
                        <input type="button" id="btnAddoperator" class="btn btn-success btn-sm" style="margin-left: 5px;" data-toggle="modal" data-target="#operatorsModal" value="Add Operator">
                        <input type="hidden" id="btnUpdateoperator" data-toggle="modal" data-target="#operatorsModal">
                    </div>
                </div> 
            </div>
        </div>

        <div class="row">   
            <div class="col-md-12"> 
                <table class="table table-responsive-sm table-hover table-bordered table-sm">
                    <thead class="thead-light">
                        <tr style="text-align: center;">
                            <th>LASTNAME</th>
                            <th>FIRSTNAME</th>
                            <th>MIDDLENAME</th>
                            <th>CONTACT</th>
                            <th>ADDRESS</th>
                            <th>STATUS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody id="operatorlist"></tbody>
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
    <div class="modal fade" id="operatorsModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 60%;" role="document">
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
                            
                        </div>
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label for="address">Address: </label>
                                <input type="text" class="form-control form-control-sm" id="address">
                            </div>
                            <div class="form-group">
                                <label for="contactno">Contact no.:</label>
                                <input type="text" class="form-control form-control-sm" id="contactno" maxlength="11">
                            </div>
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
        const operatorsform = $('#operatorsform');
        const operatorsmodal = $('#operatorsModal');
        const __operatorsform = {
            initialize: function(){
                const self = this;
                this.loadForm();
            },

            loadForm: function(){
                const self = this;
                $.ajax({
                    url: '<?php echo base_url('datamaint/getOperators'); ?>',
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
                                operatorsform.find('#operatorlist').empty();
                                $.each(data, function(i,v){
                                    operatorsform.find('#operatorlist').append($('<tr>').attr('style', 'text-align: center;')
                                                                .append($('<td>').text(this.lastname.toUpperCase()))
                                                                .append($('<td>').text(this.firstname.toUpperCase()))
                                                                .append($('<td>').text(this.middlename.toUpperCase()))
                                                                .append($('<td>').text(this.contact.toUpperCase()))
                                                                .append($('<td>').text(this.address.toUpperCase()))
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
                operatorsform.find('#btnAddoperator').on('click', function(){
                    operatorsform.find('#titleModal').text('ADD');
                    operatorsform.find('#btnSave').text('ADD');
                    operatorsform.find('input:text').val('');

                });

                operatorsform.find('#btnSave').on('click', function(){
                    var firstname = operatorsmodal.find('#firstname').val();
                    var middlename = operatorsmodal.find('#middlename').val();
                    var lastname = operatorsmodal.find('#lastname').val();
                    var address = operatorsmodal.find('#address').val();
                    var contact = operatorsmodal.find('#contactno').val();
                    var stat = operatorsmodal.find('#stat').val();
                    var type = operatorsmodal.find('#titleModal').text();
                    var recid = operatorsmodal.find('#recid').val();
                    
                    $.ajax({
                        url: '<?php echo base_url('datamaint/saveOperator'); ?>',
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
                                stat: stat,
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

                operatorsform.find('#btnUpdate:button').on('click', function(){
                    console.log(this.value);
                    operatorsform.find('#btnUpdateoperator:input').click();
                    operatorsform.find('#titleModal').text('UPDATE');
                    operatorsform.find('#btnSave').text('UPDATE');
                    operatorsform.find('input:text').val('');

                    $.ajax({
                        url: '<?php echo base_url('datamaint/getOperatorinfo'); ?>',
                        type: 'post',
                        data: { operator_id: this.value },
                        dataType: 'json',
                        async: false,
                        success: function(result){
                            const obj = result;
                            operatorsform.find('#recid').val(obj['id']);
                            operatorsform.find('#firstname').val(obj['firstname']);
                            operatorsform.find('#lastname').val(obj['lastname']);
                            operatorsform.find('#middlename').val(obj['middlename']);
                            operatorsform.find('#address').val(obj['address']);
                            operatorsform.find('#contactno').val(obj['contact']);
                            operatorsform.find('#stat').val(obj['active']);
                        }
                    });
                });
                
                operatorsform.find('#btnDelete:button').on('click', function(){
                    var conf = confirm("Do you want to delete this record???");
                    if(conf){
                        $.ajax({
                            url: '<?php echo base_url('datamaint/masterDelete'); ?>',
                            type: 'post',
                            data: { 
                                id: this.value,
                                table_name: 'operators'
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

        __operatorsform.initialize();
    });
</script>