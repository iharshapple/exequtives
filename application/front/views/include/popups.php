<?php
$login_form_attr = array(
    'name' => 'login-form',
    "id" => "login-form",
    'method' => 'post',
    'class' => "form-horizontal",
    'role'=>'form'
);

$signup_form_attr = array(
    'name' => 'signup-form',
    "id" => "signup-form",
    'method' => 'post',
    'class' => "form-horizontal",
    'role'=>'form'
);
?> 

<!--    login modal-->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="padding2per">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">

                        <div class="row">

                            <div class="col-md-6" >
                                <a href="#"><img src="<?= DOMAIN_URL ?>bootstrap/img/fb.png" /></a><br/>

                                <a href="#"><img src="<?= DOMAIN_URL ?>bootstrap/img/gplus.png" /></a>
                            </div>

                            <div class="col-md-5" style="border-left:1px solid #ccc;height:160px">
                                <?php echo form_open_multipart($this->router->class . "/login", $login_form_attr); ?>
                                <fieldset>

                                    <input id="vEmail" name="vEmail" type="text" placeholder="Enter Email" class="form-control input-md">
                                    <input id="vPassword" name="vPassword" type="password" placeholder="Enter Password" class="form-control input-md">
                                   
                                    <a href="#" class="forgot-link"><small> Forgot Password?</small></a>
                                    <div class="spacing">

                                    </div>
                                    <button type="submit" id="singlebutton" name="singlebutton" class="btn btn-blue-theme btn-download-app btn-sm pull-right">Sign In</button>


                                </fieldset>
                                <?php echo form_close(); ?>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  

<!--modal end-->


<!--    Register modal-->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="padding2per">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 well well-sm">
                        <legend><a href=""></a> Sign up!</legend>
                        <?php echo form_open_multipart($this->router->class . "/signup", $signup_form_attr); ?>
                            <div class="row">
                                <div class="col-xs-6 col-md-6">
                                    <input class="form-control required" name="vFirstname" placeholder="First Name" type="text"
                                           required autofocus />
                                </div>
                                <div class="col-xs-6 col-md-6">
                                    <input class="form-control required" name="vLastname" placeholder="Last Name" type="text" required />
                                </div>
                            </div>
                            <input class="form-control required" name="vEmail" placeholder="Your Email" type="email" />

                            <input class="form-control required" name="vPassword" placeholder="New Password" type="password" />

                            <div class="radio radio-info radio-inline">
                                <input type="radio" name="eGender" id="eGender" value="M" checked="checked"/>
                                <label for="eGender"> Male </label>
                            </div>
                            <div class="radio radio-info radio-inline">
                                <input type="radio" name="eGender" id="eGender" value="F" />
                                <label for="eGender"> Female </label>
                            </div>
                            <br />
                            <br />
                            <div class="text-center">
                                <button class="btn btn-blue-theme btn-download-app" type="submit">
                                    Sign up</button>  
                            </div>

                         <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  

<!--modal end-->
<script>
    $("#signup-form").validate({
        rules: {
            vEmail: {
                 email: true
            },
            vPassword: {
                minlength: 5
            },
            eGender: {
                required: true
            }
        }
    });
    
    $("#login-form").validate({
        rules: {
            vEmail: {
                 email: true,
                 required: true
            },
            vPassword: {
                minlength: 5,
                required: true
            }
        }
    });
    jQuery.validator.addClassRules("necessary",
            {
                required: true,
            });
</script>
