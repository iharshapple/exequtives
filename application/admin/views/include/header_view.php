<!-- HEADER -->
  <header class="navbar clearfix" id="header">
    <div class="container">
        <div class="navbar-brand" style="padding-left: 60px;">
          <a href="<?= BASEURL ?>" style="text-decoration:blink; color:#FFF; font-size:25px; font-family:'Times New Roman', Times, serif;">
            <img src="<?=BASEURL.'img/logo/logo.png' ?>" style="display:none;"  alt="Petshare" class="" style="height: 30px; width: 30px;">
            EXEQUTIVES
          </a>
       
          <div class="visible-xs">
            <a href="#" class="team-status-toggle switcher btn dropdown-toggle">
              <i class="fa fa-users"></i>
            </a>
          </div>
          <div id="sidebar-collapse" class="sidebar-collapse btn">
            <i class="fa fa-bars" 
              data-icon1="fa fa-bars" 
              data-icon2="fa fa-bars" ></i>
          </div>
        </div>
		 
        <ul class="nav navbar-nav pull-right">
          <li class="dropdown user" id="header-user">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img alt="" style="max-width: 30px;" src="<?=BASEURL.'img/Avatar.png' ?>" />
              <span class="username"><?php echo $this->session->userdata('ADMINFIRSTNAME')." ".$this->session->userdata('ADMINLASTNAME'); ?></span>
              <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu">
              <li><?php echo anchor("admin/add/".$this->session->userdata('ADMINID')."/y","<i class='fa fa-user'></i> My Profile");?></li>
              <li><?php echo anchor("changepassword","<i class='fa fa-eye'></i> Change Password");?></li>
              <li><?php echo anchor("setting","<i class='fa fa-cog'></i> Settings");?></li>
              <li><?php echo anchor('logout','<i class=" fa fa-power-off"></i> Logout'); ?></li>
            </ul>
          </li>
        </ul>
    </div>
  </header>
  
  <!--/HEADER -->
