@extends('layouts.app') @section('content')
<!-- Main content -->
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Add New Member</h3>
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
                    <label class='control-label'>First Name</label>
                    <input type="text" class="form-control" name="first_name" id="first_name"> 
            </div>

            <!-- /.col -->
            <div class="col-md-3 form-group required">
                    <!-- use this class as the red * will be after control-label -->
                    <label class='control-label'>Last Name</label>
                    <input type="text" class="form-control" name="last_name" id="last_name">
            </div>


            <!-- /.col -->
            <div class="col-md-3">
                <div class="form-group">            
                    <label>Designation</label>
                    <input type="text" class="form-control" name="designation" id="designation">
                </div>
            </div>

        <!-- /.row -->            
        </div>



         <div class="row">       
         <div class="col-md-3">   
                <div class="form-group">Present Address</label><br>
                    <textarea rows="3" cols="35" class="form-control" name="present_address" id="present_address"></textarea>
                </div>
            </div>
                <!-- /.col -->
                
            <div class="col-md-3">   
                <div class="form-group">                          
                    <label>Permanent Address</label>&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="do" value="do"> Same<br>
                    <textarea rows="3" cols="35" class="form-control" name="permanent_address" id="permanent_address"></textarea>
                </div>
            </div>
            <!-- /.col -->


                <div class="col-md-2">
                    <div class="form-group">                            
                        <label>Valid from Date</label>
                        <input type="text" class="form-control date" style="height:25px;" name="valid_from" id="valid_from"  value="{{date('d-m-Y')}}" placeholder="From">            
                      
                        <input type="text" class="form-control date" style="height:25px; margin-top:10px" name="valid_upto" id="valid_upto"  placeholder="To">            
                    </div>
                </div>
                <!-- /.col -->  

                <div class="col-md-1">
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>&nbsp;</label> 
                        <button type="button" style="margin-top:10px" class="form-control btn-success btn btn-primary " id="add_member" name="add_member">Add New Member                   
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>&nbsp</label>
                            <h4><span id="report" style="color:red;"></span></h4>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>

        <!-- /.row -->
        </div>

     <!-- /.box-body add_new  -->    
     </div>

<!--box box-default Main content end-->
</div>


<div class="box box-default" id="show_all_data">

    <div class="box-header with-border">
        <h3 class="box-title">All Member Details</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>
    <!-- /.box-header -->

    <div class="box-body">
        <div style="overflow-x:scroll">
            <table class="table table-striped table-bordered responsive-sm" id="show_member_data">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>                        
                        <th>Designation</th>                            
                        <th>Present Address</th>
                        <th>Permanent Address</th>                            
                        <th>Valid From</th>   
                        <th>Valid Upto</th>  
                        <th>Action</th>                         
                    </thead>                    
            </table>
        </div>
    </div>

</div>

<hr>
     
<br> <br>
     
     
</div>




    @endsection

    <script src="{{asset('js/jquery/jquery.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $( ".date").datepicker({ dateFormat: 'dd-mm-yy', minDate:0 }); // Date picker initialization


     /* Variable decleration start*/

                var member_code;
                var first_name;
                var last_name;                
                var designation;
                var present_address;
                var permanent_address;
                var valid_from;
                var valid_upto;

     /* Variable decleration end*/

       /* Permanent Address & Present event same/different start*/
       
       $(document).on("change","#do", function(){
            if(this.checked)
            {
                present_address = $("#present_address").val();
                $("#permanent_address").val(present_address);
            }
            else{
                $("#permanent_address").val("");
            }
       });

        /* Permanent Address & Present event same/different   end*/



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
                    $('#add_member').trigger('click');
                }
            });
            //To activate click event in enter end


        // Double Click To Enable Content editable
        $(document).on("click",".data", function(){
            $(this).attr('contenteditable',true);
        })



       /* New Member insert Code Starts*/

        $(document).on("click","#add_member", function(){
                first_name = $("#first_name").val();
                last_name = $("#last_name").val();                
                designation = $("#designation").val();
                present_address = $("#present_address").val();
                permanent_address = $("#permanent_address").val();
                valid_from = $("#valid_from").val();
                valid_upto = $("#valid_upto").val();


                $.ajax({
                    type: "POST",
                    url: "insert_new_member",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        first_name: first_name,
                        last_name: last_name,
                        designation: designation,
                        present_address: present_address,                        
                        permanent_address: permanent_address,                                                                        
                        valid_from: valid_from,
                        valid_upto : valid_upto
                         },
                    success: function(response){
                            var obj = $.parseJSON(response);
                            //console.log(obj);        
                            if (obj['result'] == "success") 
                            {
                                swal("","New Member Added Successfully","success");

                                first_name = $("#first_name").val("");
                                last_name = $("#last_name").val("");                
                                designation = $("#designation").val("");
                                present_address = $("#present_address").val("");
                                permanent_address = $("#permanent_address").val("");
                                valid_from = $("#valid_from").val();
                                valid_upto = $("#valid_upto").val("");

                                $("#report").html("Last Added Member ID:"+ obj['value']);    
                                $("#report").show();                                                         
                                $("#location_details").val("");
                                $("#alm_rack").val("");  

                                table.api().ajax.reload();                                
                            }

                           
                    },
                    error: function(response) {
                            if(response.responseJSON.errors.hasOwnProperty('valid_from'))
                                 swal("Cannot create new Member", "Validity start from date is required", "error");
                            if(response.responseJSON.errors.hasOwnProperty('last_name'))
                                 swal("Cannot create new Member", "Last Name field can not be empty", "error");
                            if(response.responseJSON.errors.hasOwnProperty('first_name'))
                                 swal("Cannot create new Member", "First Name field can not be empty", "error");                                 
                    }
                })

        })
        /*  New Member insert Code end*/


 


    /* All members display Code Starts*/

        var table = $("#show_member_data").DataTable({  // Datatable Code For Showing Data
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "show_all_member",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: $('meta[name="csrf-token"]').attr('content')}
                   },
            "columns": [                
                {"class": "member_code", 
                "data": "USERNO" },
                {"class": "first_name data",   
                 "data": "UFNAME"},
                {"class": "last_name data", 
                 "data": "USNAME" },
                 {"class": "designation data", 
                 "data": "UDESIG" },
                 {"class": "present_address data", 
                 "data": "UPRADD1" },
                 {"class": "permanent_address data", 
                 "data": "UPRADD2" },                
                 {"class": "valid_from data", 
                 "data": "VALIDFR" },  
                 {"class": "valid_upto data", 
                 "data": "VALIDTO" },  
                {"class": "delete", 
                 "data": "action" }
            ]


        }); // DataTable initialization with Server-Processing

    /* All members display Code Starts*/
    

       /* Data Updation Code Starts*/
       $(document).on("focusout",".data", function(){
            member_code = $(this).closest("tr").find(".member_code").text();
            first_name = $(this).closest("tr").find(".first_name").text();
            last_name = $(this).closest("tr").find(".last_name").text();
            designation = $(this).closest("tr").find(".designation").text();
            present_address = $(this).closest("tr").find(".present_address").text();            
            permanent_address = $(this).closest("tr").find(".permanent_address").text();
            valid_from = $(this).closest("tr").find(".valid_from").text();
            valid_upto = $(this).closest("tr").find(".valid_upto").text();


            $("#report").hide();    
            
            $.ajax({
                type:"POST",
                url:"member_master_maintainance/update",                
                data:{_token: $('meta[name="csrf-token"]').attr('content'), 
                        member_code: member_code,
                        first_name: first_name,
                        last_name: last_name,
                        designation: designation,
                        present_address: present_address,                        
                        permanent_address: permanent_address,                                                                        
                        valid_from: valid_from,
                        valid_upto : valid_upto
                    },
                success:function(response){

                if (response == 1) {                    
                    swal("Member Details Updated","Member: Mr./Ms."+first_name+ " "+ last_name,"success");
                    $("#report").html(" Last Update Member: Mr./Ms."+first_name+ " "+ last_name);    
                    $("#report").show();                                
                    table.ajax.reload();
                }

                },
                error:function(jqXHR, textStatus, errorThrown) {
                    //console.log(jqXHR.responseJSON);
                    swal("Cannot Update Member details",jqXHR.responseJSON.message,"error");
                    table.ajax.reload();
                }
            })
        })

        /* Data Updation Cods Ends */

    /* Data Deletion Cods Starts */    
        $(document).on("click",".delete", function(){
                var member_code = $(this).closest("tr").find(".member_code").text();
                var first_name = $(this).closest("tr").find(".first_name").text();
                var last_name = $(this).closest("tr").find(".last_name").text();                
                var tr = $(this).closest("tr");

                $("#report").hide();

                $.ajax({
                    type:"POST",
                    url:"member_master_maintainance/delete",
                    data:{
                        _token: $('meta[name="csrf-token"]').attr('content'), 
                        member_code:member_code
                    },
                    success:function(response){

                        if(response==1){
                            swal("Data Deleted Successfully","Deleted Member: Mr./Ms."+first_name+ " "+ last_name+", Code: "+ member_code,"success"); 
                            $("#report").html(" Last Deleted Member: Mr./Ms."+first_name+ " "+ last_name);    
                            $("#report").show();                                
                            table.ajax.reload();
                        }
                        else
                        {   
                            swal("Can Not Delete Data","Book exists with this Member","error"); 
                        } 



                    }
                })
        })

        /* Data Deletion Cods Ends */    


 });
        
    </script>

    </body>

    </html>