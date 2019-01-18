@extends('layouts.app') @section('content')
<!-- Main content -->
<div class="box box-default">
   <div class="box-header with-border">
      <h3 class="box-title">Update Password</h3>
      <div class="box-tools pull-right">
         <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
      <div class="row">
         <div class="col-md-3 col-md-offset-4">
            <div class="form-group">
               <label> User Id</label>
               <input type="text" class="form-control" name="user_id" id="user_id" value={{Auth::user()->user_id}} disabled>
            </div>
         </div>
         <div class="col-md-3 col-md-offset-4">
            <div class="form-group">
               <label> Current Password</label>
               <input type="password" class="form-control" name="cur_password" id="cur_password" >
            </div>
         </div>
         <!-- /.col -->
         <div class="col-md-3 col-md-offset-4">
            <div class="form-group">
               <label>New Password</label>
               <input type="password" class="form-control" name="password" id="password" >
            </div>
         </div>
         <!-- /.col -->
         <div class="col-md-3 col-md-offset-4">
            <div class="form-group">
               <label>Confirm Password</label>
               <input type="password" class="form-control" name="re_password" id="re_password" >
            </div>
         </div>
         <div class="col-md-3 col-md-offset-4">
            <div class="form-group">
               <label>&nbsp</label>                            
               <button type="button" class="form-control btn btn-primary" name= "change_password" id="change_password">Change Password
            </div>
         </div>
         <!-- /.col -->
      </div>
      <hr>
   </div>
   <br> <br>
</div>
<!-- /.box-body -->
@endsection
<script src="{{asset('js/jquery/jquery.min.js')}}"></script>
<script>
   $(document).ready(function(){
                  
       $(document).on("click","#change_password", function(){
           
           /*Fetching the values*/
   
           var uid = $("#user_id").val();
           var current_password = $("#cur_password").val();
           var pass = $("#password").val();
           var re_pass = $("#re_password").val();
           
           /*validation*/

           if(uid == "" || current_password == "" || pass == "" || re_pass == "")
           {
            swal("Fields can not be empty"," ","error");
               return false;
           }
   
               /* Checking the Current Password and New Password */

         if(current_password == pass)
         {
            swal("Curren password and New password can not be the same"," ","error");
               return false;
         }
         
         /*Checking the re-entered password*/

            if(pass!=re_pass)
            {
               swal("Password and Confirm Password has to be the same"," ","error");
               return false;
            }
           
                        
            $.ajax({
   
               url:"update_password/update",
               method: "GET",
               data : {u_id:uid,
                       curr_password: current_password,
                       new_password: pass,
                       re_password: re_pass,
                       },
                     
   
               success:function (response)
               {
                    if(response==0)                        
                        swal("Password has been updated successfully"," ","success");
                    else
                        swal("Invalid password, please contact admin"," ","error");    

               }
            })

       
        })
    });
   
   
</script>
</body>
</html>