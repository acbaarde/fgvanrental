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

<div class="row" id="paydriverform">
    <div class="col-md-12">
        <div class="form-group row">
            
        </div>
    </div>
</div>

<script>
    $(function(){
        var paydriverform = $('#paydriverform');
        // paydriverform.hide();
        const __paydriverform = {
            initialize: function(){
                const self = this;
                this.loadForm();
            },

            loadForm: function(){
                const self = this;
                    $.ajax({
                    url: '../getAllYear',
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
                    url: '../getCompany',
                    type: 'post',
                    data: { type: 'T'},
                    dataType: 'json',
                    success: function(result){
                        const obj = result;
                        // console.log(obj);
                        var p_list = ['<option selected value>Please select Company...</option>'];
                        $.each(obj, function(i, val){
                            p_list.push($("<option></option>").html(this.abbr).val(this.company_id));
                        });
                        $("#mcompany").html(p_list);
                    }
                });


                $.ajax({
                    url: '../getPeriod',
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
                $('#toprint').empty().append($('<button>').addClass('btn btn-primary btn-sm').text('PRINT'));
            },

            loadEvents: function(){
                const self = this;

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

                    var myear = $('#myear').val();
                    var mcompany = $('#mcompany').val();
                    var mperiod = $('#mperiod').val();

                    
                    var win = window.open('<?php echo base_url();?>reports/paydriver_rpt?myear='+myear+'&mcompany='+mcompany+'&mperiod='+mperiod, '_blank');
                    win.focus();

                });
            },

        }
        __paydriverform.initialize();
    });
</script>