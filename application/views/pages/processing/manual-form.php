<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
?>
<div id="manualform">
    <!-- <div class="row">
        <div class="col-md-12">
            <div style="margin: 5px 5px 5px 0px;">
                <input id="btnsave" type="button" class="btn btn-primary btn-sm" style="width: 110px; margin-right: 5px;" value="SAVE">
                <input id="btncancel" type="button" class="btn btn-success btn-sm" style="width: 110px; margin-right: 5px;" value="CANCEL">
                <input id="btnclear" type="button" class="btn btn-danger btn-sm" style="width: 110px; margin-right: 5px;" value="CLEAR">
            </div>
        </div>
    </div> -->
    <div class="row">
        <div class="col-md-12">
            <input type="hidden" id="btnUpdatemanualtrip" data-toggle="modal" data-target="#manualmodal">
            <table class="table table-responsive table-bordered table-hover table-sm">
                <thead class="thead-light">
                    <tr style="text-align: center;">
                        <th style="min-width: 85px;">
                            <button id="btnAddTrip" class="btn btn-success btn-md" type="button" style="margin-right: 5px;" data-toggle="tooltip" data-placement="top" title="Add Trip">
                                <i class="fa fa-plus"></i>
                            </button>
                        </th>
                        <th style="min-width: 160px;">DATE / TIME</th>
                        <th style="min-width: 480px;">ROUTE</th>
                        <th style="min-width: 150px;">REQUESTED BY</th>
                        <th style="min-width: 100px;">RATES</th>
                    </tr>
                </thead>
                <tbody id="manuallist"></tbody>
                <tfoot></tfoot>
            </table>
        </div>
    </div>

    <!-- ADD MODAL -->
    <div class="modal fade" id="manualmodal" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <div class="col-md-2">
                            <label for="datetime">Date / Time:</label>
                            <input type="datetime-local" class="form-control form-control-sm" id="datetime" >
                        </div>
                        <div class="col-md-5 autocomplete">
                            <label for="route">Route</label>
                                <input id="route" class="form-control form-control-sm" type="text">
                            <!-- <label for="route">Route</label>
                            <textarea name="route" id="route" cols="1" rows="3" class="form-control form-control-sm" ></textarea> -->
                        </div>
                        <div class="col-md-3">
                            <label for="requestedby">Requested By:</label>
                            <select name="requestedby" id="requestedby" class="form-control form-control-sm"></select>
                        </div>
                        <div class="col-md-2">
                            <label for="rates">RATES:</label>
                            <input type="text" class="form-control form-control-sm" id="rates" placeholder="0.00" >
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" class="btn btn-primary" style="width: 100px">ADD</button>
                    <button type="button" id="btnCancel" class="btn btn-secondary" data-dismiss="modal"  style="width: 80px">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        var driver_id = $("#driver_id").val();
        var pperiod = $("#pperiod").val();
        const manualform = $('#manualform');
        const manualmodal = $('#manualmodal');
        const __manualForm = {
            initialize: function(){
                const self = this;
                this.loadForm();
            },
            loadForm: function(){
                g_messageDialogViewModel.showWaitDialog();
                const self = this;
                $.ajax({
                    url: 'manual_trnx',
                    type: 'post',
                    data: { driver_id: driver_id, type: 'manual' },
                    dataType: 'json',
                    async: false,
                    success: function(result){
                        const obj = result;
                        if(obj.length>0){
                            $.each(obj, function(i, v){
                                manualform.find('#manuallist').append($('<tr>').attr('style', 'text-align: center;')
                                    .append($('<td>')
                                        .append($('<button>').addClass('btn btn-warning btn-sm').attr('type', 'button').attr('id','btnUpdate').attr('style','margin-right: 5px;').attr('value', this.id)
                                            .append($('<i>').addClass('fa fa-edit'))
                                        )
                                        .append($('<button>').addClass('btn btn-danger btn-sm').attr('type','button').attr('id','btnDelete').attr('value', this.id)
                                            .append($('<i>').addClass('fa fa-trash'))
                                        )
                                    )
                                    .append($('<td>').text(this.datetime))
                                    .append($('<td>').text(this.route))
                                    .append($('<td>').attr('style', 'text-align: center').text(this.dept_name))
                                    .append($('<td>').attr('style', 'text-align: center').text(this.rates))
                                )
                            });
                        }else{
                            manualform.find('#manuallist').append($('<tr>').attr('style', 'text-align: center;')
                                .append($('<td>').attr('colspan','5').text('No records found!'))
                            )
                        }         
                        self.loadEvents();
                        g_messageDialogViewModel.hideWaitDialog();
                    }
                });
            },
            loadEvents: function(){
                const self = this;
            
                manualform.find('#btnAddTrip').on('click', function(){
                    g_messageDialogViewModel.showWaitDialog();
                    manualform.find('#manualModal').modal('toggle');
                    manualmodal.find('#datetime').val("");
                    manualmodal.find('#route').val("");
                    manualmodal.find('#requestedby').val("");
                    manualmodal.find('#rates').val("");
                    manualmodal.find('#recid').val("");
                    self.getDepartment();
                    self.getRoute();
                    g_messageDialogViewModel.hideWaitDialog();
                });

                manualform.find('#btnSave').on('click', function(){
                    g_messageDialogViewModel.showWaitDialog();
                    var datetime = manualmodal.find('#datetime').val();
                    var route = manualmodal.find('#route').val().toUpperCase();
                    var dept_id = manualmodal.find('#requestedby').val();
                    var rates = manualmodal.find('#rates').val();
                    var type = manualmodal.find('#titleModal').text();
                    var recid = manualmodal.find('#recid').val();

                    $.ajax({
                        url: '<?php echo base_url('processing/saveManualTrip'); ?>',
                        type: 'post',
                        data: {
                            type: type,
                            mdata: {
                                recid: recid,
                                driver_id: driver_id,
                                pperiod: pperiod,
                                datetime: datetime,
                                route: route,
                                dept_id: dept_id,
                                rates: rates
                            }
                        },
                        dataType: 'json',
                        async: false,
                        success: function(result){
                            const obj = result;
                            location.reload(true);
                            alert("Record saved!!!");
                            g_messageDialogViewModel.hideWaitDialog();
                        }
                    });
                });

                manualform.find('#btnUpdate:button').on('click', function(){
                    g_messageDialogViewModel.showWaitDialog();
                    manualform.find('#btnUpdatemanualtrip:input').click();
                    manualform.find('#titleModal').text('UPDATE');
                    manualform.find('#btnSave').text('UPDATE');
                    self.getDepartment();
                    self.getRoute();

                    $.ajax({
                        url: '<?php echo base_url('processing/getManualinfo'); ?>',
                        type: 'post',
                        data: { manualtrip_id: this.value },
                        dataType: 'json',
                        async: false,
                        success: function(result){
                            const obj = result;
                            console.log(obj);
                            manualform.find('#recid').val(obj['id']);
                            manualform.find('#datetime').val(obj['datetime']);
                            manualform.find('#requestedby').val(obj['dept_id']);
                            manualform.find('#rates').val(obj['rates']);
                            manualform.find('#route').val(obj['route']);
                            g_messageDialogViewModel.hideWaitDialog();
                        }
                    });
                });

                manualform.find('#btnDelete:button').on('click', function(){
                    var conf = confirm("Do you want to delete this record???");
                    if(conf){
                        $.ajax({
                            url: '<?php echo base_url('datamaint/masterDelete'); ?>',
                            type: 'post',
                            data: { 
                                id: this.value,
                                table_name: 'manual_trips',
                                year: true
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
            getDepartment(){
                $.ajax({
                    url: '../datamaint/getDepartment',
                    type: 'post',
                    dataType: 'json',
                    async: false,
                    success: function(result){
                        const obj = result;
                        var arrDept = ["<option selected value></option>"];
                        $.each(obj, function(i, v){
                            if(this.active=='Y'){
                                arrDept.push("<option value="+this.id+" >"+this.dept_name+"</option>");
                            }
                        });
                        manualmodal.find('#requestedby').html(arrDept);
                    }
                });
            },

            getRoute(){
                $.ajax({
                    url: '../datamaint/getRoute',
                    type: 'post',
                    data: { pperiod: pperiod },
                    dataType: 'json',
                    async: false,
                    success: function(result){
                        const obj = result;
                        routeitems = [];
                        $.each(obj, function(i, v){
                            routeitems.push(this.route);
                        })
                        autocomplete(document.getElementById("route"), routeitems);
                    }
                });
            }
        }

        __manualForm.initialize();
    });
</script>
