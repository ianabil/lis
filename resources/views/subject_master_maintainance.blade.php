@extends('layouts.app') @section('content')
<!-- Main content -->
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Subject Master Maintainance</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
          {{csrf_field()}}    
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group required">
                        <label class="control-label">
                          Subject
                        </label>
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="write down proper subject description" onkeyup="this.value = this.value.toUpperCase();">
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <input type="button" class="form-control btn-success btn btn-primary " id="add" value="Add New Subject">
                    </div>
                </div>
                <!-- /.col -->  
            </div><!-- /.row -->
        
        </div>    <!-- box-body ends-->
    </div>  <!-- box box-default ends -->

<div class="box box-default" id="show_all_data">
<div class="box-body">
        <table class="table table-striped table-bordered" id="show_subject_data">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Subject</th>
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
        $(".date").datepicker(); // Date picker initialization
        var sub;
        var val2;
        var table = $("#show_subject_data").dataTable({  // Datatable Code For Showing Data
        "processing": true,
        "serverSide": true,

        "ajax":{
                 "url": "show_all_subject",
                 "dataType": "json",
                 "type": "POST",
                 "data":{ _token: $('meta[name="csrf-token"]').attr('content')}
               },
        "columns": [                
            {"class": "id",
             "data": "SUBNO"},
            {"class": "subject data",   
             "data": "SUBNAME"},
            {"class": "delete", 
             "data": "action"}
        ],

        "drawCallback": function( settings ) {
            $('.data').attr('contenteditable',true);
        }	 

    }); // DataTable initialization with Server-Processing
     
    
    //updating subject code section
    $('tbody').on('focusin', '.data', function () {
        var currentRow=$(this).closest("tr");
        val2=currentRow.find(".subject").text().toUpperCase();
    })

     $('tbody').on('focusout', '.data', function () {

        var currentRow=$(this).closest("tr"); 
        
        var scode=currentRow.find(".id").text(); // get current row 1st TD value
        sub=currentRow.find(".subject").text().toUpperCase(); // get current row 2nd TD

        var n = sub.localeCompare(val2);
        if(n == 0){
            table.api().ajax.reload();
            return;
        }
        

    $.ajax({
                    type: "POST",
                    url: "update_subject",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: scode,
                        subject: sub
                         },
                    success: function(response){
                        swal(response+" Subject Updated Successfully","","success");
                        table.api().ajax.reload();
                    },
                    error:function(jqXHR, textStatus, errorThrown) {
                        swal("Cannot Update Subject This Way!!",jqXHR.responseJSON.errors.subject['0'],"error");
                        table.api().ajax.reload();
                    } 
                })
    });

//inserting new subject
     $(document).on("click","#add", function(){
           
           var sub = $("#subject").val();

           $.ajax({
               type:"POST",
               url:"subjectentry",
               data:{
                    _token: $('meta[name="csrf-token"]').attr('content'), 
                    subject:sub
               },
               success:function(response){
                    swal("New Subject Inserted","","success");
                    table.api().ajax.reload();
                    document.getElementById("subject").value="";
                    
               },
               error:function(jqXHR, textStatus, errorThrown) {
                   swal("Cannot Create Subject",jqXHR.responseJSON.errors.subject['0'],"error");
                   document.getElementById("subject").value="";
                   document.getElementById("subject").focus();
               }
           })
        })
// Inserting new subject on pressing enter key
    var input = document.getElementById("subject");
    input.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            document.getElementById("add").click();
        }
    });


//deleting subject from datatable code section
    $('tbody').on('click','.delete',function(){
         // get the current row
         var currentRow=$(this).closest("tr"); 
         var col1=currentRow.find("td:eq(0)").text(); // get current row 1st TD value

         $.ajax({
            type: "POST",
            url: "delete_subject",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: col1,
            },
            success: function(response){
                if(response==0){
                    swal("Currently This Record Cannot Be Deleted!!","","error");
                }
                else{
                    swal("Subject Deleted Successfully","","success");  
                    table.api().ajax.reload();
                }
            }
        })
         
    })

});
    
</script>

    </body>

    </html>