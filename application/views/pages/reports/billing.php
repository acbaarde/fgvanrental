<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h4>Billing Reports</h4>
</div>

<?php $segment = $this->uri->segment(3);?>

<div class="row">
  <div class="col-md-12">

    <ul class="nav nav-tabs nav-justified">
      <li class="nav-item">
        <a <?php echo $segment=='' ? ' class="nav-link active"':  ' class="nav-link"';?> href="<?php echo base_url('reports/view');?>">PER TRIP</a></li>
      <li class="nav-item">
        <a <?php echo $segment=='perday' ? ' class="nav-link active"':  ' class="nav-link"';?> href="<?php echo base_url('reports/view/perday');?>">PER DAY</a></li>
      <li class="nav-item">
        <a <?php echo $segment=='pertripbreakdown' ? ' class="nav-link active"':  ' class="nav-link"';?> href="<?php echo base_url('reports/view/pertripbreakdown');?>">PER TRIP BREAKDOWN</a></li>
      <li class="nav-item">
        <a <?php echo $segment=='perroutebreakdown' ? ' class="nav-link active"':  ' class="nav-link"';?> href="<?php echo base_url('reports/view/perroutebreakdown');?>">PER ROUTE BREAKDOWN</a></li>
      <li class="nav-item">
        <a <?php echo $segment=='manualbilling' ? ' class="nav-link active"':  ' class="nav-link"';?> href="<?php echo base_url('reports/view/manualbilling');?>">MANUAL BILLING</a></li>
        <li class="nav-item">
        <a <?php echo $segment=='newbilling' ? ' class="nav-link active"':  ' class="nav-link"';?> href="<?php echo base_url('reports/view/newbilling');?>">NEW BILLING</a></li>
      </ul>
    <div class="tab-content">
        <?php $this->load->view($segment == '' ? 'pages/reports/pertrip' : 'pages/reports/'.$segment);?>
    </div>
    
  </div>
</div>
