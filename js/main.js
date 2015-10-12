//var base_url = 'openxcelluk.info';
$(document).ready(function() 
{	
  	$("#passchange").click(function(event) 
  	{
  	    $( ".passtohide" ).toggle('clip' , 500 );
  	});

  	$("#alert").mouseover(function(event) 
  	{
  	   $(this).effect( 'fade', 1000 );
  	});

  	$("#datatable tbody").click(function(event) 
    {
        if ($(event.target.parentNode).hasClass('row_selected')) 
        {
          $(event.target.parentNode).removeClass('row_selected');  
        }
        else
        {
          $(event.target.parentNode).addClass('row_selected');
        }
    });

    $(".reload").click(function(event) 
    {
     oTable.fnDraw(false); 
    });
});

function  validateRemove(id,adrs) 
{
    $confirm= confirm("Are you sure you want to delete this?");
    if($confirm==true)
    {
      var keys =[];
      keys.push(id);
      var form_data = { rows:keys }
        $.ajax({
            url: BASEURL+adrs,
            type: 'POST',
            data:  form_data,
            success: function(output_string){
              if (output_string=='1') 
              {
                $("#"+id).remove();
              }
              else
              {
                $("#divtoappend").append('<div id="alert"><div class="alert alert-danger center">Please try after some time</div></div>');
              }
            }
        });
    } 
    else
    {
       return false;
    }
}

function  deleteerows(adrs) 
{
    $confirm= confirm("Are you sure you want to delete this?");
    if($confirm==true)
    {
      var keys =[];
      var anSelected = fnGetSelected( oTable );
      $.each(anSelected, function(index, val) 
        {
          keys.push($(val).attr('id'));
        }); 
        var form_data = 
        {
                rows:keys
        }
        $.ajax(
        {
          url: BASEURL+adrs,
          type: 'POST',
          data:  form_data,
          success: function(output_string)
          {
            if (output_string=='1') 
            {
              $(anSelected).remove();
            }
            else
            {
              $("#divtoappend").append('<div class="alert alert-block alert-danger fade in col-sm-12 borderradius0">Please try after some time<a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a></div>');
                     
            }
          }
        });
    }
    else
      return false;
}
function fnGetSelected( oTableLocal )
{
    return oTableLocal.$('tr.row_selected');
} 
function getdatatable (deleteadr,paginate,aoculumn,aoColumnDefs) 
{	
	  oTable= $('#datatable').dataTable( 
    {
        "sPaginationType": "bs_full",
        "bJQueryUI": true,
        sDom: "<'row'<'dataTables_header  clearfix'<'col-md-4'lC><'col-md-8'TRf>r>>t<'row'<'dataTables_footer clearfix'<'col-md-6'i><'col-md-6'p>>> ",
        "bStateSave": true,
        oTableTools: 
        {
            "sRowSelect": "multi",
            "aButtons": 
            [
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
                      },
                      {
                        "sExtends":    "text",
                        "sButtonText": "Delete",
                        "fnClick": function ( nButton, oConfig, oFlash ) 
                        {
                           deleteerows(deleteadr);
                        }
                      },
                      "select_all", "select_none"] ,
  	
            sSwfPath: BASEURL+"js/datatables/extras/TableTools/media/swf/copy_csv_xls_pdf.swf"
        },
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": BASEURL+paginate,
        "sServerMethod": "POST",
        "aoColumns": aoculumn,
        "aoColumnDefs": aoColumnDefs,
        
        "oLanguage": 
        {
          "sSearch": "Search:"
        },
        "bSortCellsTop": true
    } );
}
	
function  changeStatus(id,adrs) 
{
    if(confirm("Are you sure you want to change the status?"))
    {
      var keys =[];            
      keys.push(id);            
      var form_data = { rows:keys }
      $.ajax({
          url: BASEURL+adrs,
          type: 'POST',
          data:  form_data,
          success: function(output_string){
            if (output_string=='1') 
            { 
              if($("#atag"+id).hasClass('btn-success'))
              {                             
                  $("#atag"+id).html('<i class="fa fa-times-circle-o "></i> Inactive');
                  $("#atag"+id).switchClass('btn-success','btn-inverse');
              }else if($("#atag"+id).hasClass('btn-inverse')){
                  $("#atag"+id).html('<i class="fa fa-check-circle-o "></i> Active');
                  $("#atag"+id).switchClass('btn-inverse','btn-success');
              }
            }
            else
            {
              $("#divtoappend").append('<div id="alert"><div class="alert alert-danger center">Please try after some time</div></div>');
            }
          }
      });
    } 
    else
    {
       return false;
    }
}