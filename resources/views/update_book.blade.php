@extends('layouts.app') @section('content')
<!-- Main content -->
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Book / Journal / Bare Act Update</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group required">
                    <label class="control-label">Accession No.</label>
                    <input type="text" class="form-control" name="accession_no" id="access_no">
                </div>
            </div>
            <!-- /.col -->

            <div class="col-md-1">
                <div class="form-group">
                    <label>&nbsp</label><br>
                    <button type="button" class="btn btn-info" id="get_data">GET
                </div>
            </div>
            <!-- /.col -->

            <div class="col-md-1">
                <div class="form-group">
                    <label>&nbsp</label>
                    <button type="button" class="btn btn-primary" id="reset" style="display: none">RESET
                </div>
            </div>
            <!-- /.col -->

        </div>
        <!-- /.row -->

        <hr>
        <div id="data" style="display:none">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group required">
                        <label class="control-label">Library No.</label>
                        <input type="text" class="form-control" name="library_no" id="library_no">
                    </div>
                </div>
                <!-- /.col -->

                <div class="col-md-3" id="existing_title_div">
                    <div class="form-group required">
                        <label class="control-label">Title</label>
                        <br>
                        <select class="form-control select2" name="title" id="title">
                            <option value="">Select One Option. . . </option>
                            @foreach($data['title_data'] as $data_title)
                            <option value="{{$data_title['TIT_CODE']}}">{{$data_title['TIT_DESC']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- /.col -->

                <div class="col-md-3 form-group required" style="display:none" id="new_title_div">
                    <label class="control-label">Title</label>
                    <input type="text" class="form-control" placeholder="Type the Title Name" name="new_title" id="title_new">
                </div>
                <!-- /.col -->

                <div class="col-md-2 form-group required">
                    <label class="control-label"> Type</label>
                    <select class="form-control select2" name="type" id="type">
                        <option value="">Select One Option. . . </option>
                        <option value="B">Book</option>
                        <option value="J">Journal</option>
                        <option value="A">Bare Act</option>
                        <option value="P">Periodical</option>
                    </select>
                </div>
                <!-- /.col -->

                <div class="col-md-2 form-group">
                    <label class="control-label">Content</label>
                    <textarea class="form-control" id="content" rows="3"></textarea>
                </div>

            </div>
            <!-- /.row -->
           

            <div class="row">
                <div class="col-md-2">
                    <label>Volume No.</label>
                    <input type="text" class="form-control" name="volume_no" id="volume_no">
                </div>
                <!-- /.col -->

                <div class="col-md-2">
                    <label>Part No.</label>
                    <input type="text" class="form-control" name="part_no" id="part_no">
                </div>
                <!-- /.col -->

                <div class="col-md-2">
                    <label>Copy No.</label>
                    <input type="number" class="form-control" name="copy_no" id="copy_no">
                </div>
                <!-- /.col -->

                <div class="col-md-2">
                    <label>Edition No.</label>
                    <input type="text" class="form-control" name="edition_no" id="edition_no">
                </div>
                <!-- /.col -->

                <div class="col-md-2">
                    <label>Edition Year - From</label>
                    <input type="text" class="form-control" name="edition_year_1" id="edition_year_1">
                </div>
                <!-- /.col -->

                <div class="col-md-2">
                    <label>Edition Year - To</label>
                    <input type="text" class="form-control" name="edition_year_2" id="edition_year_2">
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <hr>

            <div class="row">
                <div class="col-md-2">
                    <label>Total Page</label>
                    <input type="number" class="form-control" name="total_page" id="total_page">
                </div>
                <!-- /.col -->

                <div class="col-md-2">
                    <label>Price (in INR)</label>
                    <input type="number" class="form-control" name="price" id="price">
                </div>
                <!-- /.col -->

                <div class="col-md-2">
                    <label>Purchase Date</label>
                    <input type="text" class="form-control date" placeholder="DD/MM/YYYY" name="purchase_date" id="purchase_date" autocomplete="off" data-provide="datepicker-inline">
                </div>
                <!-- /.col -->

                <div class="col-md-2 form-group required">
                    <label class="control-label">Entry Date</label>
                    <input type="text" class="form-control date" placeholder="DD/MM/YYYY" name="entry_date" id="entry_date" autocomplete="off" data-provide="datepicker-inline" value="{{date('d-m-Y')}}">
                </div>
                <!-- /.col -->                
                <div class="col-md-2">
                    <label>Editor</label>
                    <input type="text" class="form-control" name="editor" id="editor">
                </div>
                <!-- /.col -->                
            </div>
            <!-- /.row -->

            <hr>

            <div class="row form-group ">                
                <div class="col-md-3">
                    <label class="control-label">First Author's First Name</label>
                    <input type="text" class="form-control" name="auth1_first_name" id="auth1_first_name">
                </div>
                <!-- /.col -->
                <div class="col-md-3">
                    <label class="control-label">First Author's Last Name</label>
                    <input type="text" class="form-control" name="auth1_last_name" id="auth1_last_name">
                </div>
                <!-- /.col -->
                <div class="col-md-3 from-group">
                    <label>Second Author's First Name</label>
                    <input type="text" class="form-control" name="auth2_first_name" id="auth2_first_name">
                </div>
                <!-- /.col -->
                <div class="col-md-3 from-group">
                    <label>Second Author's Last Name</label>
                    <input type="text" class="form-control" name="auth2_last_name" id="auth2_last_name">
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <hr>

            <div class="row">                
                <div class="col-md-3 form-group ">
                    <label class="control-label">Publisher</label>
                    <select class="form-control select2" name="publisher" id="publisher">
                        <option value="">Select One Option. . . </option>
                        @foreach($data['publishers_data'] as $data1)
                        <option value="{{$data1['PUBCODE']}}">{{$data1['PUBCODE']}} - {{$data1['PUBNAME']}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- /.col -->

                <div class="col-md-2 form-group">
                    <label class="control-label">Supplier</label>
                    <select class="form-control select2" name="supplier" id="supplier">
                        <option value="">Select One Option. . . </option>
                        @foreach($data['suppliers_data'] as $data1)
                        <option value="{{$data1['SUPPLIER_CODE']}}">{{$data1['SUPPLIER_CODE']}} - {{$data1['SUPPLIER_NAME']}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- /.col -->

                <div class="col-md-3">
                    <label>Location</label>
                    <select class="form-control select2" name="location" id="location">
                        <option value="">Select One Option. . . </option>
                        @foreach($data['location_data'] as $data2)
                        <option value="{{$data2['LOCCD']}}">{{$data2['LOCCD']}} - {{$data2['LOCNAME']}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- /.col -->

                <div class="col-md-2 form-group required">
                    <label class="control-label">Subject</label>
                    <select class="form-control select2" name="subject" id="subject">
                        <option value="">Select One Option. . . </option>
                        @foreach($data['subject_data'] as $data3)
                        <option value="{{$data3['SUBNO']}}">{{$data3['SUBNO']}} - {{$data3['SUBNAME']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label>Reference</label>
                    <select class="form-control select2" name="reference" id="reference">
                        <option value="">Select One Option. . . </option>
                        @foreach($data['subject_data'] as $data3)
                        <option value="{{$data3['SUBNO']}}">{{$data3['SUBNO']}} - {{$data3['SUBNAME']}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <hr>

            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <button type="button" class="form-control btn btn-success" id="update">UPDATE
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.data div -->

    </div>
    <!-- /.box-body -->
    @endsection

    <script src="{{asset('js/jquery/jquery.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            $(".date").datepicker({
                endDate:'0',
                format: 'dd-mm-yyyy'
            }); // Date picker initialization

            $(".select2").select2({
                width: '100%'
            }); // Select-2 initialization

            // Adding event on the ENTER Key
            $("input").keypress(function(e){
                if(e.which==13)
                    $("#get_data").click();
            })

            // To reset the page
            $(document).on("click", "#reset", function() {
                location.reload('true');
            })

            // To fetch data
            $(document).on("click", "#get_data", function() {
                var accession_no = $("#access_no").val();

                if (accession_no == "") {
                    swal("Insert Accession No.", "", "error");
                    return false;
                }

                $("#access_no").attr("disabled", "disabled");
                $("#reset").show();
                $("#get_data").hide();

                $.ajax({
                    type: "GET",
                    url: "books/" + accession_no,
                    data: {
                        id: accession_no
                    },
                    success: function(response) {
                        var obj = $.parseJSON(response);

                        if (obj['book_count'] == 0) 
                        {
                            swal("Invalid Accession No.", "", "error");
                            return false;
                        } 
                        else 
                        {
                            $("#library_no").val(obj['book']['0'].LIBNO);
                            $("#volume_no").val(obj['book']['0'].VOLNO);
                            $("#part_no").val(obj['book']['0'].PARTNO);
                            $("#edition_no").val(obj['book']['0'].EDENO);
                            $("#edition_year_1").val(obj['book']['0'].YEAR);
                            $("#edition_year_2").val(obj['book']['0'].YEAR1);
                            $("#total_page").val(obj['book']['0'].PAGE);
                            $("#content").val(obj['book']['0'].CONTENT);
                            $("#price").val(obj['book']['0'].PRICE);
                            $("#copy_no").val(obj['book']['0'].COPY_NO);
                            $("#first_name").val(obj['book']['0'].AUFNAME1);
                            $("#last_name").val(obj['book']['0'].AUSNAME1);
                            $("#editor").val(obj['book']['0'].EDINAME);
                            $("#purchase_date").val(obj['book']['0'].DTPUR);
                            $("#entry_date").val(obj['book']['0'].ENTRY_DATE);
                            $("#auth1_first_name").val(obj['book']['0'].AUFNAME1);
                            $("#auth1_last_name").val(obj['book']['0'].AUSNAME1);
                            $("#auth2_first_name").val(obj['book']['0'].AUFNAME2);
                            $("#auth2_last_name").val(obj['book']['0'].AUSNAME2);
                            
                            if(obj['book']['0'].TIT_CODE!=null){
                                $("#title").val(obj['book']['0'].TIT_CODE);
                                $("#title").trigger('change');
                            }
                            else{
                                var option = '<option value="" selected>' + obj['book']['0'].TITLE;
                                $("#title").prepend(option);
                            }

                            $("#type").val(obj['book']['0'].TYPE);
                            $("#type").trigger('change');

                            $("#publisher").val(obj['book']['0'].PUBCODE);
                            $("#publisher").trigger('change');

                            $("#supplier").val(obj['book']['0'].SUPPLIER_CODE);
                            $("#supplier").trigger('change');

                            if(obj['book']['0'].LOCNO != null || obj['book']['0'].LOCNO != ''){
                                $("#location").val(obj['book']['0'].LOCNO);
                                $("#location").trigger('change');
                            }

                            $("#subject").val(obj['book']['0'].SUB1);
                            $("#subject").trigger('change');

                            if (obj['book']['0'].SUB2 != null || obj['book']['0'].SUB2 != '') 
                            {
                                $("#reference").val(obj['book']['0'].SUB2);
                                $("#reference").trigger('change');
                            }

                        }

                        $("#data").show();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal("Server Error", "", "error");
                    }
                })

                
                // To update data
                $(document).on("click", "#update", function() {
                    var accession_no = $("#access_no").val();
                    var library_no = $("#library_no").val();
                    var title_code = $("#title option:selected").val();
                    var title = $("#title option:selected").text();
                    var new_title = $("#title_new").val();
                    var volume_no = $("#volume_no").val();
                    var part_no = $("#part_no").val();
                    var edition_no = $("#edition_no").val();
                    var edition_year_1 = $("#edition_year_1").val();
                    var edition_year_2 = $("#edition_year_2").val();
                    var total_page = $("#total_page").val();
                    var price = $("#price").val();
                    var copy_no = $("#copy_no").val();
                    var auth1_first_name = $("#auth1_first_name").val();
                    var auth1_last_name = $("#auth1_last_name").val();
                    var auth2_first_name = $("#auth2_first_name").val();
                    var auth2_last_name = $("#auth2_last_name").val();
                    var editor = $("#editor").val();
                    var purchase_date = $("#purchase_date").val();
                    var entry_date = $("#entry_date").val();
                    var type = $("#type option:selected").val();
                    var publisher = $("#publisher option:selected").val();
                    var supplier = $("#supplier option:selected").val();
                    var location = $("#location option:selected").val();
                    var subject = $("#subject option:selected").val();
                    var reference = $("#reference option:selected").val();
                    var content = $("#content").val();

                    $.ajax({
                        type: "PUT",
                        url: "books/" + accession_no,
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            accession_no: accession_no,
                            library_no: library_no,
                            title_code: title_code,
                            title: title,
                            volume_no: volume_no,
                            part_no: part_no,
                            edition_no: edition_no,
                            edition_year_1: edition_year_1,
                            edition_year_2: edition_year_2,
                            total_page: total_page,
                            price: price,
                            copy_no: copy_no,
                            first_author_first_name: auth1_first_name,
                            first_author_last_name: auth1_last_name,
                            second_author_first_name: auth2_first_name,
                            second_author_last_name: auth2_last_name,
                            editor: editor,
                            purchase_date: purchase_date,
                            entry_date: entry_date,
                            type: type,
                            publisher: publisher,
                            location: location,
                            supplier: supplier,
                            subject: subject,
                            reference: reference,
                            content:content
                        },
                        success: function(response) {
                            swal("Book Updated Successfully", "", "success");
                        },
                        error: function(response) {
                            if(response.responseJSON.errors.hasOwnProperty('subject'))
                                 swal("Cannot Insert Book", response.responseJSON.errors.subject['0'], "error");
                            if(response.responseJSON.errors.hasOwnProperty('publisher'))
                                 swal("Cannot Insert Book", response.responseJSON.errors.publisher['0'], "error");                            
                            if(response.responseJSON.errors.hasOwnProperty('entry_date'))
                                 swal("Cannot Insert Book", response.responseJSON.errors.entry_date['0'], "error");
                            if(response.responseJSON.errors.hasOwnProperty('type'))
                                 swal("Cannot Insert Book", response.responseJSON.errors.type['0'], "error");                                 
                            if(response.responseJSON.errors.hasOwnProperty('title_code'))
                                 swal("Cannot Insert Book", response.responseJSON.errors.title_code['0'], "error");                                 
                            if(response.responseJSON.errors.hasOwnProperty('library_no'))
                                 swal("Cannot Insert Book", response.responseJSON.errors.library_no['0'], "error");
                            if(response.responseJSON.errors.hasOwnProperty('new_title'))
                                 swal("Cannot Insert Book", response.responseJSON.errors.new_title['0'], "error");
                            if(response.responseJSON.errors.hasOwnProperty('first_author_first_name'))
                                 swal("Cannot Insert Book", response.responseJSON.errors.first_author_first_name['0'], "error");
                            if(response.responseJSON.errors.hasOwnProperty('first_author_last_name'))
                                 swal("Cannot Insert Book", response.responseJSON.errors.first_author_last_name['0'], "error");
                            if(response.responseJSON.errors.hasOwnProperty('purchase_date'))
                                 swal("Cannot Insert Book", response.responseJSON.errors.purchase_date['0'], "error");
                            if(response.responseJSON.errors.hasOwnProperty('edition_year_1'))
                                 swal("Cannot Insert Book", response.responseJSON.errors.edition_year_1['0'], "error");
                            if(response.responseJSON.errors.hasOwnProperty('edition_year_2'))
                                 swal("Cannot Insert Book", response.responseJSON.errors.edition_year_2['0'], "error");
                            if(response.responseJSON.errors.hasOwnProperty('price'))
                                 swal("Cannot Insert Book", response.responseJSON.errors.price['0'], "error");
                            if(response.responseJSON.errors.hasOwnProperty('edition_no'))
                                 swal("Cannot Insert Book", response.responseJSON.errors.edition_no['0'], "error");
                            if(response.responseJSON.errors.hasOwnProperty('total_page'))
                                 swal("Cannot Insert Book", response.responseJSON.errors.total_page['0'], "error");
                            if(response.responseJSON.errors.hasOwnProperty('price'))
                                 swal("Cannot Insert Book", response.responseJSON.errors.price['0'], "error");
                            if(response.responseJSON.errors.hasOwnProperty('copy_no'))
                                 swal("Cannot Insert Book", response.responseJSON.errors.copy_no['0'], "error");
                            
                        }
                    })
                })

            })
        });
    </script>

    </body>

    </html>