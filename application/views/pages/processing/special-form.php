<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
?>
<div id="specialform">
    <div class="row">
        <div class="col-md-12">
            <div style="margin: 5px 5px 5px 0px;">
                <input id="btnsave" type="button" class="btn btn-primary btn-sm" style="width: 110px; margin-right: 5px;" value="SAVE">
                <input id="btncancel" type="button" class="btn btn-success btn-sm" style="width: 110px; margin-right: 5px;" value="CANCEL">
                <input id="btnclear" type="button" class="btn btn-danger btn-sm" style="width: 110px; margin-right: 5px;" value="CLEAR">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-responsive table-bordered table-hover table-sm">
                <thead class="thead-light">
                    <tr>
                        <th rowspan="3" style="vertical-align:middle;text-align:center; width: 150px;">ROUTE</th>
                        <th id="thcolspan" style="text-align:center;">DAY / TRIP</th>
                    </tr>
                    <tr id="thdays" style="text-align: center;">
                        <th></th>
                    </tr>
                    <tr id="thtrips" style="text-align: center;">
                        <th>RATES</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot></tfoot>
            </table>
        </div>
    </div>
</div>

<script>
$('#specialform').hide();

$(function(){
  var driver_id = $("#driver_id").val();
  const specialform = $("#specialform");

  const __specialform = {
      initialize: function(){
        const self = this;
        this.loadForm();
      },

      loadForm: function(){
        g_messageDialogViewModel.showWaitDialog();
          const self = this;
          $.ajax({
            url: 'regular_trnx',
            type: 'post',
            data: {
                driver_id: driver_id, 
                type: 'special'
            },
            dataType: 'json',
            async: false,
            success: function(result){
                const obj = result;
                if(obj == false){
                    alert("No Special Routes tagged in this Record ...");
                }else{

                var days = obj['total_days'];
                var thcolspan = 3;
                // var thday = '';
                var totaltrips = 0;
                var totalamount = 0;
                var cnt = 1;
                for(var i = obj['from']; i <= obj['to']; i++){
                    thcolspan++;
                    specialform.find('#thdays').append($('<th>').text(parseInt(i)));
                    specialform.find('#thtrips').append($('<th>').attr('id','thtrips_day_'+parseInt(cnt)).css('color','#C21807'));
                    cnt++;
                }
                specialform.find('#thtrips').append($('<th>').text('TRIPS')).append($('<th>').text('TOTAL'));
                specialform.find('#thdays').append($('<th>').text('')).append($('<th>').text(''));
                specialform.find('#thcolspan').attr('colspan', thcolspan);

                specialform.find('tbody').empty();
                $.each(obj['result'], function(i,v){
                    specialform.find('tbody').append($('<tr>').attr('id',this.id).attr('style','text-align:center;')
                                                .append($('<td>').text(this.route_name))
                                                .append($('<td>').text(this.rate))
                                                .append($('<td>').addClass('day_1').attr('style','display: none;')
                                                    .append($('<input>').attr('value', this.day_1 > 0 ? this.day_1 : '').attr('type','text').attr('size',1).attr('maxlength',3)))
                                                .append($('<td>').addClass('day_2').attr('style','display: none;')
                                                    .append($('<input>').attr('value', this.day_2 > 0 ? this.day_2 : '').attr('type','text').attr('size',1).attr('maxlength',3)))
                                                .append($('<td>').addClass('day_3').attr('style','display: none;')
                                                    .append($('<input>').attr('value', this.day_3 > 0 ? this.day_3 : '').attr('type','text').attr('size',1).attr('maxlength',3)))
                                                .append($('<td>').addClass('day_4').attr('style','display: none;')
                                                    .append($('<input>').attr('value', this.day_4 > 0 ? this.day_4 : '').attr('type','text').attr('size',1).attr('maxlength',3))) 
                                                .append($('<td>').addClass('day_5').attr('style','display: none;')
                                                    .append($('<input>').attr('value', this.day_5 > 0 ? this.day_5 : '').attr('type','text').attr('size',1).attr('maxlength',3)))
                                                .append($('<td>').addClass('day_6').attr('style','display: none;')
                                                    .append($('<input>').attr('value', this.day_6 > 0 ? this.day_6 : '').attr('type','text').attr('size',1).attr('maxlength',3)))
                                                .append($('<td>').addClass('day_7').attr('style','display: none;')
                                                    .append($('<input>').attr('value', this.day_7 > 0 ? this.day_7 : '').attr('type','text').attr('size',1).attr('maxlength',3)))
                                                .append($('<td>').addClass('day_8').attr('style','display: none;')
                                                    .append($('<input>').attr('value', this.day_8 > 0 ? this.day_8 : '').attr('type','text').attr('size',1).attr('maxlength',3)))
                                                .append($('<td>').addClass('day_9').attr('style','display: none;')
                                                    .append($('<input>').attr('value', this.day_9 > 0 ? this.day_9 : '').attr('type','text').attr('size',1).attr('maxlength',3)))
                                                .append($('<td>').addClass('day_10').attr('style','display: none;')
                                                    .append($('<input>').attr('value', this.day_10 > 0 ? this.day_10 : '').attr('type','text').attr('size',1).attr('maxlength',3)))
                                                .append($('<td>').addClass('day_11').attr('style','display: none;')
                                                    .append($('<input>').attr('value', this.day_11 > 0 ? this.day_11 : '').attr('type','text').attr('size',1).attr('maxlength',3)))
                                                .append($('<td>').addClass('day_12').attr('style','display: none;')
                                                    .append($('<input>').attr('value', this.day_12 > 0 ? this.day_12 : '').attr('type','text').attr('size',1).attr('maxlength',3)))
                                                .append($('<td>').addClass('day_13').attr('style','display: none;')
                                                    .append($('<input>').attr('value', this.day_13 > 0 ? this.day_13 : '').attr('type','text').attr('size',1).attr('maxlength',3)))
                                                .append($('<td>').addClass('day_14').attr('style','display: none;')
                                                    .append($('<input>').attr('value', this.day_14 > 0 ? this.day_14 : '').attr('type','text').attr('size',1).attr('maxlength',3)))
                                                .append($('<td>').addClass('day_15').attr('style','display: none;')
                                                    .append($('<input>').attr('value', this.day_15 > 0 ? this.day_15 : '').attr('type','text').attr('size',1).attr('maxlength',3)))
                                                .append($('<td>').addClass('day_16').attr('style','display: none;')
                                                    .append($('<input>').attr('value', this.day_16 > 0 ? this.day_16 : '').attr('type','text').attr('size',1).attr('maxlength',3)))
                                                .append($('<td>').text(this.total_trip))
                                                .append($('<td>').attr('id','totalamnt_'+this.id).text(toparseFloat(this.rate * this.total_trip)))
                                            )
                                            totalamount += parseInt(this.rate) * parseInt(this.total_trip);
                                            totaltrips += parseInt(this.total_trip);

                });
                                
                for(var i = 1; i <= days; i++){
                    $('.day_'+i).show();
                    var daytrip = specialform.find('.day_'+parseInt(i)).find('input');
                    var sum = 0;
                    $.each(daytrip, function(ii,vv){
                        sum += parseInt(this.value == '' ? 0 : this.value);
                        specialform.find('#thtrips_day_'+parseInt(i)).text(sum);
                    });
                }

                specialform.find('tfoot')
                    .append($('<tr>').attr('style','text-align:center;')
                        .append($('<td>').attr('style','text-align:right;').attr('colspan', thcolspan-1).append($('<strong>').text('TOTAL')))
                        .append($('<td>').append($('<strong>').text(totaltrips)))
                        .append($('<td>').append($('<strong>').text(toparseFloat(totalamount))))
                    )

                $("#specialform").show();
                self.loadEvents();

                }
                g_messageDialogViewModel.hideWaitDialog();
            }
          });
      },

      loadEvents: function(){
        specialform.find('#btnsave').on('click', function(){          

                var conf = confirm('Are you sure do you want to save? ');
                if(conf){
                    g_messageDialogViewModel.showWaitDialog();
                    var obj = specialform.find('tbody').find('tr');
                    var mdata = [];
                   $.each(obj, function(i,k){

                    for(var aa = 1; aa <= 16; aa++){
                        var cid = this.id;
                        var cday = "day_"+aa;
                        var cval = $('#'+cid).find("."+cday).find('input').val();

                        mdata.push({ 
                            id: cid,
                            _day: cday,
                            value: cval
                        });
                        
                    }
                    
                   });

                   if(mdata.length > 0){
                    $.ajax({
                    url: 'saveTrnx',
                    type: 'post',
                    data: {
                        mdata: mdata,
                        type: 'special'
                    },
                    dataType: 'json',
                    async: false,
                    success: function(result){
                        $('#nav-body_li_menu2').click();
                        alert("Record(s) saved!!!");
                        g_messageDialogViewModel.hideWaitDialog();
                    }
                   });
                   }else{
                       alert("No records to be saved...");
                       g_messageDialogViewModel.hideWaitDialog();
                   }
                }
            });

            specialform.find('#btncancel').on('click', function(){
                var conf = confirm("Are you sure do you want to cancel?");
                if(conf){
                    location.reload(true);
                }
            });

            specialform.find('#btnclear').on('click', function(){
                var conf = confirm("Are you sure do you want to clear all records?");
                if(conf){
                    specialform.find('input:text').val('');
                }
            });
      
      },
  }

  __specialform.initialize();

});
</script>