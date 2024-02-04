<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>


<div class="row" id="companysform">
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
                        <input type="button" id="btnAddcompany" class="btn btn-success btn-sm" style="margin-left: 5px;" data-toggle="modal" data-target="#companysModal" value="Add Company">
                        <input type="hidden" id="btnUpdatecompany" data-toggle="modal" data-target="#companysModal">
                    </div>
                </div> 
            </div>
        </div>

        <div class="row">   
            <div class="col-md-12 table-responsive"> 
                <table class="table table-responsive-sm table-hover table-bordered table-sm">
                    <thead class="thead-light">
                        <tr style="text-align: center;">
                            <th>COMPANY NAME</th>
                            <th>ADDRESS</th>
                            <th>EMAIL</th>
                            <th>CONTACT</th>
                            <th>REFERENCE</th>
                            <th>ABBR</th>
                            <th>TYPE</th>
                            <th>STATUS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody id="companylist"></tbody>
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
    <div class="modal fade" id="companysModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 60%;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModal">ADD</h5>
                    <input type="hidden" id="company_id">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="company_name">Company Name:</label>
                                        <input type="text" class="form-control form-control-sm" id="company_name">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="abbr">ABBR:</label>
                                        <input type="text" class="form-control form-control-sm" id="abbr" disabled>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="address">Address: </label>
                                <input type="text" class="form-control form-control-sm" id="address">
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="email">Email: </label>
                                        <input type="email" class="form-control form-control-sm" id="email">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contactno">Contact: </label>
                                        <input type="text" class="form-control form-control-sm" id="contactno" maxlength="11">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="refno">Reference no.: </label>
                                        <input type="text" class="form-control form-control-sm" id="refno">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="stat">Status:</label>
                                            <select class="form-control form-control-sm" id="stat">
                                                <option selected value="Y">ACTIVE</option>
                                                <option value="N">INACTIVE</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="seltype">Type:</label>
                                            <select class="form-control form-control-sm" id="seltype">
                                                <option selected value="T">PER TRIP</option>
                                                <option value="D">PER DAY</option>
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
        const companysform = $('#companysform');
        const companysmodal = $('#companysModal');



        companysmodal.find('#company_name:input').on('input',function(){
            if(this.value.length <= 4){
                companysmodal.find('#abbr:input').val(this.value);
            }
        });

        const __companysform = {
            initialize: function(){
                const self = this;
                this.loadForm();
            },

            loadForm: function(){
                const self = this;
                $.ajax({
                    url: '<?php echo base_url('datamaint/getCompanys'); ?>',
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
                                companysform.find('#companylist').empty();
                                $.each(data, function(i,v){
                                    companysform.find('#companylist').append($('<tr>').attr('style', 'text-align: center;')
                                                                .append($('<td>').text(this.company_name))
                                                                .append($('<td>').text(this.address))
                                                                .append($('<td>').text(this.email))
                                                                .append($('<td>').text(this.contact))
                                                                .append($('<td>').text(this.refno))
                                                                .append($('<td>').text(this.abbr))
                                                                .append($('<td>').text(this.type == 'T' ? 'PER TRIP' : this.type == 'D' ? 'PER DAY' : ''))
                                                                .append($('<td>').addClass(this.active=='Y'?'classStatusActive':'classStatusInactive').text(this.active == 'Y' ? 'ACTIVE' : 'INACTIVE'))
                                                                .append($('<td>')
                                                                    .append($('<button>').addClass('btn btn-warning btn-sm').attr('type','button').attr('id','btnUpdate').attr('style','margin-right: 5px;').attr('value', this.company_id)
                                                                        .append($('<i>').addClass('fa fa-edit'))
                                                                    )
                                                                    .append($('<button>').addClass('btn btn-danger btn-sm').attr('type','button').attr('id','btnDelete').attr('value', this.company_id)
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
                companysform.find('#btnAddcompany').on('click', function(){
                    companysform.find('#titleModal').text('ADD');
                    companysform.find('#btnSave').text('ADD');
                    companysform.find('input:text').val('');

                });

                companysform.find('#btnSave:button').on('click', function(){
                    var company_name = companysmodal.find('#company_name').val();
                    var address = companysmodal.find('#address').val();
                    var email = companysmodal.find('#email').val();
                    var abbr = companysmodal.find('#abbr').val();
                    var contactno = companysmodal.find('#contactno').val();
                    var refno = companysmodal.find('#refno').val();
                    var stat = companysmodal.find('#stat').val();
                    var type = companysmodal.find('#titleModal').text();
                    var company_id = companysmodal.find('#company_id').val();
                    var seltype = companysmodal.find('#seltype').val();
                    
                    $.ajax({
                        url: '<?php echo base_url('datamaint/saveCompany'); ?>',
                        type: 'post',
                        data: {
                            type: type,
                            mdata: {
                                company_id: company_id,
                                company_name: company_name,
                                abbr: abbr,
                                address: address,
                                email: email,
                                contact: contactno,
                                refno: refno,
                                stat: stat,
                                seltype: seltype
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

                companysform.find('#btnUpdate:button').on('click', function(){
                    companysform.find('#btnUpdatecompany:input').click();
                    companysform.find('#titleModal').text('UPDATE');
                    companysform.find('#btnSave').text('UPDATE');
                    companysform.find('input:text').val('');

                    $.ajax({
                        url: '<?php echo base_url('datamaint/getCompanyinfo'); ?>',
                        type: 'post',
                        data: { company_id: this.value },
                        dataType: 'json',
                        async: false,
                        success: function(result){
                            const obj = result;
                            companysform.find('#company_id').val(obj['company_id']);
                            companysform.find('#company_name').val(obj['company_name']);
                            companysform.find('#address').val(obj['address']);
                            companysform.find('#email').val(obj['email']);
                            companysform.find('#contactno').val(obj['contact']);
                            companysform.find('#refno').val(obj['refno']);
                            companysform.find('#abbr').val(obj['abbr']);
                            companysform.find('#stat').val(obj['active']);
                            companysform.find('#seltype').val(obj['type']);

                        }
                    });
                    

                });
                companysform.find('#btnDelete:button').on('click', function(){
                    console.log(this.value);
                });


            },
        }

        __companysform.initialize();


    });
</script>