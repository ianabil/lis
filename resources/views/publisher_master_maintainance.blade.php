@extends('layouts.app') @section('content')
<!-- Main content -->
<div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Add New Publisher's Details</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">                
                <div class="col-md-4 form-group required">
                    <label class="control-label">Publisher's Name</label>
                    <input type="text" class="form-control" name="publisher_name" id="publisher_name">
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Publisher's Address</label>
                        <textarea class="form-control" name="publisher_address" id="publisher_address"></textarea>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button type="button" class="form-control btn-success btn btn-primary " id="add">Add New Publisher
                    </div>
                </div>
                <!-- /.col -->  
    
            </div>
            <!-- /.row -->
        </div>
</div>

<div class="box box-default" id="show_all_data">
    <div class="box-header with-border">
        <h3 class="box-title">All Publishers' Details</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
            <table class="table table-striped table-bordered" id="show_publisher_data">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>PUBLISHER NAME</th>
                            <th>PUBLISHER ADDRESS</th>
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
                        
            //Datatable Code For Showing Data :: START
            var table = $("#show_publisher_data").dataTable({  
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "show_all_publisher",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: $('meta[name="csrf-token"]').attr('content')}
                   },
            "columns": [                
                {"class": "id",
                "data": "PUBCODE" },
                {"class": "name data",   
                 "data": "PUBNAME" },
                {"class": "address data",   
                 "data": "PUBADD" },
                {"class": "delete", 
                 "data": "action" }
            ]
        }); 
        // DataTable initialization with Server-Processing ::END

        // Double Click To Enable Content editable
        $(document).on("click",".data", function(){
            $(this).attr('contenteditable',true);
        })

        // New Publisher Addition Code :: STARTS

        $(document).on("click","#add", function(){
           var pub_name = $("#publisher_name").val().toUpperCase();
           var pub_add = $("#publisher_address").val().toUpperCase();

           $.ajax({
               type:"POST",
               url:"publisher_master_maintainance/store",
               data:{
                    _token: $('meta[name="csrf-token"]').attr('content'), 
                    publisher_name:pub_name,
                    publisher_address:pub_add
               },
               success:function(response){                   
                swal("New Publisher Details Inserted","","success");                
                table.api().ajax.reload();
                $("#publisher_name").val('');
                $("#publisher_address").val('');
               },
               error:function(response) {                   
                if(response.responseJSON.errors.hasOwnProperty('publisher_name'))
                    swal("Cannot create new Publisher", ""+response.responseJSON.errors.publisher_name['0'], "error");
                if(response.responseJSON.errors.hasOwnProperty('publisher_address'))
                    swal("Cannot create new Publisher", ""+response.responseJSON.errors.publisher_address['0'], "error");
                
               }
           })
        })

        // New Publisher Addition Code :: ENDS

        // To prevent updation when no changes to the data is made
        var prev_data_pubname;
        var prev_data_pubadd;
        $(document).on("focusin",".data", function(){
            prev_data_pubname = $(this).closest("tr").find(".name").text();
            prev_data_pubadd = $(this).closest("tr").find(".address").text();
        })
        

        /* Data Updation Code Starts*/
        $(document).on("focusout",".data", function(){
            var id = $(this).closest("tr").find(".id").text();
            var pub_name = $(this).closest("tr").find(".name").text();
            var pub_address = $(this).closest("tr").find(".address").text();
            
            if(pub_name == prev_data_pubname && pub_address == prev_data_pubadd)
                return false;

            $.ajax({
                type:"POST",
                url:"publisher_master_maintainance/update",                
                data:{_token: $('meta[name="csrf-token"]').attr('content'), 
                        id:id, 
                        publisher_name:pub_name,
                        publisher_address:pub_address
                    },
                success:function(response){                    
                    swal("Publisher's Details Updated","","success");
                    table.api().ajax.reload();
                },
                error:function(response) {                   
                if(response.responseJSON.errors.hasOwnProperty('publisher_name'))
                    swal("Cannot create new Publisher", ""+response.responseJSON.errors.publisher_name['0'], "error");
                if(response.responseJSON.errors.hasOwnProperty('publisher_address'))
                    swal("Cannot create new Publisher", ""+response.responseJSON.errors.publisher_address['0'], "error");
                table.api().ajax.reload();
               }
            })
        })

        // /* Data Updation Cods Ends */

        
        /* Data Deletion Cods Starts */

        $(document).on("click",".delete", function(){
            var id = $(this).closest("tr").find(".id").text();
            var tr = $(this).closest("tr");

            $.ajax({
                type:"POST",
                url:"publisher_master_maintainance/delete",
                data:{
                    _token: $('meta[name="csrf-token"]').attr('content'), 
                    id:id
                },
                success:function(response){
                    if(response==1){
                        swal("Data Deleted Successfully","","success");  
                        table.api().ajax.reload();                
                    }
                    else{
                        swal("Can Not Delete This Data","Book with this publisher already exists","error");  
                        return false;
                    }

                }
            })
        })

        /* Data Deletion Cods Ends */

    });
        
    </script> 

    </body>

    </html>