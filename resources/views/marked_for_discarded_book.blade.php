@extends('layouts.app') @section('content')
<!-- Main content -->
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Marked For Discarded Book</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
    <form action="#" method="POST" >
        <div class="row">
        
            <div class="col-md-3 form-group required">
                        <label class="control-label">Accession No.</label>
                    <input type="text" class="form-control" name="accession_no" id="access_no">
            </div>
            <!-- /.col -->

             <div class="col-md-1">
                <div class="form-group">
                    <label>&nbsp</label>                            
                    <button type="button" class="form-control btn btn-success" id="get_data">GET
                </div>
            </div>
            
            <!-- /.col -->

            <div class="col-md-1">
                <div class="form-group">
                    <label>&nbsp</label>
                    <button type="button" class="form-control btn btn-primary" id="reset" style="display: none">RESET
                </div>
            </div>
            <!-- /.col -->

            <div class="col-md-5">
                <div class="form-group">
                    <label>&nbsp</label>
                    <br>
                    <h4><span id="report" style="color:red;"></span></h4>
                </div>
            </div>
            <!-- /.col -->

        </div>
<hr>

    <div id="data" style="display:none" >
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Library No.</label>
                    <input type="text" class="form-control" name="library_no" id="library_no" disabled>
                </div>
            </div>


            <div class="col-md-3">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" id="title" disabled> 
                </div>
            </div>
            <!-- /.col -->

                <div class="col-md-3">
                    <label>First Auther Name</label>
                    <input type="text" class="form-control" name="first_author_name" id="first_author_name" disabled>
                </div>
                

                <div class="col-md-3">            
                    <label>Almirah/Rack</label>
                    <input type="text" class="form-control" name="almirah" id="almirah" disabled>
                </div>

            <!-- /.row -->
        </div>



        <div class="row">
            <div class="form-group">
                                
                <div class="col-md-3">            
                    <label>Present Location</label>
                    <input type="text" class="form-control" name="location_present" id="location_present" disabled>
                    <input type="text" class="form-control" name="location_code_present" id="location_code_present" style="display:none">
                                        
                </div>

                <div class="col-md-3">            
                        <label>Changed Location</label>
                        <select class="form-control select2" name="location_change" id="location_change">
                            <option value="NULL">Select One Option. . . </option>
                            @foreach($data['location_data'] as $data2)                    
                                <option value="{{$data2['LOCCD']}}">{{$data2['LOCNAME']}}</option>
                            @endforeach      
                        </select>                       
                </div>
                <!-- /.col -->

                <!-- <div class="col-md-2">            
                        <label>&nbsp;</label>
                        <input type="text" class="form-control" name="year" id="year"  placeholder="To">            
                </div>
             /.col -->  

                <div class="col-md-1">
                    <div class="form-group">
                    <label>&nbsp;</label>
                        <button type="button"  class="btn-danger " name="discard" id="discard">Discard
                    </div>
                </div>

                <div class="col-md-1">
                    <div class="form-group">
                    <label>&nbsp;</label>
                        <button type="reset"  class="btn btn-primary " name="reset" id="reset">Reset
                    </div>
                </div>

               <!-- <div class="col-md-2">
                    <div class="form-group">
                    <label>&nbsp;</label>
                        <button type="View/Print"  class="form-control btn btn-primary " name="view" id="view">View/Print
                    </div>
                </div>
                -->

            </div>

 
        </div>




    </div>
    <!-- /.box-body -->

<!--loader starts-->

            <div class="col-md-offset-5 col-md-3" id="wait" style="display:none;">
                    <img src='images/09b24e31234507.564a1d23c07b4.gif'width="15%" height="5%" />
                        <br>Loading..
            </div>
   
   <!--loader starts-->

    @endsection

    <script src="{{asset('js/jquery/jquery.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $( ".date").datepicker({ format: 'dd-mm-yyyy', endDate:'0' }); // Date picker initialization

     /* Variable decleration start*/

                var accession_no;
                var library_no;                
                var title;               
                var first_auther_name;
                var almirah;
                var location_code;
                var location_change;

     /* Variable decleration end*/
     


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

            // To reset the page start
            $(document).on("click", "#reset", function() {
                    $("#reset").hide();
                    $("#data").hide();
                    $("#get_data").show();
                    $("#report").hide();                    
                    $("#access_no").val('').removeAttr('disabled');
                    $("#access_no").focus();

            })
            // To reset the page end


            //To activate click event in enter start
            $('#access_no').keypress(function(e) {
                var key = e.which;
                if (key == 13) // the enter key code
                {
                    $('#get_data').trigger('click');
                }
            });
            //To activate click event in enter end



//get all data relating to accession no strat 
            $(document).on("click","#get_data", function(){
                accession_no = $("#access_no").val();


                $("#report").hide();

                if(accession_no=="")
                {
                    swal("Cannot discard book! enter Accession No.","","error");
                    $("#data").hide();
                    return false;
                }
                
                $.ajax({
                    type: "POST",
                    url:"get_book_data", 
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        accession_no: accession_no
                    },

                    success:function(response){
                        var obj = $.parseJSON(response);
                        //console.log(obj);
                       

                        if(obj['result']=="invald_accessno")
                        {
                            $("#report").html(obj['value']);
                            $("#report").show();
                            $("#data").hide();
                            $("#access_no").focus();
                            $("#reset").show();
                        }
                        else if(obj['result']=="discarded" || obj['result']=="issued")
                        {
                            $("#report").html(obj['value']);
                            $("#report").show();
                            $("#data").hide();
                            $("#access_no").focus();
                            $("#reset").show();                            
                        }
                        else if(obj['result']=="success_with_locname")
                        {
                            $("#library_no").val(obj['book']['0'].LIBNO);
                            $("#title").val(obj['book']['0'].TITLE);                   
                            $("#first_author_name").val($.trim(obj['book']['0'].AUFNAME1) +" "+ $.trim(obj['book']['0'].AUSNAME1));
                            $("#almirah").val(obj['location']['0'].ALM_RACK); 
                            $("#location_code_present").val(obj['book']['0'].LOCNO);                         
                            $("#location_present").val(obj['location']['0'].LOCNAME); 
                            var option = "<option value="+obj['location']['0'].LOCCD+" selected>"+obj['location']['0'].LOCNAME;
                            $("#location").prepend(option);

                            $("#access_no").attr("disabled", "disabled");
                            $("#reset").show();
                            $("#get_data").hide();

                            $("#location_change").focus();

                            $("#data").show();

                        }
                        
                        else if(obj['result']=="success_without_location")
                        {
                            $("#library_no").val(obj['book']['0'].LIBNO);
                            $("#title").val(obj['book']['0'].TITLE);                   
                            $("#first_author_name").val($.trim(obj['book']['0'].AUFNAME1) +" "+ $.trim(obj['book']['0'].AUSNAME1));

                            $("#access_no").attr("disabled", "disabled");
                            $("#reset").show();
                            $("#get_data").hide();                    

                            $("#location_change").focus();

                            $("#data").show();

                        }
                    },
                    error:function(jqXHR, textStatus, errorThrown) {
                        swal("Invalid Accession No.", "", "error");
                        $("#access_no").val("");
                        $("#data").hide();
                        $("#reset").hide();
                        $("#access_no").focus();          
                    }
                    
                    
                })
                
                

            })




            //discakr book

            $(document).on("click","#discard", function(){
                accession_no = $("#access_no").val();

                $("#reset").hide();                

                if($("#location_code_present").val()!="")
                {
                    location_change = $("#location_code_present").val();
                }                
                else if($("#location_change option:selected").val() !="NULL")
                {
                    location_change = $("#location_change option:selected").val();
                }
               

                $.ajax({
                    type: "POST",
                    url:"update_book_to_discard", 
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        accession_no: accession_no,
                        //******need to make it ready, locno may not be present within data as in books.ACCESSNO:9231
                        location_change:location_change,
                    },
                    success:function(response){

                       // console.log(response);

                        if(response==2){
                            swal("Book Discarded Successfully","Accession No.:"+accession_no,"success"); 
                            $("#report").html("Last Book Discarded: "+accession_no);
                            $("#report").show();
                            $("#reset").hide();
                            $("#get_data").show();
                            $("#access_no").focus();
                            $("#data").hide();

                            
                        }
                        else if(response==1)
                        {
                            swal("Book Already Issued","Accession No.:"+accession_no,"error"); 
                            $("#report").html("Last Book Discarded: "+accession_no);
                            $("#report").show();
                            $("#reset").hide();
                            $("#get_data").show();
                            $("#access_no").focus();
                            $("#data").hide();


                        }
                        else if(response==0)
                        {
                            swal("Book Already Discarded","Accession No.:"+accession_no,"error"); 
                            $("#report").html("Last Book Discarded"+accession_no);
                            $("#report").show();
                            $("#reset").hide();
                            $("#get_data").show();
                            $("#access_no").focus();
                            $("#data").hide();

                        }


                    }
                    
                })
                
                

            })

        });
        
    </script>

    </body>

    </html>