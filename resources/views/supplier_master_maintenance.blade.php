@extends('layouts.app') @section('content')
<!-- Main content -->
<div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Add New Supplier</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-6 form-group required">
                    <label class="control-label">Supplier's Name</label>
                    <input type="text" class="form-control" name="supplier" id="supplier" placeholder="write down supplier's name" onkeyup="this.value = this.value.toUpperCase();">
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button type="button" class="form-control btn-success btn btn-primary " id="add">Add New Supplier
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
        <h3 class="box-title">All Suppliers' Details</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table class="table table-striped table-bordered" id="show_supplier_data">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Suppliers' Name</th>
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
            var table = $("#show_supplier_data").dataTable({  
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "show_all_supplier",
                     "dataType": "json",
                     "type": "POST",
                     "data":{
                          _token: $('meta[name="csrf-token"]').attr('content')
                    }
            },
            "columns": [                
                {"class": "id",
                "data": "SUPPLIER_CODE" },
                {"class": "supplier data",   
                 "data": "SUPPLIER_NAME" },
                {"data": "action" }
            ]
             
        }); 
        // DataTable initialization with Server-Processing ::END

        // Double Click To Enable Content editable
        $(document).on("click",".data", function(){
            $(this).attr('contenteditable',true);
        })

        // New Supplier Addition Code :: STARTS

        $(document).on("click","#add", function(){
           var supplier = $("#supplier").val().toUpperCase();

           $.ajax({
               type:"POST",
               url:"supplier_master_maintenance/store",
               data:{
                    _token: $('meta[name="csrf-token"]').attr('content'), 
                    supplier:supplier
               },
               success:function(response){
                    swal("New Supplier Inserted","","success");
                    table.api().ajax.reload();
                    $("#supplier").val('');
               },
               error:function(jqXHR, textStatus, errorThrown) {                    
                   swal("Cannot create new Supplier",jqXHR.responseJSON.errors.supplier['0'],"error");                  
               }
           })
        })

        // New Supplier Addition Code :: ENDS

        // To prevent updation when no changes to the data is made
        var prev_data;
        $(document).on("focusin",".data", function(){
            prev_data = $(this).closest("tr").find(".supplier").text();
        })

        /* Data Updation Code Starts*/
        $(document).on("focusout",".data", function(){
            var id = $(this).closest("tr").find(".id").text();
            var supplier = $(this).closest("tr").find(".supplier").text();
            
            if(prev_data == supplier)
                return false;

            $.ajax({
                type:"POST",
                url:"supplier_master_maintenance/update",                
                data:{_token: $('meta[name="csrf-token"]').attr('content'), 
                        id:id, 
                        supplier:supplier
                    },
                success:function(response){
                    swal("Supplier Updated","","success");
                    table.api().ajax.reload();
                },
                error:function(jqXHR, textStatus, errorThrown) {
                   swal("Cannot Update Supplier",jqXHR.responseJSON.errors.supplier['0'],"error");
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
                url:"supplier_master_maintenance/delete",
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