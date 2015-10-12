<?php
extract(get_class_vars($this->router->class));
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
                                                        <th>Title</th>                                                        
                                                        <th>Parent</th>                     
                                                        <th>Created Date</th>                                                        
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Title</th>                                                        
                                                        <th>Parent</th>                     
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
                    primary_key = '<?php echo $primary_key; ?>';
                    
            $(document).ready(function ()
            {
            
                App.setPage("dynamic_table");  //Set current page
                App.init(); //Initialise plugins and elements
                // var target=get_edit_defination (2,'admin');
                var target = [
                    {
                        "aTargets": [3], // Column to target
                        "mRender": function (data, type, full)
                        {
                            var buttons = '';
                            buttons += '<a title="Edit" href="<?= BASEURL ?>'+'index.php/' + controller + '/add/' + data + '"  class="btn btn-primary marginright10 "><i class="fa fa-pencil-square-o"></i> Edit </a></br></br>';
                            if (full['iStatus'] == "1") {
                                buttons += '<a data-id ="'+ data+'" title="Click here to inactive" linktosend="index.php/'+controller+'/status" id="atag' + full[primary_key] + '" href="javascript:void(0)"  class="btn btn-success marginright10 toactive"><i class="fa fa-check-circle-o"></i> Active </a>'
                            } else {
                                buttons += '<a data-id ="'+ data+'" title="Click here to Active" id="atag' + full[primary_key] + '" href="javascript:void(0)"  class="btn btn-inverse toactive"><i class="fa fa-times-circle-o "></i> Inactive </a>'
                            }
                            return buttons;
                        } 
                    },

                ];

                var aoculumn = [
                    /*0*/ {"mData": "vTitle"},
                    /*1*/ {"mData": "parent_id"},
                    /*2*/ {"mData": "dtCreated"},
                    /*3*/ {"mData": primary_key, bSortable: false, bSearchable: false}
                ];
                getdatatable(controller + '/deleteAll', controller + '/paginate', aoculumn, target);
            });

            $(document).on('click','.toactive', function(){
               changeStatus($(this).attr('data-id'),$(this).attr('linktosend'))
            });
        </script>
    </body>
