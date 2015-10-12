<?php

  $headerData = $this->headerlib->data();
  
?>

<!doctype html>

<html lang="en-us">

<head>

    <title><?=$title?></title>

    <?= $headerData['meta_tags']; ?>
    <?= $headerData['stylesheets']; ?>
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
            <div id="divtoappend" class="row">
              <div class="col-sm-12">
                <div class="page-header">
                  <ul class="breadcrumb">
                    <li>
                      <i class="fa fa-home"></i>
                      <a href="<?= BASEURL ?>">Home</a>
                    </li>
                    <li>Admin</li>
                  </ul>
                  <div class="clearfix">
                    <h3 class="content-title pull-left">Content Management</h3>
                  </div>
                  <div class="description">Overview, Statistics and more</div>
                </div>
              </div>
            </div>
            <?=$this->general_model->getMessages()?>
            <div class="row">
              <div class="col-md-12">
                <div class="box border purple">
                  <div class="box-title">
                    <h4><i class="fa fa-table"></i>Copy, Print, CSV, Excel, PDF</h4>
                    <div class="tools hidden-xs">
                      <a href="#box-config" data-toggle="modal" class="config">
                        <i class="fa fa-cog"></i>
                      </a>
                      <a href="javascript:;" class="reload">
                        <i class="fa fa-refresh"></i>
                      </a>
                      <a href="javascript:;" class="collapse">
                        <i class="fa fa-chevron-up"></i>
                      </a>
                      <a href="javascript:;" class="remove">
                        <i class="fa fa-times"></i>
                      </a>
                    </div>
                  </div>
                  <div class="box-body">
                    <table id="datatable" cellpadding="0" cellspacing="0" border="0" class="datatable table  table-bordered ">
                      <thead>
                        <tr>
                          <th>Page Name</th>
                          <th  class="hidden-xs">Page Content</th>
                          <th  class="hidden-xs">Last Updated</th>
                          <th >Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th class="hidden-xs">Page Name</th>
                          <th  class="hidden-xs">Page Content</th>
                          <th   class="hidden-xs">Last Updated</th>
                          <th>Action</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <?php $this->load->view('include/footer_view')?>
          </div>
        </div>
      </div>
    </div>  
  </section>
  <?= $headerData['javascript_view']; ?> 

 <script>
    jQuery(document).ready(function() {   
      App.setPage("dynamic_table");  //Set current page
      App.init(); //Initialise plugins and elements
    });
  </script>
  <script>
$(document).ready(function() {

   var oTable= $('#datatable').dataTable( {
     "sPaginationType": "bs_full",
        "bJQueryUI": true,
       sDom: "<'row'<'dataTables_header  clearfix'<'col-md-4'lC><'col-md-8'TRf>r>>t<'row'<'dataTables_footer clearfix'<'col-md-6'i><'col-md-6'p>>> ",
        "bStateSave": true,
                oTableTools: {
                  "sRowSelect": "multi",
                    "aButtons": [
                
                      {
                        "sExtends": "copy",
                        "sButtonText": "copy",
                        "mColumns": "visible"
                      },
                      {
                        "sExtends": "print",
                        "sButtonText": "print",
                        "mColumns": "visible"
                      },
                      {
                        "sExtends": "csv",
                        "sButtonText": "csv",
                        "mColumns": "visible"
                      },
                      {
                        "sExtends": "xls",
                        "sButtonText": "xls",
                        "mColumns": "visible"
                      },
                      {
                        "sExtends": "pdf",
                        "sButtonText": "pdf",
                        "mColumns": "visible"
                      }

              



                      ] ,
                     sSwfPath: BASEURL+"js/datatables/extras/TableTools/media/swf/copy_csv_xls_pdf.swf"
                },
         "bProcessing": true,
         "bServerSide": true,
       
         "sAjaxSource": BASEURL+"index.php/pagecontent/paginate",
         "sServerMethod": "POST",
          "aoColumns": [
            { "mData": "vPageTitle" },
            { "mData": "tContent" },
            { "mData": "tModifiedAt" },
            { "mData": "iPageID" },
        ],

        "aoColumnDefs": [            
         {
           "aTargets": [ 3 ], // Column to target
         
           "mRender": function ( data, type, full ) 
           {
         return '<a  href="<?= BASEURL ?>pagecontent/add/'+data+'/y" class="btn btn-primary marginright10 "><i class="fa fa-pencil-square-o"></i>Edit</a>';
           }
         }],
             "oLanguage": {
          "sSearch": "Search:"
        },
        "bSortCellsTop": true
         //"fnServerData": fnDataTablesPipeline
    } );



});
</script>
</body>


