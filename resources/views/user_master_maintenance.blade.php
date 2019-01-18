@extends('layouts.app') @section('content')
<!-- Main content -->
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">User Master Maintenance</h3>
        <!-- <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div> -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
    
        <div class="row">        
            <div class="col-md-offset-3 col-md-3">
                <div class="form-group">
                    <label>User Id</label>
                    <input type="text" class="form-control" name="user_id" id="user_id" >
                </div>
            </div>
            <!-- /.col -->

            <div class=" col-md-3">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" id="name" >
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-offset-2 col-md-3">
                <div class="form-group">
                    <label>Email ID</label>
                    <input type="email" class="form-control" name="email_id" id="email_id" >
                </div>
            </div>
            <!-- /.col -->

            <div class="col-md-3">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" id="password" >
                </div>
            </div>
            <!-- /.col -->

            <div class="col-md-3">
                <label>User Type</label>
                <select class="form-control" name="user_type" id="user_type">
                    <option value="">Select One Option. . . </option>
                    <option value="G">General</option>
                    <option value="S">Super</option>
                </select>
            </div>

            
             <div class="col-md-offset-4 col-md-3">
                <div class="form-group">
                    <label>&nbsp</label>    
                    <label>&nbsp</label>                          
                    <button type="button" class="form-control btn btn-primary" id="create_user">Create User
                </div>
            </div>
            
           

            <!-- /.col -->
        </div>

 <hr>  
       
 <div class="row">
        
        <div class="col-md-3">
            <div class="form-group">
                <label>User</label>
                <select class="form-control" name="user_id_select" id="user_id_select">
                    <option value="NULL">Select One Option. . . </option>
                    @foreach($data['login_users'] as $data1)                    
                        <option value="{{$data1['user_id']}}">{{$data1['name']}}</option>
                    @endforeach
                </select>                
            </div>
        </div>
        <!-- /.col -->

        <div class="col-md-3">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="edit_name" id="edit_name" >
            </div>
        </div>

        <!-- /.col -->

        <div class="col-md-3">
            <div class="form-group">
                <label>Email ID</label>
                <input type="email" class="form-control" name="edit_email" id="edit_email" >
            </div>
        </div>

        <!-- /.col -->
    </div>
     <!-- /.row -->

     <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>New Password</label>
                <input type="password" class="form-control" name="edit_password" id="edit_password" >
            </div>
        </div>

        <!-- /.col -->

        <div class="col-md-3">
            <div class="form-group">
                <label>Re-enter New Password</label>
                <input type="password" class="form-control" name="edit_re_password" id="edit_re_password" >
            </div>
        </div>

        <!-- /.col -->

        <div class="col-md-3">
            <label>User Type</label>
            <select class="form-control" name="edit_user_type" id="edit_user_type">
                <option value="">Select One Option. . . </option>
                <option value="G">General</option>
                <option value="S">Super</option>
            </select>
        </div>

        
         <div class="col-md-2">
            <div class="form-group">
                <label>&nbsp</label>    
                <label>&nbsp</label>                          
                <button type="button" class="form-control btn btn-success" id="edit_user">Update User
            </div>
        </div>
        
       

        <!-- /.col -->
    </div>
</div>
        
<br> <br>


    </div>
    <!-- /.box-body -->
    @endsection

    <script src="{{asset('js/jquery/jquery.min.js')}}"></script>

    <script>
        $(document).ready(function(){
                  
                $(document).on("click","#create_user", function(){
                      
                      /*Fetching the values*/            
                        var uid = $("#user_id").val();
                        var name = $("#name").val();
                        var email_id = $("#email_id").val();
                        var pass = $("#password").val();
                        var type = $("#user_type option:selected").val();

                    if(uid == "" || pass == "" || type == "")
                    {
                        swal("Fields can not be empty"," ","error");
                        return false;
                    }

                $.ajax({

                    url:"user_master_maintenance",
                    method: "POST",
                    data : {_token: $('meta[name="csrf-token"]').attr('content'),
                            user_id: uid,
                            name:name,
                            email_id:email_id,
                            password:pass,
                            user_type:type
                            },

                    success:function (response)
                    {
                        swal("New user created ","","success");
                        $("#user_id").val('');
                        $("#name").val('');
                        $("#email_id").val('');
                        $("#password").val('');
                    },
                    error:function(jqXHR, textStatus, errorThrown) {
                        swal("Cannot create new user","User Id already exists","error");
                    }
                })
                

            })


            // Fetching details on selecting an user to update
            $(document).on("change","#user_id_select", function(){
                var user_id = $("#user_id_select option:selected").val();

                $.ajax({
                    url:"edit_login_user_details/get_data",
                    method:"POST",
                    data:{
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        user_id:user_id
                    },
                    success:function(response){
                        var obj = $.parseJSON(response);
                        
                        $("#edit_name").val(obj['0'].name);
                        $("#edit_email").val(obj['0'].email);
                        
                        var option = "<option value=" + obj['0'].status + " selected>" + obj['0'].status;
                        $("#edit_user_type").prepend(option);
                    },
                    error:function(response){
                        swal("Can Not Get Data Of Selected User","","error");
                    }
                })
            })

            

            //update login user details

           $(document).on("click","#edit_user", function(){
           
           /*Fetching the values*/
           var user_id_select = $("#user_id_select option:selected").val();
           var edit_password = $("#edit_password").val();
           var edit_re_password = $("#edit_re_password").val();
           var edit_name = $("#edit_name").val();
           var edit_email = $("#edit_email").val();
           var edit_type = $("#edit_user_type option:selected").val();           

           
           /*validation*/

           if(user_id_select == "NULL" || edit_password == "" || edit_re_password == "")
           {
            swal("Select User and enter Password"," ","error");
               return false;
           }
   
         /*Checking the re-entered password*/

            if(edit_password!=edit_re_password)
            {
               swal("Password and Confirm Password must be same"," ","error");
               return false;
            }
           
                        
            $.ajax({
   
               url:"edit_login_user_details",
               method: "GET",
               data : {user_id_select:user_id_select,
                        edit_name:edit_name,
                        edit_email:edit_email,
                        edit_password: edit_password,
                        edit_re_password: edit_re_password,
                        edit_type: edit_type
                       },
                     
   
               success:function (response)
               {
                    if(response==0)                        
                        swal("Password has been updated successfully"," ","success");

                    else if(response==2)                        
                        swal("Curren password and New password is same"," ","error");
                            
                    else if(response==1)
                         swal("Password is same as previous"," ","error");    

               },
               error:function(jqXHR, textStatus, errorThrown) {
                            //console.log(jqXHR.responseJSON);
                            swal("Cannot update user details! enter value(s)",jqXHR.responseJSON.message,"error");
                            table.ajax.reload();
                    }               
            })

       
        })
        });


        
    </script>

    </body>

    </html>