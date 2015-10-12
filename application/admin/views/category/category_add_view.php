<?php
$headerData = $this->headerlib->data();
if (isset($getData) && $getData != '')
    extract($getData);
//mprd($options_org);
$form_attr = array(
    'name' => 'category-form',
    "id" => "validateForm",
    'method' => 'post',
    'class' => "form-horizontal",
    'role' => 'form'
);
$title = array(
    'name' => 'vTitle',
    'id' => 'vTitle',
    'placeholder' => 'Please provide title',
    'value' => (isset($vTitle) && $vTitle != '') ? $vTitle : '',
    'type' => 'text',
    'class' => 'form-control maxwidth500 necessary'
);


$image = array(
    'name' => 'vImage',
    'id' => 'vImage',
    'placeholder' => 'Please provide Image',
    'type' => 'file',
    'accept' => 'image/*',
    'class' => 'fileuploadcontrol maxwidth500 necessary'
);

$image2 = array(
    'name' => 'vImage2',
    'id' => 'vImage2',
    'placeholder' => 'Please provide Image',
    'type' => 'file',
    'accept' => 'image/*',
    'class' => 'fileuploadcontrol maxwidth500 necessary'
);

$hiddeneditattr = array(
    "action" => "backoffice.edit"
);
$hiddenaddattr = array(
    "action" => "backoffice.add"
);
$_id = array(
    "iCategoryID" => (isset($iCategoryID) && $iCategoryID != '') ? $iCategoryID : ''
);
$submit_attr = array(
    'class' => 'submit btn btn-primary marginright20',
    'value' => "$ACTION_LABEL Category" ,
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
        <title>Category Exequtives</title>
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
                                            if (isset($iCategoryID) && $iCategoryID != '') {
                                                echo form_hidden($_id);
                                                echo form_hidden($hiddeneditattr);
                                            } else {
                                                echo form_hidden($hiddenaddattr);
                                            }
                                            ?>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Title </label>
                                                <div class="col-sm-9">
                                                    <?php echo form_input($title); ?>
                                                </div>
                                            </div>
                                            <!--for main image-->
                                            <?php if (isset($vImage) && $vImage != ""): ?>
                                                <div class="form-group ">
                                                    <label class="control-label col-sm-3" for="normal-field">Upload Image<span class="required">*</span></label>
                                                    <div class="controls col-sm-7">
                                                        <div class="input-append row-fluid">
                                                            
                                                            <img src="<?php echo CAT_IMAGE_URL.$iCategoryID.'/'.$vImage ;?>" id="profilepic" style="margin-right:20px" alt="<?php echo $vImage; ?>">
                                                            <input type="file" style="margin-bottom: 10px;"  class="spa1n6 fileinput" name="vImage" id="imagebootun" accept="image/*" />
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="form-group ">
                                                    <label class="control-label col-sm-3" for="normal-field">Upload Image<span class="required">*</span></label>
                                                    <div class="controls col-md-7">
                                                        <div class="input-append row-fluid">
                                                            <input type="file" style="margin-bottom: 10px;" class="spa1n6 fileinput" name="vImage"   accept="image/*" />
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif ?> 
                                            
                                            <!--for hover image-->
                                            <?php if (isset($vImage2) && $vImage2 != ""): ?>
                                                <div class="form-group ">
                                                    <label class="control-label col-sm-3" for="normal-field">Upload Image Hover<span class="required">*</span></label>
                                                    <div class="controls col-sm-7">
                                                        <div class="input-append row-fluid">
                                                            
                                                            <img src="<?php echo CAT_IMAGE_URL.$iCategoryID.'/'.$vImage ;?>" id="profilepic" style="margin-right:20px" alt="<?php echo $vImage; ?>">
                                                            <input type="file" style="margin-bottom: 10px;"  class="spa1n6 fileinput" name="vImage2" id="imagebootun" accept="image/*" />
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="form-group ">
                                                    <label class="control-label col-sm-3" for="normal-field">Upload Image Hover<span class="required">*</span></label>
                                                    <div class="controls col-md-7">
                                                        <div class="input-append row-fluid">
                                                            <input type="file" style="margin-bottom: 10px;" class="spa1n6 fileinput" name="vImage2"   accept="image/*" />
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif ?> 
                                            <!--end of image portion-->
                                            
                                            
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
                
                $("#validateForm").validate({
                    rules: {
                        vImage: {
                            required: function() {
                                return !<?php echo $ACTION_LABEL == "Edit"?>;
                              }
                            ,accept: "image/*"
                        }
                        
                    },
                    messages: {
                        vImage: "Select a valid image with .png or .jpeg extension."
                    }
                });
                jQuery.validator.addClassRules("necessary",
                        {
                            required: true,
                        });

                $('#vImage').preimage({
                    width: '150'
                });


            });
        </script>
    </body>
</html>  
