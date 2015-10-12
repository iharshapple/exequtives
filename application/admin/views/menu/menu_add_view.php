<?php
extract(get_class_vars($this->router->class));

$headerData = $this->headerlib->data();
if (isset($getData) && $getData != '')
    extract($getData);
//mprd($options_org);
$form_attr = array(
    'name' => 'menu-form',
    "id" => "validateForm",
    'method' => 'post',
    'class' => "form-horizontal",
    'role' => 'form'
);
$menutitle = array(
    'name' => 'vTitle',
    'id' => 'vTitle',
    'placeholder' => 'Please provide title',
    'value' => (isset($vTitle) && $vTitle != '') ? $vTitle : '',
    'type' => 'text',
    'class' => 'form-control maxwidth500 necessary'
);
$parentid = array(
    'name' => 'parent_id',
    'id' => 'parent_id',
    "required" => "required",
    'class' => 'form-control maxwidth500 necessary'
);
$selected = (isset($parent_id) && $parent_id!='')?$parent_id:'0';

$hiddeneditattr = array(
    "action" => "backoffice.edit"
);
$hiddenaddattr = array(
    "action" => "backoffice.add"
);
$_id = array(
    "iMenuID" => (isset($iMenuID) && $iMenuID != '') ? $iMenuID : ''
);
$submit_attr = array(
    'class' => 'submit btn btn-primary marginright20',
    'value' => "$ACTION_LABEL ".$uppercase,
    'type' => 'submit'
);
$cancel_attr = array(
    'class' => 'btn btn-inverse ',
    'value' => "Clear",
    'type' => 'reset'
);

?>
<!doctype html>
<html lang="en-us">
    <head>
        
        <title> <?= $title; ?></title>
        <?= $headerData['meta_tags']; ?>
        <?= $headerData['stylesheets_form']; ?>


    </head>
    <body>
        <?php $this->load->view('include/header_view') ?>
        <section id="page">
            <!-- SIDEBAR -->
            <?php $this->load->view('include/sidebar_view') ?>
            <!-- /SIDEBAR -->
            <div id="main-content">
                <div class="container">
                    <div class="row">
                        <div id="content" class="col-lg-12">
                            <div class="row">
                                <br>
                            </div>
                            <?= $this->general_model->getMessages() ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- BOX -->
                                    <div class="box border primary">
                                        <div class="box-title">
                                            <h4><i class="fa fa-bars"></i><?php echo $ACTION_LABEL ?></h4>
                                            <div class="tools hidden-xs">

                                            </div>
                                        </div>
                                        <div class="box-body big">
                                            <?php
                                            echo form_open_multipart($this->router->class."/add", $form_attr);
                                            if (isset($iMenuID) && $iMenuID != '') {
                                                echo form_hidden($_id);
                                                echo form_hidden($hiddeneditattr);
                                            } else {
                                                echo form_hidden($hiddenaddattr);
                                            }
                                            ?>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Title </label>
                                                <div class="col-sm-9">
                                                    <?php echo form_input($menutitle); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Parent Menu</label>
                                                <div class="col-sm-9">
                                                    <?php $extra= ' class="form-control maxwidth500 necessary"'; ?>
                                                    <?php echo form_dropdown('parent_id', $options_menu, $selected,$extra); ?>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="margin0auto disptable">
                                                    <?php echo form_input($submit_attr); ?>
                                                    <?php echo form_input($cancel_attr); ?>
                                                </div>
                                            </div>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                    <!-- /BOX -->
                                </div>
                            </div>
                            <?php $this->load->view('include/footer_view') ?>
                        </div>
                    </div>
                </div>
            </div>  
        </section>
        <?= $headerData['javascript_form']; ?> 
        <script>
            jQuery(document).ready(function ()
            {
                App.setPage("forms");  //Set current page
                App.init(); //Initialise plugins and elements
                jQuery.validator.addClassRules("necessary",
                        {
                            required: true,
                        }); 
            });
        </script>
    </body>
</html>  
