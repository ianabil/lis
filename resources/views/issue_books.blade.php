@extends('layouts.app') @section('content')
<!-- Main content -->
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Issue of book to the member</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <div class="row">
            <div class="col-md-3 form-group required">
            <!-- use this class as the red * will be after control-label -->
                    <label class='control-label'>Accession No.</label>
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

        <!-- /.row -->
        </div>
        <hr>

        <div id="data" style="display:none">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-3">
                    <label>Library No.</label>
                    <input type="text" class="form-control" name="library_no" id="library_no" placeholder="Not Available" disabled="disabled">
                </div>
                <!-- /.col -->

                <div class="col-md-7">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Not Available" disabled="disabled">
                </div>
                <!-- /.col -->

                <div class="col-md-2">
                    <label>Type</label>
                    <input type="text" class="form-control" name="type" id="type" placeholder="Not Available" disabled="disabled">
                </div>
                <!-- /.col -->
            </div>
        <br>
            <div class="row">
                <div class="col-md-2">
                    <label>Volume No</label>
                    <input type="text" class="form-control" name="volume_no" id="volume_no" placeholder="Not Available" disabled="disabled">
                </div>
                <!-- /.col -->

                <div class="col-md-2">
                    <label>Part No.</label>
                    <input type="text" class="form-control" name="part_no" id="part_no" placeholder="Not Available" disabled="disabled">
                </div>
                <!-- /.col -->                


                <div class="col-md-2">
                    <label>Copy No.</label>
                    <input type="number" class="form-control" name="copy_no" id="copy_no"  placeholder="Not Available" disabled="disabled">
                </div>
                <!-- /.col -->

                <div class="col-md-2">
                    <label>Edition No.</label>
                    <input type="text" class="form-control" name="edition_no" id="edition_no" placeholder="Not Available" disabled="disabled">
                </div>
                <!-- /.col -->

                <div class="col-md-2">
                    <label>Edition Year - From</label>
                    <input type="text" class="form-control" name="edition_year_1" id="edition_year_1" placeholder="Not Available" disabled="disabled">
                </div>
                <!-- /.col -->

                <div class="col-md-2">
                    <label>Edition Year - To</label>
                    <input type="text" class="form-control" name="edition_year_2" id="edition_year_2" placeholder="Not Available" disabled="disabled">
                </div>
                <!-- /.col -->

            </div>
            <!-- /.row -->
        <br>

            <div class="row">
                <div class="col-md-2">
                    <label>Total Page</label>
                    <input type="number" class="form-control" name="total_page" id="total_page" placeholder="Not Available" disabled="disabled">
                </div>
                <!-- /.col -->

                <div class="col-md-2">
                    <label>Price (in INR)</label>
                    <input type="number" class="form-control" name="price" id="price" placeholder="Not Available" disabled="disabled">
                </div>
                <!-- /.col -->

                <div class="col-md-2">
                    <label>Purchase Date</label>
                    <input type="text" class="form-control date" placeholder="DD/MM/YYYY" name="purchase_date" id="purchase_date" placeholder="Not Available" disabled="disabled">
                </div>
                <!-- /.col -->

                <div class="col-md-2">
                    <label class="control-label">Entry Date</label>
                <input type="text" class="form-control date" placeholder="DD/MM/YYYY" name="entry_date" id="entry_date" placeholder="Not Available" disabled="disabled">
                </div>
                <!-- /.col -->


                <div class="col-md-2">
                    <label>Subject</label>
                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Not Available" disabled="disabled">
                </div>
                <!-- /.col -->


                <div class="col-md-2">
                    <label>Reference</label>
                    <input type="text" class="form-control" name="reference" id="reference" placeholder="Not Available" disabled="disabled">
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


                <div class="col-md-2">
                    <label>Almirah / Rack</label>
                    <input type="text" class="form-control" name="almirah" id="almirah" disabled="disabled">
                </div>
                <!-- /.col -->

                <div class="col-md-5 form-group required">                        
                    <!-- use this class as the red * will be after control-label -->
                    <label class='control-label'>Member Name</label>

                    <select class="form-control select2" name="member_name" id="member_name">
                        <option value="NULL">Select One Option. . . </option>
                        @foreach($data['members_data'] as $data1)
                        <option value="{{$data1['USERNO']}}">{{$data1['UFNAME']}} {{$data1['USNAME']}}: ({{$data1['USERNO']}})</option>
                        @endforeach
                    </select>

                </div>
                <!-- /.col -->

                <div class="col-md-2 form-group required">                        
                    <!-- use this class as the red * will be after control-label -->
                    <label class='control-label'>Date of Issue</label>
                    <input type="text" class="form-control date" name="date_of_issue" id="date_of_issue" value="{{date('d-m-Y')}}">
                </div>
                <!-- /.col -->

                

            </div>
            <!-- /.row -->

            <br>
            <br>

            <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-success btn-lg" name="issue_book" id="issue_book">Issue Book
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.data div -->

    </div>
    <!-- /.box-body -->


</div>
   <!-- /.box box-default -->

    <!--loader starts-->

    <div class="col-md-offset-5 col-md-3" id="wait" style="display:none;">
        <img src='images/09b24e31234507.564a1d23c07b4.gif' width="15%" height="5%" />
        <br>Loading..
    </div>

    <!--loader ends-->

    @endsection

    <script src="{{asset('js/jquery/jquery.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            $(".date").datepicker({dateFormat: 'dd-mm-yy',maxDate: 0}); // Date picker initialization


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




            // To fetch data according to Accession No
            $(document).on("click", "#get_data", function() {
                var accession_no = $("#access_no").val();

                $("#report").hide();

                if (accession_no == "") {
                    swal("Cannot issue book!", "enter Accession No.", "error");
                    $("#data").hide();
                    $("#access_no").focus();
                    return false;
                }

                $.ajax({
                    type: "POST",
                    url: "get_data_to_issue",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: accession_no
                    },

                    success: function(response) {
                        var obj = $.parseJSON(response);
                        //console.log(obj);

                        if (obj['result'] == "invald_accessno") {
                            $("#report").html(obj['value']);
                            $("#report").show();
                            $("#data").hide();
                            $("#access_no").focus();
                            $("#reset").show();


                        } else if (obj['result'] == "already_issued" || obj['result'] == "already_discarded") {
                            $("#report").html(obj['value']);
                            $("#report").show();
                            $("#data").hide();
                            $("#access_no").focus();
                            $("#reset").show();

                        } else if (obj['result'] == "success") {

                            $("#library_no").val(obj['book']['0'].LIBNO);
                            $("#title_code").val(obj['book']['0'].TIT_CODE);
                            $("#title").val(obj['book']['0'].TITLE);
                            $("#first_author_name").val($.trim(obj['book']['0'].AUFNAME1) + " " + $.trim(obj['book']['0'].AUSNAME1));
                            $("#location").val(obj['location']['0'].LOCNAME);

                            var type_name=obj['book']['0'].TYPE;
                            if (type_name=="B")
                                type_name="Book";
                            else if(type_name =="J")
                                type_name="Journal";
                            else if(type_name=="A")
                                type_name="Bare Act";
                            else if(type_name=="P")
                                type_name="Periodical";

                            $("#type").val(type_name);
                            $("#volume_no").val(obj['book']['0'].VOLNO);
                            $("#part_no").val(obj['book']['0'].PARTNO);
                            $("#copy_no").val(obj['book']['0'].COPY_NO);
                            $("#edition_no").val(obj['book']['0'].EDENO);
                            $("#edition_year_1").val(obj['book']['0'].YEAR);
                            $("#edition_year_2").val(obj['book']['0'].YEAR1);
                            $("#total_page").val(obj['book']['0'].PAGE);
                            $("#price").val(obj['book']['0'].PRICE);
                            $("#purchase_date").val(obj['book']['0'].DTPUR);
                            $("#entry_date").val(obj['book']['0'].ENTRY_DATE);     
                            $("#publisher").val(obj['publisher']['0'].PUBNAME);                                                   
                            $("#editor").val(obj['book']['0'].EDINAME);
                            $("#subject").val(obj['book']['0'].SUB1);
                            $("#reference").val(obj['book']['0'].SUB2);



                            $("#access_no").attr("disabled", "disabled");
                            $("#reset").show();
                            $("#get_data").hide();

                            $("#first_author_name").focus();

                            $("#data").show();
                        }

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR.responseJSON);
                        swal("Invalid Accession No.", jqXHR.responseJSON.message, "error");
                        $("#access_no").val("");
                        $("#data").hide();
                        $("#reset").hide();
                        $("#access_no").focus();                        
                        
                    }

                })

            })



            //Issue book
            $(document).on("click", "#issue_book", function() {
                var accession_no = $("#access_no").val();
                var member_name = $("#member_name").val();
                var date_of_issue = $("#date_of_issue").val();

                if (member_name == "NULL") {
                    swal("Select Member", "", "error");

                    return false;
                } else if (date_of_issue == "") {
                    swal("Select Date", "", "error");

                    return false;
                }

                $.ajax({
                    type: "POST",
                    url: "insert_to_issue_book",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: accession_no,
                        member_name: member_name,
                        date_of_issue: date_of_issue
                    },
                    success: function(response) {
                        var obj = $.parseJSON(response);

                        console.log(obj);

                        if (obj['result'] == "success") 
                        {
                            swal("Issued Successfully",  "Accession No.: "+obj['value'], "success");

                            $("#report").html("Last Book Issued, Accession No. :"+ obj['value']);    
                            $("#report").show();                          
                            
                            $("#access_no").removeAttr("disabled");
                            $("#reset").hide();
                            $("#get_data").show();
                            $("#access_no").focus();
                            $("#data").hide();
                        }
                        else
                        {
                            swal("Issued not possible", "Accession No.: "+obj['value'], "error");
                            $("#data").hide();
                            $("#access_no").focus();

                        }
                    }
                })
            })





        });
    </script>

    </body>

    </html>