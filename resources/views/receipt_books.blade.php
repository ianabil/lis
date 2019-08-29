@extends('layouts.app') @section('content')
<!-- Main content -->
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Receipt of book from the Member</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Accession No.</label>
                    <input type="text" class="form-control" name="accession_no" id="access_no">
                </div>
            </div>
            <!-- /.col -->

            <div class="col-md-1">
                <div class="form-group">
                    <label>&nbsp</label><br>
                    <button type="button" class="btn btn-success" name="get_data" id="get_data">GET
                </div>
            </div>
            <!-- /.col -->

            <div class="col-md-5">
                <div class="form-group">
                    <label>&nbsp</label> <br>                           
                    <span id="report" style="color:red;"></span>  
                </div>
            </div>            
            <!-- /.col -->


        </div>
        <!-- /.row -->        
<hr>

<div id="data" style="display:none">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-2">
                    <label>Library No.</label>
                    <input type="text" class="form-control" name="library_no" id="library_no" placeholder="Not Mentioned" disabled="disabled">
                </div>
                <!-- /.col -->

                <div class="col-md-3">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Not Mentioned" disabled="disabled">
                </div>
                <!-- /.col -->

                <div class="col-md-3">
                    <label>First Author</label>
                    <input type="text" class="form-control" name="auth1" id="auth1" placeholder="Not Mentioned" disabled="disabled">
                </div>
                <!-- /.col -->

                <div class="col-md-3">
                    <label>Second Author</label>
                    <input type="text" class="form-control" name="auth2" id="auth2" placeholder="Not Mentioned" disabled="disabled">
                </div>
                <!-- /.col -->

                <div class="col-md-1">
                    <label>Type</label>
                    <input type="text" class="form-control" name="type" id="type" placeholder="Not Mentioned" disabled="disabled">
                </div>
                <!-- /.col -->
            </div>
                <br>
            <div class="row">
                <div class="col-md-2">
                    <label>Volume No</label>
                    <input type="text" class="form-control" name="volume_no" id="volume_no" placeholder="Not Mentioned" disabled="disabled">
                </div>
                <!-- /.col -->

                <div class="col-md-2">
                    <label>Part No.</label>
                    <input type="text" class="form-control" name="part_no" id="part_no" placeholder="Not Mentioned" disabled="disabled">
                </div>
                <!-- /.col -->                


                <div class="col-md-2">
                    <label>Copy No.</label>
                    <input type="number" class="form-control" name="copy_no" id="copy_no"  placeholder="Not Mentioned" disabled="disabled">
                </div>
                <!-- /.col -->

                <div class="col-md-2">
                    <label>Edition No.</label>
                    <input type="text" class="form-control" name="edition_no" id="edition_no" placeholder="Not Mentioned" disabled="disabled">
                </div>
                <!-- /.col -->

                <div class="col-md-2">
                    <label>Edition Year - From</label>
                    <input type="text" class="form-control" name="edition_year_1" id="edition_year_1" placeholder="Not Mentioned" disabled="disabled">
                </div>
                <!-- /.col -->

                <div class="col-md-2">
                    <label>Edition Year - To</label>
                    <input type="text" class="form-control" name="edition_year_2" id="edition_year_2" placeholder="Not Mentioned" disabled="disabled">
                </div>
                <!-- /.col -->

            </div>
            <!-- /.row -->
        <br>

            <div class="row">
                <div class="col-md-2">
                    <label>Total Page</label>
                    <input type="number" class="form-control" name="total_page" id="total_page" placeholder="Not Mentioned" disabled="disabled">
                </div>
                <!-- /.col -->

                <div class="col-md-2">
                    <label>Price (in INR)</label>
                    <input type="number" class="form-control" name="price" id="price" placeholder="Not Mentioned" disabled="disabled">
                </div>
                <!-- /.col -->

                <div class="col-md-2">
                    <label>Purchase Date</label>
                    <input type="text" class="form-control date" placeholder="DD/MM/YYYY" name="purchase_date" id="purchase_date" placeholder="Not Mentioned" disabled="disabled">
                </div>
                <!-- /.col -->

                <div class="col-md-2">
                    <label class="control-label">Entry Date</label>
                <input type="text" class="form-control date" placeholder="DD/MM/YYYY" name="entry_date" id="entry_date" placeholder="Not Mentioned" disabled="disabled">
                </div>
                <!-- /.col -->


                <div class="col-md-2">
                    <label>Subject</label>
                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Not Mentioned" disabled="disabled">
                </div>
                <!-- /.col -->


                <div class="col-md-2">
                    <label>Reference</label>
                    <input type="text" class="form-control" name="reference" id="reference" placeholder="Not Mentioned" disabled="disabled">
                </div>
                <!-- /.col -->                
                

            </div>
            <!-- /.row -->
        <br>

            <div class="row">

                <div class="col-md-4">
                    <label>Publisher</label>
                    <input type="text" class="form-control" name="publisher" id="publisher" disabled="disabled">
                </div>
                <!-- /.col -->

                <div class="col-md-4">
                    <label>Editor</label>
                    <input type="text" class="form-control" name="editor" id="editor" disabled="disabled">
                </div>
                <!-- /.col -->

                <div class="col-md-4">
                    <label>Location</label>
                    <input type="text" class="form-control" name="location" id="location" disabled="disabled">

                </div>
                <!-- /.col -->
            </div>
            <!--/.row-->
        <br>

        <div class="row">

                <div class="col-md-5">         
                    <label>Member Name</label>
                    <input type="text" class="form-control" name="member_name" id="member_name" placeholder="Mr./Ms." disabled>
                    <input type="text" class="form-control" name="member_code" id="member_code" style="display:none">                                        
                </div>
                <!-- /.col -->

                <div class="col-md-3">         
                    <label>Date of Issue</label>
                    <input type="text" class="form-control date" name="date_of_issue" id="date_of_issue" disabled>
                </div>
                <!-- /.col -->

                <div class="col-md-3">       
                    <label>Date of Receipt</label>
                    <input type="text" class="form-control date" name="date_of_receipt" id="date_of_receipt" value="{{date('d-m-Y')}}">
                </div>
                <!-- /.col -->
        </div>
        <!-- /.row -->

<br><br>      
        <div class="row">            
            <div class="col-md-4 col-md-offset-5 col-sm-3 col-sm-offset-3">
                <button type="button" class="btn btn-success btn-lg" name="return_book" id="return_book">Return Book
            </div>
        </div>
        <!-- /.row -->


        </div>


    </div>
   
    <!-- /.box-body -->

     <!--loader starts-->

            <div class="col-md-offset-5 col-md-3" id="wait" style="display:none;">
                <img src='images/09b24e31234507.564a1d23c07b4.gif'width="15%" height="5%" />
                <br>Loading..
            </div>
   
   <!--loader ends-->

   

    <script src="{{asset('js/jquery/jquery.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $( ".date").datepicker({ format: 'dd-mm-yyyy', endDate:'0'}); // Date picker initialization

     /* Variable decleration start*/

                var accession_no;
                var library_no;                
                var title;               
                var first_auther_name;
                var almirah;
                var location_code;
                var location_change;

     /* Variable decleration end*/


/*Loader*/
     
        $(document).ajaxStart(function(){
             $("#wait").css("display", "block");
        });
        $(document).ajaxComplete(function(){
            $("#wait").css("display", "none");
        });
				
//Loader



            $(document).on("click","#get_data", function(){
                accession_no = $("#access_no").val();
                
                if(accession_no=="")
                {
                    swal("Cannot return book! enter Accession No.","","error");
                    $("#data").hide();
                    return false;        
                }
                
                $.ajax({
                    type: "POST",
                    url:"get_data_to_return", 
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        accession_no: accession_no
                    },
                    success:function(response){
                        var obj = $.parseJSON(response);

                        if(obj['result']=="invald_accessno")
                        {
                            $("#report").html(obj['value']);

                            $("#data").hide();
                        }
                        else if(obj['result']=="not_issued" || obj['result']=="discarded")
                        {                            
                            $("#report").html(obj['value']);

                            $("#data").hide();
                            
                        }
                        else if(obj['result']=="can_be_returned")
                        {
                            $("#report").html('');

                            $("#library_no").val(obj['books']['0'].LIBNO);
                            $("#title_code").val(obj['books']['0'].TIT_CODE);
                            $("#title").val(obj['books']['0'].TITLE);                            
                            $("#location").val(obj['location']['0'].LOCNAME);

                            var type_name=obj['books']['0'].TYPE;
                            if (type_name=="B")
                                type_name="Book";
                            else if(type_name =="J")
                                type_name="Journal";
                            else if(type_name=="A")
                                type_name="Bare Act";
                            else if(type_name=="P")
                                type_name="Periodical";

                            $("#type").val(type_name);
                            $("#volume_no").val(obj['books']['0'].VOLNO);
                            $("#part_no").val(obj['books']['0'].PARTNO);
                            $("#copy_no").val(obj['books']['0'].COPY_NO);
                            $("#edition_no").val(obj['books']['0'].EDENO);
                            $("#edition_year_1").val(obj['books']['0'].YEAR);
                            $("#edition_year_2").val(obj['books']['0'].YEAR1);
                            $("#total_page").val(obj['books']['0'].PAGE);
                            $("#price").val(obj['books']['0'].PRICE);
                            $("#purchase_date").val(obj['books']['0'].DTPUR);
                            $("#entry_date").val(obj['books']['0'].ENTRY_DATE);     
                            $("#publisher").val(obj['publisher']['0'].PUBNAME);                                                   
                            $("#editor").val(obj['books']['0'].EDINAME);
                            $("#subject").val(obj['books']['0'].SUB1);
                            $("#reference").val(obj['books']['0'].SUB2);                            
                            
                            if(obj['books']['0'].AUFNAME1!=null && obj['books']['0'].AUSNAME1!=null)
                                $("#auth1").val(obj['books']['0'].AUFNAME1+' '+obj['books']['0'].AUSNAME1);
                            else if(obj['books']['0'].AUSNAME1==null)
                                $("#auth1").val(obj['books']['0'].AUFNAME1);

                            if(obj['books']['0'].AUFNAME2!=null && obj['books']['0'].AUSNAME2!=null)
                                $("#auth1").val(obj['books']['0'].AUFNAME2+' '+obj['books']['0'].AUSNAME2);
                            else if(obj['books']['0'].AUSNAME2==null)
                                $("#auth1").val(obj['books']['0'].AUFNAME2);


                            $("#member_name").val($.trim(obj['issued_to']['0'].UFNAME)+"  "+ $.trim(obj['issued_to']['0'].USNAME));
                            $("#member_code").val(obj['issued_to']['0'].USERNO);                                                     

                            
                            $("#date_of_issue").val(obj['issued_to']['0'].DTISS);                        
                        

                            $("#data").show();

                        }
                    },
                    error:function(jqXHR, textStatus, errorThrown) {
                        swal("Server Error.",jqXHR.responseJSON.message,"error");
                    }
                    
                })
                
                

            })



            $(document).on("click","#return_book", function(){

                accession_no = $("#access_no").val();
                var member_code = $("#member_code").val();
                var date_of_receipt = $("#date_of_receipt").val();                              

                $.ajax({
                    type: "POST",
                    url:"update_receive_book_record", 
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        accession_no: accession_no,
                        member_code :member_code,                        
                        date_of_receipt: date_of_receipt
                    },

                    success:function(response){

                        console.log(response);

                        if(response==1){
                            swal("Book Returned Successfully","","success"); 
                            setTimeout(function(){
                                window.location.replace('receipt_books')
                            },1500);
                        }
                        
                    }
                    
                })
                
                

            })


        });
        
    </script>
 @endsection