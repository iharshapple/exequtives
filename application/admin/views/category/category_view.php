<?php
extract(get_class_vars('category'));
$headerData = $this->headerlib->data();
?>
<!doctype html>
<html lang="en-us">
    <head>
        <title><?php echo $title; ?></title>
        <?= $headerData['meta_tags']; ?>
        <?= $headerData['stylesheets']; ?>
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
                            <div id="divtoappend" class="row">
                                <br>
                            </div>
                            <?= $this->general_model->getMessages() ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box border primary">
                                        <div class="box-title">
                                            <h4><i class="fa fa-table"></i><?php echo $list_title;?></h4>
                                            <div class="tools ">
                                                
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <table id="datatable" cellpadding="0" cellspacing="0" border="0" class="datatable table  table-bordered ">
                                                <thead>
                                                    <tr> 
                                                        <th>Category ID </th> 
                                                        <th>Title</th>                                                        
                                                        <th>Image</th>                     
                                                        <th>Image on Hover</th>                     
                                                        <th>Created Date</th>                                                        
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Category ID </th> 
                                                        <th>Title</th>                                                        
                                                        <th>Image</th> 
                                                        <th>Image on Hover</th>
                                                        <th>Created Date</th>                                                        
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $this->load->view('include/footer_view') ?>
                        </div>
                    </div>
                </div>
            </div>  
        </section>
        <?= $headerData['javascript_view']; ?> 
        <script>

            var oTable,
                    controller = '<?php echo $this->router->class;?>',
                    primary_key = '<?php echo $primary_key; ?>',
                    imagepath = '<?php echo CAT_IMAGE_PATH ?>',
                    imageurl = '<?php echo CAT_IMAGE_URL ?>',
                    no_img_url = '<?php echo DOMAIN_URL; ?>/admin/img/no-image.png';
            $(document).ready(function ()
            {
            
                App.setPage("dynamic_table");  //Set current page
                App.init(); //Initialise plugins and elements
                // var target=get_edit_defination (2,'admin');
                var target = [
                    {
                        "aTargets": [5], // Column to target
                        "mRender": function (data, type, full)
                        {
                            var buttons = '';
                            buttons += '<a title="Edit" href="<?= BASEURL ?>'+'index.php/' + controller + '/add/' + data + '"  class="btn btn-primary marginright10 "><i class="fa fa-pencil-square-o"></i> Edit </a></br></br>';
                            
                           // buttons += '<a title="DELETE" id="" href="javascript:void(0)"  class="btn btn-danger marginright10 todelete"><i class="fa fa-times"></i> DELETE </a></br></br>';
                            // var buttons = '<button title="Delete" class="btn btn-danger marginright10"  onclick="return validateRemove(' + data + ',' + "'/index.php/" + controller + "/deleteAll'" + ');"><i class="fa fa-times"></i> Delete</button>';
                            if (full['iStatus'] == "1") {
                                // buttons +='<a title="Click here to inactive" linktosend="user/status" id="atag'+full['iUserID']+'" href="'+controller + "/status/"+ full["iUserID"]+'"  class="btn btn-success marginright10 "><i class="fa fa-check-circle-o"></i> Active </a>'
                                buttons += '<a data-id ="'+ data+'" title="Click here to inactive" linktosend="index.php/'+controller+'/status" id="atag' + full[primary_key] + '" href="javascript:void(0)"  class="btn btn-success marginright10 toactive"><i class="fa fa-check-circle-o"></i> Active </a>'
                            } else {
                                // buttons +='<a title="Click here to Active" id="atag'+full['iUserID']+'" href="'+controller + "/status/"+ full["iUserID"]+'"  class="btn btn-inverse"><i class="fa fa-times-circle-o "></i> Inactive </a>'
                                buttons += '<a data-id ="'+ data+'" title="Click here to Active" id="atag' + full[primary_key] + '" href="javascript:void(0)"  class="btn btn-inverse toactive"><i class="fa fa-times-circle-o "></i> Inactive </a>'
                            }
                            return buttons;
                        } 
                    },
                    {
                        "aTargets": [2], // Column to target
                        "mRender": function (data, type, full)
                        {
                            if (full['vImage'] != '') {
                                return '<a style="display: table;    margin: 0 auto !important;"  class="fancybox" rel="group" href="'+imageurl + full["iCategoryID"]+'/'+ full['vImage'] + '"><img class="thumbnail img-responsive" src="'+imageurl + full[primary_key]+'/'+ full['vImage'] + '"  height="70" width="90" /></a>';
                            } else {
                                return '<img style="display: table;    margin: 0 auto !important;"  class="thumbnail img-responsive" src="' + no_img_url + '"  height="70" width="90" />';
                            }

                        }
                    },
                    {
                        "aTargets": [3], // Column to target
                        "mRender": function (data, type, full)
                        {
                            if (full['vImage2'] != '') {
                                return '<a style="display: table;    margin: 0 auto !important;"  class="fancybox" rel="group" href="'+imageurl + full["iCategoryID"]+'/'+ full['vImage2'] + '"><img class="thumbnail img-responsive" src="'+imageurl + full[primary_key]+'/'+ full['vImage2'] + '"  height="70" width="90" /></a>';
                            } else {
                                return '<img style="display: table;    margin: 0 auto !important;"  class="thumbnail img-responsive" src="' + no_img_url + '"  height="70" width="90" />';
                            }

                        }
                    }

                ];

                var aoculumn = [
                    /*0*/ {"mData": primary_key},
                    /*1*/ {"mData": "vTitle"},
                    /*2*/ {"mData": "vImage", bSortable: false, bSearchable: false},
                    /*3*/ {"mData": "vImage2", bSortable: false, bSearchable: false},
                    /*4*/ {"mData": "dtCreated"},
                    /*5*/ {"mData": primary_key, bSortable: false, bSearchable: false}
                ];
                getdatatable(controller + '/deleteAll', controller + '/paginate', aoculumn, target);
            });

            $(document).on('click','.toactive', function(){
               changeStatus($(this).attr('data-id'),$(this).attr('linktosend'))
            });
        </script>
    </body>
