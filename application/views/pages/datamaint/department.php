<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>


<div class="row" id="departmentform">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12"  style="margin: 10px 0px 10px 0px">
                <div class="form-inline float-right">
                    <div class="form-group">
                        <input type="text" placeholder="Search" size="25" style="margin-left: 5px;">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" style="margin-left: 5px;"><i class="fa fa-search"></i></button>
                    </div>
                    <div class="form-group">
                        <input type="button" id="btnAddDepartment" class="btn btn-success btn-sm" style="margin-left: 5px;" data-toggle="modal" data-target="#departmentModal" value="Add Department">
                        <input type="hidden" id="btnUpdateDepartment" data-toggle="modal" data-target="#departmentModal">
                    </div>
                </div> 
            </div>
        </div>

        <div class="row">   
            <div class="col-md-12"> 
                <table class="table table-responsive-sm table-hover table-bordered table-sm">
                    <thead class="thead-light">
                        <tr style="text-align: center;">
                            <th>DEPARTMENT</th>
                            <th>STATUS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody id="departmentlist"></tbody>
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
    <div class="modal fade" id="departmentModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <label for="deptname">DEPARTMENT:</label>
                                <input type="text" class="form-control form-control-sm" id="deptname">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="selpost">STATUS:</label>
                                    <select class="form-control form-control-sm" id="selpost">
                                        <option selected value="Y">ACTIVE</option>
                                        <option value>INACTIVE</option>
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
        const departmentform = $('#departmentform');
        const departmentmodal = $('#departmentModal');

        const __departmentform = {
            initialize: function(){
                const self = this;
                this.loadForm();
            },

            loadForm: function(){
                const self = this;
                $.ajax({
                    url: '<?php echo base_url('datamaint/getDepartment'); ?>',
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
                                departmentform.find('#departmentlist').empty();
                                $.each(data, function(i,v){
                                    departmentform.find('#departmentlist').append($('<tr>').attr('style', 'text-align: center;')
                                                                .append($('<td>').text(this.dept_name))
                                                                .append($('<td>').attr('style', this.active=='Y'?'color:#22bb33':'color:#bb2124').text(this.active == 'Y' ? 'ACTIVE' : 'INACTIVE'))
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
                departmentform.find('#btnAddDepartment').on('click', function(){
                    departmentform.find('#titleModal').text('ADD');
                    departmentform.find('#btnSave').text('ADD');
                    departmentform.find('#deptname').val('');
                });

                departmentform.find('#btnSave:button').on('click', function(){
                    var deptname = departmentmodal.find('#deptname').val();
                    var active = departmentmodal.find('#selpost').val();
                    var type = departmentmodal.find('#titleModal').text();
                    var recid = departmentmodal.find('#recid').val();
                    
                    $.ajax({
                        url: '<?php echo base_url('datamaint/saveDepartment'); ?>',
                        type: 'post',
                        data: {
                            type: type,
                            mdata: {
                                recid: recid,
                                deptname: deptname,
                                active: active
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

                departmentform.find('#btnUpdate:button').on('click', function(){
                    console.log(this.value);
                    departmentform.find('#btnUpdateDepartment:input').click();
                    departmentform.find('#titleModal').text('UPDATE');
                    departmentform.find('#btnSave').text('UPDATE');
                    departmentform.find('input:text').val('');

                    $.ajax({
                        url: '<?php echo base_url('datamaint/getDepartmentinfo'); ?>',
                        type: 'post',
                        data: { id: this.value },
                        dataType: 'json',
                        async: false,
                        success: function(result){
                            const obj = result;
                            departmentform.find('#recid').val(obj['id']);
                            departmentform.find('#deptname').val(obj['dept_name']);
                            departmentform.find('#selpost').val(obj['active']);
                        }
                    });
                });

            },

        }
        __departmentform.initialize();

    });
</script>