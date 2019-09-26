@extends('layouts.app') @section('content')
<!-- Main content -->

<div class="box box-default">
        <div class="box-header with-border">
        <h3 class="box-title">Add New Location</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" id="add_new">
            <div class="row">
                <div class="col-md-3 form-group required">
                    <!-- use this class as the red * will be after control-label -->
                    <label class='control-label'>Location</label>
                    <input type="text" class="form-control" name="location_details" id="location_details" placeholder="Proper Location needed">
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Rack / Almirah No. (or Range)</label>
                        <input type="text" class="form-control" name="alm_rack" id="alm_rack" placeholder="Rack/Almirah No. or Range">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button type="button" class="form-control btn-success btn btn-primary " id="add_location" name="add_location">Add New Location
                    </div>
                </div>
                <!-- /.col -->  


                <div class="col-md-4">
                    <div class="form-group">
                        <label>&nbsp</label>
                        <h4><span id="report" style="color:red;"></span></h4>
                    </div>
                </div>
                <!-- /.col -->


            <!-- /.box-body add_new  -->    
            </div>

            <!-- /.box-body -->
        </div>
    
    <!-- /.Main content -->        
</div>



<div class="box box-default" id="show_all_data">

    <div class="box-header with-border">
        <h3 class="box-title">All Location Details</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>
    <!-- /.box-header -->

    <div class="box-body">
            <table class="table table-striped table-bordered responsive-sm" id="show_location_data">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Location</th>
                            <th>Rack / Almirah</th>                            
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
            $( ".date").datepicker({ dateFormat: 'dd-mm-yy', minDate:0 }); // Date picker initialization

            $(".select2").select2({
                width: '100%'
            }); // Select-2 initialization


            /*LOADER*/

            $(document).ajaxStart(function() {
                $("#wait").css("display", "block");
            });
            $(document).ajaxComplete(function() {
                $("#wait").css("display", "none");
            });
            /*LOADER*/


            //To activate click event in enter start
            $('#add_new').keypress(function(e) {
                var key = e.which;
                if (key == 13) // the enter key code
                {
                    $('#add_location').trigger('click');
                }
            });
            //To activate click event in enter end


        // Double Click To Enable Content editable
        $(document).on("click",".data", function(){
            $(this).attr('contenteditable',true);
        })



        /* new location insert Code Starts*/

        $(document).on("click","#add_location", function(){
                var location_details = $("#location_details").val().toUpperCase();
                var alm_rack = $("#alm_rack").val();

                $("#report").hide();

                $.ajax({
                    type: "POST",
                    url: "insert_new_location",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        location_details: location_details,
                        alm_rack : alm_rack
                         },
                    success: function(response){
                            var obj = $.parseJSON(response);
                            //console.log(obj);             
                            if (obj['result'] == "success") {
                                swal("New Location Added Successfully","Location: "+ obj['value'],"success");
                                $("#report").html("Last Location Added :"+ obj['value']);    
                                $("#report").show();                                                         
                                $("#location_details").val("");
                                $("#alm_rack").val("");                                                  
                                table.ajax.reload();
                            }
                    },
                    error:function(jqXHR, textStatus, errorThrown) {
                           // console.log(jqXHR.responseJSON);
                            swal("Cannot add new Location",""+jqXHR.responseJSON.errors.location_details,"error");
                    }
                })

        })
        /* new location insert Code end*/




    /* all location Data display Code Starts*/
        var table = $("#show_location_data").DataTable({  // Datatable Code For Showing Data
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "show_all_location",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: $('meta[name="csrf-token"]').attr('content')}
                   },
            "columns": [                
                {"class": "location_code", 
                "data": "LOCCD" },
                {"class": "location_details data",   
                 "data": "LOCNAME"},
                {"class": "alm_rack data", 
                 "data": "ALM_RACK" },
                {"data": "action" }
            ]

        }); // DataTable initialization with Server-Processing




    /* all location Data display Code end*/


    /* location Updation Code Starts*/
        $(document).on("focusout",".data", function(){
            var location_code = $(this).closest("tr").find(".location_code").text();
            var location_details = $(this).closest("tr").find(".location_details").text();
            var alm_rack = $(this).closest("tr").find(".alm_rack").text();

            $("#report").hide();  

            $.ajax({
                type:"POST",
                url:"location_master_maintainance/update",                
                data:{_token: $('meta[name="csrf-token"]').attr('content'), 
                    location_code:location_code, 
                    location_details:location_details,
                    alm_rack:alm_rack
                    },
                success:function(response){

                    if (response == 1) {
                        swal("Location Updated","Last Update:"+ location_details,"success");
                        $("#report").html("Last Update:"+ location_details);    
                        $("#report").show();         
                    }              
                                                
                    table.ajax.reload();
                },
                    error:function(jqXHR, textStatus, errorThrown) {
                            //console.log(jqXHR.responseJSON);
                            swal("Cannot add new Location",""+jqXHR.responseJSON.errors.location_details,"error");                             
                            table.ajax.reload();                            
                    }
            })
        })

    /* location Updation Cods Ends */


    /* Data Deletion Cods Starts */    
        $(document).on("click",".delete", function(){
                var location_code = $(this).closest("tr").find(".location_code").text();
                var location_details = $(this).closest("tr").find(".location_details").text();                
                var tr = $(this).closest("tr");

                $("#report").hide();                  

                $.ajax({
                    type:"POST",
                    url:"location_master_maintainance/delete",
                    data:{
                        _token: $('meta[name="csrf-token"]').attr('content'), 
                        location_code:location_code
                    },
                    success:function(response){

                         if (response == 1) {
                            swal("Deleted Successfully","Location:"+location_details,"success"); 
                            $("#report").html("Last Delete:"+ location_details);    
                            $("#report").show();                                 
                            table.ajax.reload();
                        }
                        else
                            swal("Can Not Delete Data","","error"); 
             
                    }
                })

                
        })

        /* Data Deletion Cods Ends */    



    });
        
    </script>

    </body>

    </html>