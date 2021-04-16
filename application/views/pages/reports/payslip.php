<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h4>Payslip Reports</h4>
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


<?php $segment = $this->uri->segment(3);?>

<div class="row">
  <div class="col-md-12">

    <ul class="nav nav-tabs nav-justified">
      <li class="nav-item">
        <a <?php echo $segment=='' ? ' class="nav-link active"':  ' class="nav-link"';?> href="<?php echo base_url('reports/payslip');?>">PER TRIP</a></li>
      <li class="nav-item">
        <a <?php echo $segment=='payperday' ? ' class="nav-link active"':  ' class="nav-link"';?> href="<?php echo base_url('reports/payslip/payperday');?>">PER DAY</a></li>
      <li class="nav-item">
        <a <?php echo $segment=='paydrivers' ? ' class="nav-link active"':  ' class="nav-link"';?> href="<?php echo base_url('reports/payslip/paydrivers');?>">DRIVERS</a></li>
    </ul>
    <div class="tab-content">
    <?php $this->load->view($segment == '' ? 'pages/reports/paypertrip' : 'pages/reports/'.$segment);?>
    </div>
    
  </div>
</div>