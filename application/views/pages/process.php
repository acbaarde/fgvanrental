<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h4>Process Trips</h4>
    <!-- <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
          <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
          <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
        <span data-feather="calendar"></span>
        This week
        </button>
    </div> -->
</div>

<div class="row">
  <div class="col-md-12">
    <table id="driverlist" class="table table-bordered table-striped table-hover table-sm">
      <thead id="tblhead" class="thead-light">
        <tr>
          <th>Driver ID</th>
          <th>Driver</th>
          <th>Unit</th>
          <th>Plate #.</th>
        </tr>
      </thead>
      <tbody id="tblbody">
      </tbody>
    </table>
  </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div id="pagination-demo"></div>
    </div>
</div>

<script>
  const driverlist = $("#driverlist");
  const tblhead = $("#tblhead");
  const tblbody = $("#tblbody");

  const __process = {
    initialize: function(){
      const self = this;
      this.loadProcess();
    },
    loadProcess: function(){
      g_messageDialogViewModel.showWaitDialog();
      const self = this;
      $.ajax({
        type: 'POST',
        url: 'processing/loadVehicles',
        dataType: 'json',
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
                              if(data.length > 0){
                                const p_list = [];
                                $.each(data, function(key,val){
                                  p_list.push($('<tr>')
                                    .append($('<td>')
                                      .append($('<u>')
                                        .html(this.driver_id)
                                        .val(this.driver_id)))
                                    .append($('<td>')
                                      .html(this.fullname))
                                    .append($('<td>')
                                      .html(this.unit))
                                    .append($('<td>')
                                      .html(this.plate_number)))
                                });
                                tblbody.empty().append(p_list);
                                self.events();
                                g_messageDialogViewModel.hideWaitDialog();
                              }else{
                                tblbody.append("No records found!!!");
                                g_messageDialogViewModel.hideWaitDialog();
                              }
                            }
          });
        }
      });
    },

    events: function(){
      $('u').on('click', function(){
        const self = this;
        console.log(self.value);

        location.href = "<?php echo base_url()?>processing/viewTrnx?driver_id=" + self.value;
      });
    },
  }

  __process.initialize();
</script>
