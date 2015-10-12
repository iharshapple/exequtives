<?php
  $headerData = $this->headerlib->data();
  $total_users = $this->dashboard_model->getNumberOfUsers();
  
?>
<!doctype html>
<html lang="en-us">
<head>
    <title><?= $title?></title>
    <?= $headerData['meta_tags']; ?>
    <?= $headerData['stylesheets_dash']; ?>    
</head>
<body>
  <?php $this->load->view('include/header_view')?>
  <section id="page">
    <!-- SIDEBAR -->
     <?php $this->load->view('include/sidebar_view')?>
    <!-- /SIDEBAR -->
    <div id="main-content">
      <div class="container">
        <div class="row">
          <div id="content" class="col-lg-12">
            <div class="row">
              <div class="col-sm-12">
                <div class="page-header">
                  <ul class="breadcrumb">
                    <li>
                      <i class="fa fa-home"></i>
                      <a href="#">Home</a>
                    </li>
                    <li>Dashboard</li>
                  </ul>
                  <div class="clearfix">
                    <h3 class="content-title pull-left">Dashboard</h3>
                  </div>
                  <div class="description">Overview, Statistics and more</div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <a href="<?= BASEURL ?>user">
                  <div class="col-lg-6">
                    <div class="dashbox panel panel-default">
                      <div class="panel-body">
                        <div class="panel-left blue">
                          <i class="fa fa-user fa-3x"></i>
                        </div>
                        <div class="panel-right">
                          <div class="number"><?php echo $total_users;?></div>
                          <div class="title">Total users</div>                          
                        </div>
                      </div>
                    </div>
                  </div>
                  </a>
                  
                  <!-- <a href="<?= BASEURL ?>out_management">
                  <div class="col-lg-6">
                    <div class="dashbox panel panel-default">
                      <div class="panel-body">
                        <div class="panel-left blue">
                          <i class="fa fa-coffee fa-3x"></i>
                        </div>
                        <div class="panel-right">
                          <div class="number"><?php echo $total_outlets;?></div>
                          <div class="title">Total Outlets</div> 
                        </div>
                      </div>
                    </div>
                  </div>
                  </a> -->
                  
                </div>
              </div>
            </div>
             
             <?php $this->load->view('include/footer_view')?>
          </div>
        </div>
      </div>
    </div>  
  </section>
  <?= $headerData['javascript_dash']; ?> 
  <script>
   jQuery(document).ready(function() 
    { 
      App.setPage("index");  //Set current page
      App.init(); //Initialise plugins and elements
    });
  jQuery('.panel-body').hover(function () 
  {
    $(this).children("div").addClass('red').removeClass('blue');
  }, function ()
  {
    $(this).children("div").addClass('blue').removeClass('red');
  });
  </script>
</body>
</html>  
