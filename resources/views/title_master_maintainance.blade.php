@extends('layouts.app') @section('content')
<!-- Main content -->
<div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Add New Title</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-6 form-group required">
                    <label class="control-label">Title</label>
                    <input type="text" class="form-control" name="description" id="description" placeholder="write down proper description">
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button type="button" class="form-control btn-success btn btn-primary " id="add">Add New Title
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        
                    </div>
                </div>
                
                <!-- /.col -->  
    
            </div>
            <!-- /.row -->
        </div>
</div>


<div class="box box-default" id="show_all_data">
    <div class="box-header with-border">
        <h3 class="box-title">All Titles' Details</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
            <table class="table table-striped table-bordered" id="show_title_data">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>                    
            </table>
    </div>
</div>


        
<hr>
         
<br> <br>


    </div>
    <!-- /.box-body -->
    @endsection

    <script src="{{asset('js/jquery/jquery.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $( ".date").datepicker(); // Date picker initialization
            
            // Datatable Code For Showing Data :: START
            var table = $("#show_title_data").dataTable({  
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "show_all_title",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: $('meta[name="csrf-token"]').attr('content')}
                   },
            "columns": [                
                {"class": "id",
                "data": "TIT_CODE" },
                {"class": "title data",   
                 "data": "TIT_DESC" },
                {"class": "delete", 
                 "data": "action" }
            ]
             
        }); 
        // DataTable initialization with Server-Processing ::END

        // Double Click To Enable Content editable
        $(document).on("click",".data", function(){
            $(this).attr('contenteditable',true);
        })

        // New Title Addition Code :: STARTS

        $(document).on("click","#add", function(){
           var title = $("#description").val().toUpperCase();

           $.ajax({
               type:"POST",
               url:"title_master_maintainance/store",
               data:{
                    _token: $('meta[name="csrf-token"]').attr('content'), 
                    title:title
               },
               success:function(response){
                    swal("New Title Inserted","","success");
                    table.api().ajax.reload();
                    $("#description").val('');
               },
               error:function(jqXHR, textStatus, errorThrown) { 
                   console.log(jqXHR)                  
                   swal("Cannot create new Book Title",jqXHR.responseJSON.errors.title['0'],"error");                  
               }
           })
        })

        // New Title Addition Code :: ENDS

        // To prevent updation when no changes to the data is made
        var prev_data;
        $(document).on("focusin",".data", function(){
            prev_data = $(this).closest("tr").find(".title").text();
        })

        /* Data Updation Code Starts*/
        $(document).on("focusout",".data", function(){
            var id = $(this).closest("tr").find(".id").text();
            var title = $(this).closest("tr").find(".title").text();
            
            if(prev_data == title)
                return false;

            $.ajax({
                type:"POST",
                url:"title_master_maintainance/update",                
                data:{_token: $('meta[name="csrf-token"]').attr('content'), 
                        id:id, 
                        title:title
                    },
                success:function(response){
                    swal("Title Updated","","success");
                    table.api().ajax.reload();
                },
                error:function(jqXHR, textStatus, errorThrown) {
                   swal("Cannot Update Title",jqXHR.responseJSON.errors.title['0'],"error");
                   table.api().ajax.reload();
               }
            })
        })

        /* Data Updation Cods Ends */

        
        /* Data Deletion Cods Starts */

        $(document).on("click",".delete", function(){
            var id = $(this).closest("tr").find(".id").text();
            var tr = $(this).closest("tr");

            $.ajax({
                type:"POST",
                url:"title_master_maintainance/delete",
                data:{
                    _token: $('meta[name="csrf-token"]').attr('content'), 
                    id:id
                },
                success:function(response){
                    if (response == 1) {
                        swal("Data Deleted Successfully","","success");  
                        table.api().ajax.reload();
                    }
                    else
                        swal("Can Not Delete Data","","error"); 
                },
                error:function(jqXHR, textStatus, errorThrown) {
                   swal("Server Error","","error");
               }
            })
        })

        /* Data Deletion Cods Ends */

    });
        
    </script>

    </body>

    </html>