<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-md-12"  style="margin: 10px 0px 10px 0px">
        <div id="toprint" class="form-inline float-left"></div>
        <div class="form-inline float-right">
            <div class="form-vertical">
                <div class="form-group">
                    <select id="myear"><option selected value hidden>Please select Year...</option></select>
                    <select id="mcompany" style="margin-left: 5px;"><option selected value hidden>Please select Company...</option></select>
                    <select id="mperiod" style="margin-left: 5px;"><option selected value hidden>Please select Period...</option></select>
                </div>
            </div>
        </div> 
    </div>
</div>

<div class="row">
    <div class="col-md-12" id="alert_id"></div>
</div>

<div class="row" id="perdriverbreakdownform"></div>

<script>
    $(function(){
        var perdriverbreakdownform = $('#perdriverbreakdownform');
        // perdriverbreakdownform.hide();
        const __perdriverbreakdownform = {
            initialize: function(){
                const self = this;
                this.loadForm();
            },

            loadForm: function(){
                const self = this;
                $.ajax({
                    url: '<?php echo base_url('reports/getAllYear'); ?>',
                    type: 'post',
                    dataType: 'json',
                    success: function(result){
                        const obj = result;
                        var p_list = ['<option selected value>Please select Year...</option>'];
                        $.each(obj, function(i, val){
                            p_list.push($("<option></option>").html(this.year).val(this.year));
                        });
                        $("#myear").html(p_list);
                    }
                });

                $.ajax({
                    url: '<?php echo base_url('reports/getCompany'); ?>',
                    type: 'post',
                    data: { type: 'T'},
                    dataType: 'json',
                    success: function(result){
                        const obj = result;
                        var p_list = ['<option selected value>Please select Company...</option>'];
                        $.each(obj, function(i, val){
                            p_list.push($("<option></option>").html(this.abbr).val(this.company_id));
                        });
                        $("#mcompany").html(p_list);
                    }
                });


                $.ajax({
                    url: '<?php echo base_url('reports/getPeriod'); ?>',
                    type: 'post',
                    dataType: 'json',
                    success: function(result){
                        const obj = result;
                        var p_list = ['<option selected value>Please select Period...</option>'];
                        $.each(obj, function(i, val){
                            p_list.push($("<option></option>").html(this.cfrom).val(this.cfrom));
                        });
                        $("#mperiod").html(p_list);
                    }
                });
                self.loadEvents();
            },

            loadReports: function(){
                const self = this;
                $.ajax({
                    url: '<?php echo base_url('reports/getperdriverbreakdown_rpt'); ?>',
                    type: 'post',
                    data: { 
                        mdata: {
                            myear: $('#myear').val(),
                            mcompany: $('#mcompany').val(),
                            mperiod: $('#mperiod').val()
                        }
                    },
                    dataType: 'json',
                    // async: false,
                    success: function(result){
                        const obj = result;
                        console.log(obj);
                        perdriverbreakdownform.empty();
                        $.each(obj['result'], function(i,v){
                            perdriverbreakdownform
                                .append($('<div>').addClass('col-md-12').attr('style', 'margin-bottom: 10px;')
                                    .append($('<div>').addClass('card')
                                        .append($('<div>').addClass('card-body')
                                            //FORM GROUP
                                            .append($('<div>').addClass('form-group row').attr('style', 'margin-bottom: 5px;')
                                                .append($('<div>').addClass('col-md-12')
                                                    .append($('<h5>').attr('style','margin-bottom: 0;')
                                                        .append($('<strong>').text('FG VAN RENTAL'))
                                                    )
                                                )
                                            )
                                            //FORM GROUP
                                            .append($('<div>').addClass('form-group row').attr('style','margin-bottom: 5px;')
                                                .append($('<div>').addClass('col-md-4')
                                                    .append($('<div>').addClass('form-group row').attr('style','margin-bottom: 0;')
                                                        .append($('<div>').addClass('col-md-12')
                                                            .append($('<ul>').addClass('list-unstyled').attr('style', 'margin-bottom: 0;')
                                                                .append($('<li>')
                                                                    .append($('<ul>').addClass('list-inline')
                                                                        .append($('<li>').attr('style','width: 70px;').text('DRIVER:'))
                                                                        .append($('<li>').attr('display','inline')
                                                                            .append($('<strong>').text(this.driver_name))
                                                                        )
                                                                    )
                                                                    .append($('<ul>').addClass('list-inline')
                                                                        .append($('<li>').attr('style','width: 70;').text('PERIOD:'))
                                                                        .append($('<li>').attr('display','inline')
                                                                            .append($('<strong>').text(this.pperiod))
                                                                        )
                                                                    )
                                                                    .append($('<ul>').addClass('list-inline')
                                                                        .append($('<li>').attr('style','width: 70;').text('REF NO.:'))
                                                                        .append($('<li>').attr('display','inline')
                                                                            .append($('<strong>').text(this.refno))
                                                                        )
                                                                    )
                                                                )
                                                            )
                                                        )
                                                    )
                                                )
                                                .append($('<div>').addClass('col-md-4')
                                                    .append($('<div>').addClass('form-group row').attr('style','margin-bottom: 0;')
                                                        .append($('<div>').addClass('col-md-12')
                                                            .append($('<ul>').addClass('list-unstyled').attr('style','margin-bottom: 0;')
                                                                .append($('<li>')
                                                                    .append($('<ul>').addClass('list-inline')
                                                                        .append($('<li>').attr('style','width: 100px;').text('COMPANY:'))
                                                                        .append($('<li>').attr('display','inline').text(this.company_name))
                                                                    )
                                                                    .append($('<ul>').addClass('list-inline')
                                                                        .append($('<li>').attr('style','width: 100px;').text('PLATE #.:'))
                                                                        .append($('<li>').attr('display','inline').text(this.plate_number))
                                                                    )
                                                                    // .append($('<ul>').addClass('list-inline')
                                                                    //     .append($('<li>').attr('style','width: 130px;').text('SPECIAL TRIP'))
                                                                    //     .append($('<li>').attr('display','inline').text('regular'))
                                                                    // )
                                                                )
                                                            )
                                                        )
                                                    )
                                                )
                                                .append($('<div>').addClass('col-md-4')
                                                    .append($('<div>').addClass('form-group row').attr('style','margin-bottom: 0;')
                                                        .append($('<div>').addClass('col-md-12')
                                                            .append($('<ul>').addClass('list-unstyled').attr('style','margin-bottom: 0;')
                                                                .append($('<li>')
                                                                    .append($('<ul>').addClass('list-inline')
                                                                        .append($('<li>').attr('style','width: 130px;').text(''))
                                                                        .append($('<li>').attr('display','inline').text(''))
                                                                    )
                                                                    .append($('<ul>').addClass('list-inline')
                                                                        .append($('<li>').attr('style','width: 130px;').text('TOTAL TRIPS'))
                                                                        .append($('<li>').attr('display','inline')
                                                                            .append($('<h5>').attr('id','totaltrips_'+i)))
                                                                    )
                                                                    .append($('<ul>').addClass('list-inline')
                                                                        .append($('<li>').attr('style','width: 130px;').text('TOTAL AMOUNT'))
                                                                        .append($('<li>').attr('display','inline')
                                                                            .append($('<h5>').attr('id','totalamnt_'+i)))
                                                                    )
                                                                )
                                                            )
                                                        )
                                                    )
                                                )
                                                
                                            )
                                            .append($('<div>').addClass('row')
                                                .append($('<div>').addClass('col-md-12').attr('id','table_id_'+i)
                                                    
                                                )
                                            )
                                        )
                                    )
                                )
                            var title = ['regular','extended','special'];
                            var days = this.days;
                            var from = this.cfrom;
                            var to = this.cto;
                            var data = this;
                            var totaltrips_ = 0;
                            var totalamnt_ = 0;
                            $.each(title, function(){
                                self.loadTable(i,days,this);
                                self.thhead(i,from,to,this);
                                self.loadtbody(i,data[this],days,this);
                                totaltrips_ += parseInt(perdriverbreakdownform.find('#tfoot_trip_'+this+i).val());
                                totalamnt_ += parseInt(perdriverbreakdownform.find('#tfoot_amnt_'+this+i).val());
                                
                            });
                            perdriverbreakdownform.find('#totaltrips_'+i).text(totaltrips_);
                            perdriverbreakdownform.find('#totalamnt_'+i).text(toparseFloat(totalamnt_));
                        });                        
                    }
                });
            },

            loadTable: function(id,days,title){
                var ttitle = title.toUpperCase();
                perdriverbreakdownform.find('#table_id_'+id)
                .append($('<table>').addClass('table table-bordered table-responsive-sm table-sm')
                    .append($('<thead>').addClass('thead-light').attr('style','text:align: center')
                        // .append($('<tr>').attr('id','trhead_'+title+id).attr('style','text-align: center')
                        //     .append($('<th>').text('TOTAL TRIPS').attr('colspan',2).attr('style','vertical-align:middle;text-align:center; width: 150px;'))
                        // )
                        .append($('<tr>')
                            .append($('<th>').text(ttitle).attr('style','vertical-align:middle;text-align:center; width: 150px;'))
                            .append($('<th>').text('DAY / TRIP').attr('colspan',parseInt(days) + 3).attr('style','text-align: center'))
                        )
                        .append($('<tr>').attr('id','th_'+ title + id).attr('style','text-align: center')
                            
                        )
                    )
                    .append($('<tbody>').attr('id','tbody_'+ title + id)

                    )
                    .append($('<tfoot>')
                        .append($('<tr>').attr('style','text-align: center')
                            .append($('<td>').attr('style','text-align: right').attr('colspan', parseInt(days) + 2)
                                .append($('<strong>').text('TOTAL:'))
                            )
                            .append($('<td>')
                                .append($('<strong>').attr('id','tfoot_trip_'+title+id))
                            )
                            .append($('<td>')
                                .append($('<strong>').attr('id','tfoot_amnt_'+title+id))
                            )
                        )
                    )
                )
            },

            thhead: function(id,cfrom,cto,title){
                var from = new Date(cfrom);
                var to = new Date(cto);
                var cntr = 1;
                perdriverbreakdownform.find('#th_'+ title + id).empty().append($('<th>').text('ROUTES')).append($('<th>').text('RATES'));
                perdriverbreakdownform.find('#trhead_regular' + id).empty();
                perdriverbreakdownform.find('#trhead_regular' + id).append($('<th>').text('TOTAL TRIPS').attr('colspan',2));
                for(var i = from.getDate(); i <= to.getDate(); i++){
                    perdriverbreakdownform.find('#th_'+ title + id).append($('<th>').text(parseInt(i)));
                    // perdriverbreakdownform.find('#trhead_regular' + id).append($('<th>').attr('id',id+'_th_day_'+parseInt(cntr)).text('0'));
                    // cntr++;
                }
                perdriverbreakdownform.find('#th_'+ title + id).append($('<th>').text('TRIPS')).append($('<th>').text('AMOUNT'));
                // perdriverbreakdownform.find('#trhead_regular' + id).append($('<th>')).append($('<th>'));
            },

            loadtbody: function(id,data,days,title){
                var trips = 0; 
                var amnt = 0;
                var tdays = 0;
                $.each(data, function(){
                    perdriverbreakdownform.find('#tbody_'+title+ id)
                        .append($('<tr>').attr('style','text-align: center')
                            .append($('<td>').text(this.route_name))
                            .append($('<td>').text(this.rate))
                        )

                    for(var i = 1; i <= days; i++){
                        perdriverbreakdownform.find('#tbody_'+title+id).find('tr:last')
                            .append($('<td>').text(this["day_" + i] == 0 ? '' : this["day_" + i]))
                    }
                    perdriverbreakdownform.find('#tbody_'+title+id).find('tr:last')
                            .append($('<td>').text(this.total_trip))
                            .append($('<td>').text(this.total_amount))

                    trips += parseInt(this.total_trip);
                    amnt += parseInt(this.total_amount);
                });
                perdriverbreakdownform.find('#tfoot_trip_'+title+id).val(trips).text(trips);
                perdriverbreakdownform.find('#tfoot_amnt_'+title+id).val(amnt).text(toparseFloat(amnt));
            },
            
            loadEvents: function(){
                const self = this;

                $('#toprint').on('click', function(){
                    perdriverbreakdownform.find('#toprint').empty();
                    // perdriverbreakdownform.removeClass('table-responsive-sm');
                    var printContents = document.getElementById('card_id').innerHTML;
                    var originalContents = document.body.innerHTML;
                    document.body.innerHTML = printContents;
                    window.print();
                    document.body.innerHTML = originalContents;

                    location.reload();
                });

                $("#mperiod").on('change', function(){
                    if($('#myear').val() == ''){
                        alert('Please Select Year ...');
                        $("#mperiod").val('');
                        return false;
                    }
                    if($('#mcompany').val() == ''){
                        alert('Please Select Company ...');
                        $("#mperiod").val('');
                        return false;
                    }

                    self.loadReports();
                });
            },

        }
        __perdriverbreakdownform.initialize();
    });
</script>