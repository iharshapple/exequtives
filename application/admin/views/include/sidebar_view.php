<?php $segment = $this->uri->segment(1); ?>
<!-- SIDEBAR -->
<div id="sidebar" class="sidebar">
    <div class="sidebar-menu nav-collapse">
        <ul>
            <li class="<?= ($segment == 'dashboard') ? 'active' : '' ?>">
                <a href="<?= BASEURL ?>">
                    <i class="fa fa-tachometer fa-fw"></i> <span class="menu-text">Dashboard</span>
                    <span class="selected"></span>
                </a>          
            </li>
            <li class="has-sub <?= ($segment == 'admin') ? 'active' : '' ?>">
                <a href="javascript:;" class="">
                    <i class="fa fa-users fa-fw"></i> <span class="menu-text">Admin Management</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub">
                    <li><?php echo anchor('admin', '<span class="sub-menu-text">View</span>'); ?></li>
                    <li><?php echo anchor('admin/add', '<span class="sub-menu-text">Add</span>'); ?></li>
                </ul>
            </li>
            
            <li class="<?= ($segment == 'user') ? 'active' : '' ?>">
                <a href="<?= BASEURL ?>user">
                    <i class="fa fa-user fa-fw"></i> <span class="menu-text">User Management</span>
                    <span class="selected"></span>
                </a> 
            </li>
            <li class="has-sub <?= ($segment == 'category') ? 'active' : '' ?>">
                <a href="javascript:;" class="">
                    <i class="fa fa-book fa-fw"></i> <span class="menu-text">Category Management</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub">
                    <li><?php echo anchor('category', '<span class="sub-menu-text">View</span>'); ?></li>
                    <li><?php echo anchor('category/add', '<span class="sub-menu-text">Add</span>'); ?></li>
                </ul>
            </li>
            <li class="has-sub <?= ($segment == 'subcategory') ? 'active' : '' ?>">
                <a href="javascript:;" class="">
                    <i class="fa fa-book fa-fw"></i> <span class="menu-text">Sub Category Management</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub">
                    <li><?php echo anchor('subcategory', '<span class="sub-menu-text">View</span>'); ?></li>
                    <li><?php echo anchor('subcategory/add', '<span class="sub-menu-text">Add</span>'); ?></li>
                </ul>
            </li>
            <li class="has-sub <?= ($segment == 'menu') ? 'active' : '' ?>">
                <a href="javascript:;" class="">
                    <i class="fa fa-book fa-fw"></i> <span class="menu-text">Menu Management</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub">
                    <li><?php echo anchor('menu', '<span class="sub-menu-text">View</span>'); ?></li>
                    <li><?php echo anchor('menu/add', '<span class="sub-menu-text">Add</span>'); ?></li>
                </ul>
            </li>
            
            <li class="has-sub <?= ($segment == 'adplan') ? 'active' : '' ?>">
                <a href="javascript:;" class="">
                    <i class="fa fa-book fa-fw"></i> <span class="menu-text">Ad plan Management</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub">
                    <li><?php echo anchor('adplan', '<span class="sub-menu-text">View</span>'); ?></li>
                    <li><?php echo anchor('adplan/add', '<span class="sub-menu-text">Add</span>'); ?></li>
                </ul>
            </li>
            <li class="has-sub <?= ($segment == 'page') ? 'active' : '' ?>">
                <a href="javascript:;" class="">
                    <i class="fa fa-pencil-square-o fa-fw"></i> <span class="menu-text">Content Management</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub">
                    <li><?php echo anchor('pagecontent', '<span class="sub-menu-text">View</span>'); ?></li>
                </ul>
            </li>
            

       </ul>
    </div>
</div>