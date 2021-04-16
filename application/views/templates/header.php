<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE-edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link href="<?php echo base_url('assets/css/mystyle.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/dashboard.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  
    <script src="<?php echo base_url('assets/js/jquery-3.5.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.blockUI.min.js');?>"></script>
    <script src="<?php echo base_url('assets/mycustom.js'); ?>"></script>


    <title></title>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>


      <script>
        function toparseFloat(num){
            var double = parseFloat(num).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
            return double;
        }

        function formatDateString(date){
          var optn = {year: 'numeric', month: 'long', day: 'numeric' };
          var ddate = new Date(date);

          return ddate.toLocaleDateString("en-US",optn);
        }

        function formatFromToDate(fromdate,todate){
          var optn = { month: 'long', day: 'numeric' };
          var fdate = new Date(fromdate);
          var tdate = new Date(todate);
          var pperiod = fdate.toLocaleDateString("en-US",optn) + ' - ' + tdate.getDate();

          return pperiod;
        }

        // function printna(elementid) {
        //     var printContents = document.getElementById(elementid).innerHTML;
        //     var originalContents = document.body.innerHTML;
        //     document.body.innerHTML = printContents;
        //     window.print();
        //     document.body.innerHTML = originalContents;
        // }

      </script>
    

    

  </head>
  <body>

  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="<?php echo base_url();?>"></a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="#">Sign out</a>
      </li>
    </ul> -->
  </nav>

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="sidebar-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('dashboard')?>">
                <span data-feather="home"></span>Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" data-target="#collapseProcessing">
                <span data-feather="file"></span>Processing</a>
                
                  <div id="collapseProcessing" class="collapse" aria-labelledby="sidebarMenu">
                    <div class="col-md-12">
                    <ul class="nav flex-column">
                      <li class="nav-item">
                          <a class="nav-link" href="<?php echo base_url('processing');?>">
                            <span data-feather="file"></span>Trips
                          </a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="<?php echo base_url('processing/loadPayroll');?>">
                            <span data-feather="file"></span>Payroll
                          </a>
                      </li>
                    </ul>
                    </div>
                  </div>

            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" data-target="#collapseReports">
                <span data-feather="bar-chart-2"></span>Reports</a>

                <div id="collapseReports" class="collapse" aria-labelledby="sidebarMenu">
                  <div class="col-md-12">
                   <ul class="nav flex-column">
                     <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('reports/loadBilling');?>">
                          <span data-feather="bar-chart-2"></span>Billing
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('reports/loadPayslip');?>">
                          <span data-feather="bar-chart-2"></span>Payslip
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('reports/loadReports');?>">
                          <span data-feather="bar-chart-2"></span>Reports
                        </a>
                     </li>
                   </ul>
                  </div>
                </div>

            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('datamaint/view');?>">
                <span data-feather="settings"></span>Data Maintenance</a>
            </li>
          </ul>
        </div>
      </nav>
      <script src="<?php echo base_url('assets/js/feather.min.js'); ?>"></script>
      <script src="<?php echo base_url('assets/dashboard.js'); ?>"></script>
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">