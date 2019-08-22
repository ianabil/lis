@extends('layouts.app') @section('content')
<!-- Main content -->
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Book / Journal / Bare Act Entry</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group required">
                        <label class="control-label">Library No.</label>
                        <input type="text" class="form-control" name="library_no" id="library_no">
                    </div>
                </div>
                <!-- /.col -->

                <div class="col-md-2" id="existing_title_div">
                    <div class="form-group required">
                        <label class="control-label">Title</label>
                        <br>
                        <select class="form-control select2" name="title" id="title">
                            <option value="">Select One Option. . . </option>
                            <option value="other">Other</option>
                            @foreach($data['title_data'] as $data_title)
                            <option value="{{$data_title['TIT_CODE']}}">{{$data_title['TIT_DESC']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- /.col -->

                <div class="col-md-2 form-group required" style="display:none" id="new_title_div">
                    <label class="control-label">Title</label>
                    <input type="text" class="form-control" name="new_title" id="title_new">
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

                <div class="col-md-3 form-group">
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
                    <label>Author's First Name</label>
                    <input type="text" class="form-control" name="first_name" id="first_name">
                </div>
                <!-- /.col -->

                <div class="col-md-2">
                    <label>Author's Last Name</label>
                    <input type="text" class="form-control" name="last_name" id="last_name">
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <hr>

            <div class="row">

                <div class="col-md-2">
                    <label>Editor</label>
                    <input type="text" class="form-control" name="editor" id="editor">
                </div>
                <!-- /.col -->

                <div class="col-md-3 form-group required">
                    <label class="control-label">Publisher</label>
                    <select class="form-control select2" name="publisher" id="publisher">
                        <option value="">Select One Option. . . </option>
                        @foreach($data['publishers_data'] as $data1)
                        <option value="{{$data1['PUBCODE']}}">{{$data1['PUBNAME']}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- /.col -->

                <div class="col-md-3">
                    <label>Location</label>
                    <select class="form-control select2" name="location" id="location">
                        <option value="">Select One Option. . . </option>
                        @foreach($data['location_data'] as $data2)
                        <option value="{{$data2['LOCCD']}}">{{$data2['LOCNAME']}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- /.col -->

                <div class="col-md-2 form-group required">
                    <label class="control-label">Subject</label>
                    <select class="form-control select2" name="subject" id="subject">
                        <option value="">Select One Option. . . </option>
                        @foreach($data['subject_data'] as $data3)
                        <option value="{{$data3['SUBNO']}}">{{$data3['SUBNAME']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label>Reference</label>
                    <select class="form-control select2" name="reference" id="reference">
                        <option value="">Select One Option. . . </option>
                        @foreach($data['subject_data'] as $data3)
                        <option value="{{$data3['SUBNO']}}">{{$data3['SUBNAME']}}</option>
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
                    <button type="button" class="form-control btn btn-success" id="submit">SUBMIT
                </div>
            </div>
            <!-- /.row -->
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
            
            $(".select2").select2({width: '100%'}); // Select-2 initialization

            var flag='existing_title'; // Global variable for title

            // To let user insert a new title
            $(document).on("change","#title", function(){
                var title_code = $("#title option:selected").val();

                if(title_code=='other'){
                    flag = 'new_title';
                    $("#new_title_div").show();
                    $("#existing_title_div").hide();
                }
            })

            $(document).on("click","#submit", function(){
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
                    var first_name = $("#first_name").val();
                    var last_name = $("#last_name").val();
                    var editor = $("#editor").val();
                    var purchase_date = $("#purchase_date").val();
                    var entry_date = $("#entry_date").val();
                    var type = $("#type option:selected").val();
                    var publisher = $("#publisher option:selected").val();
                    var location = $("#location option:selected").val();
                    var subject = $("#subject option:selected").val();
                    var reference = $("#reference option:selected").val();
                    var content = $("#content").text();

                    $.ajax({
                        type: "POST",
                        url: "books",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            library_no: library_no,
                            title_code: title_code,
                            title: title,
                            new_title:new_title,
                            flag:flag,
                            volume_no: volume_no,
                            part_no: part_no,
                            edition_no: edition_no,
                            edition_year_1: edition_year_1,
                            edition_year_2: edition_year_2,
                            total_page: total_page,
                            price: price,
                            copy_no: copy_no,
                            first_name: first_name,
                            last_name: last_name,
                            editor: editor,
                            purchase_date: purchase_date,
                            entry_date: entry_date,
                            type: type,
                            publisher: publisher,
                            location: location,
                            subject: subject,
                            reference: reference,
                            content:content
                        },
                        success: function(response) {
                            var obj = $.parseJSON(response);
                            console.log(obj);
                            swal("Book Inserted Successfully", "Accession No. "+obj['accession_no'], "success");
                            if(obj['title_code']!='NA'){
                                var data = {
                                    id: obj['title_code'],
                                    text: $("#title_new").val()
                                };

                                var newOption = new Option(data.text, data.id, true, true);
                                $('#title').append(newOption).trigger('change');
                                flag='existing_title';
                            }
                            else{
                                $('#title').val('');
                                $('#title').trigger('change');
                            }
                            
                             $("#library_no").val('');
                             $("#copy_no").val('');
                             $("#new_title_div").hide();
                             $("#existing_title_div").show();
                             $("#title_new").val('');                            
                        },
                        error: function(response) {
                            if(response.responseJSON.errors.hasOwnProperty('subject'))
                                 swal("Cannot Insert Book", "Subject field can not be empty", "error");
                            if(response.responseJSON.errors.hasOwnProperty('publisher'))
                                 swal("Cannot Insert Book", "Publisher Name field can not be empty", "error");                            
                            if(response.responseJSON.errors.hasOwnProperty('entry_date'))
                                 swal("Cannot Insert Book", "Book's Entry Date field can not be empty", "error");
                            if(response.responseJSON.errors.hasOwnProperty('type'))
                                 swal("Cannot Insert Book", "Book Type field can not be empty", "error");                                 
                            if(response.responseJSON.errors.hasOwnProperty('title_code'))
                                 swal("Cannot Insert Book", "Title field can not be empty", "error");                                 
                            if(response.responseJSON.errors.hasOwnProperty('library_no'))
                                 swal("Cannot Insert Book", "Library No. field can not be empty", "error");
                            
                        }
                    })

            })

        });
    </script>

    </body>

    </html>