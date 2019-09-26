@extends('layouts.app') @section('content')
<!-- Main content -->
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Search Window </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label>Accession No.</label>
                    <input type="number" class="form-control" name="access_no" id="access_no">
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-3">
                <div class="form-group">
                    <label>Author Name</label>
                    <input class="form-control" name="author" id="author">
                </div>
            </div>
            <!-- /.col -->

            <div class="col-md-3">
                <div class="form-group">
                    <label>Title</label>
                    <input class="form-control" name="title" id="title">
                </div>
            </div>
            <!-- /.col -->

            <div class="col-md-3">
                <div class="form-group">
                    <label>Type</label>
                    <select class="form-control select2" name="type" id="type">
                        <option value="">Select One Option </option>
                        <option value="B">Book</option>
                        <option value="J">Journal</option>
                        <option value="A">Bare Act</option>
                        <option value="P">Periodical</option>
                    </select>
                </div>
            </div>
            <!-- /.col -->
            <br/>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="discard">
                <label class="form-check-label" for="discard">
                  Discard
                </label>
            </div>

        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Library No.</label>
                    <input type="text" class="form-control" name="lib_no" id="lib_no" onkeyup="this.value = this.value.toUpperCase();">
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-3">
                <div class="form-group">
                    <label>Publisher Name</label>
                    <select class="form-control select2" name="pub_name" id="pub_name">
                        <option value="">Select One Option. . . </option>
                        @foreach($data['publisher'] as $publisher)                    
                            <option value="{{$publisher['PUBCODE']}}">{{$publisher['PUBCODE']}} | {{$publisher['PUBNAME']}}</option>
                        @endforeach  
                    </select>
                </div>
            </div>
            <!-- /.col -->

            <div class="col-md-3">
                <label>Subject</label>
                <select class="form-control select2" name="subject" id="subject">
                    <option value="">Select One Option. . . </option>
                    @foreach($data['subject'] as $subject)                    
                        <option value="{{$subject['SUBNO']}}">{{$subject['SUBNO']}} | {{$subject['SUBNAME']}}</option>
                    @endforeach 
                </select>
            </div>
            <!-- /.col -->

            <div class="col-md-3">
                <div class="form-group">
                    <label>Editor</label>
                    <input type="text" class="form-control" name="editor" id="editor">
                </div>
            </div>
            <!-- /.col -->

            <!-- /.row -->
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label>Edition No.</label>
                    <input type="text" class="form-control" name="edition_no" id="edition_no">
                </div>
            </div>
            <!-- /.col -->

            <div class="col-md-2">
                <div class="form-group">
                    <label>Edition Year</label>
                    <input type="text" class="form-control" name="year" id="year">
                </div>
            </div>
            <!-- /.col -->

            <div class="col-md-3 form-group">
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
                <div class="form-group">
                    <label>Location</label>
                    <select class="form-control select2" name="loc_name" id="loc_name">
                        <option value="">Select One Option. . . </option>
                        @foreach($data['location'] as $loc)                    
                            <option value="{{$loc['LOCCD']}}">{{$loc['LOCCD']}} | {{$loc['LOCNAME']}}</option>
                        @endforeach  
                    </select>
                </div>
            </div>
            <!-- /.col -->

            <div class="col-md-2 form-group">
                <label class="control-label">Content</label>
                <textarea class="form-control" id="content" rows="3"></textarea>
            </div>
            <!-- /.col -->

        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Purchase Date In A Range</label>
                    <input type="text" class="form-control date_range" name="purchase_date" id="purchase_date">
                </div>
            </div>
            <!-- /.col -->

            
            <div class="col-md-3">
                <div class="form-group">
                    <label>Entry Date In A Range</label>
                    <input type="text" class="form-control date_range" name="entry_date" id="entry_date">
                </div>
            </div>
            <!-- /.col -->        

            <div class="col-md-2">
                <div class="form-group">
                    <label>Arrange Result By</label>
                    <select class="form-control select2" name="order_by" id="order_by">                        
                        <option value="ACCESSNO">Accession No</option> 
                        <option value="LIBNO">Library No</option>
                        <option value="VOLNO">Volume No</option>
                        <option value="EDENO">Edition No</option>
                        <option value="YEAR">Edition Year</option>                
                    </select>
                </div>
            </div>
            <!-- /.col -->
            
            <div class="col-md-2">
                <br>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input order_type" name="order_type" id="order_type" value="ASC" checked>
                    <label>Ascending Order</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input order_type" name="order_type" id="order_type" value="DESC">                    
                    <label>Descending Order</label>                    
                </div>
            </div>
            <!-- /.col -->

            <div class="col-md-2">
                <button type="button" class="button btn-success btn-lg" style="margin-top:15px" id="search">SEARCH
                <button type="button" class="button btn-danger btn-lg" style="margin-top:15px" id="reset">RESET
            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.box-body -->

</div>
 <!-- /.box-->

 <!--loader starts-->
 <div class="row">
    <div class="col-md-5"></div>
    <div class="col-md-3" id="wait" style="display:none;">
        <img src="{{asset('images/Preloader_3.gif')}}">
    </div>
</div>
<!--loader starts-->

    <div class="box box-default" id="search_result" style="display:none">
        <div class="box-header with-border">
            <h3 class="box-title">Search Result</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="srollable" style="overflow:auto;">
                <table class="table table-striped table-bordered table-responsive" style="white-space: nowrap" id="search_result_data">
                        <thead>
                            <tr>
                                <th>Current Book Status</th>                             
                                <th>Accession No.</th>
                                <th>Issued To</th>
                                <th>Issue Date</th> 
                                <th>Previously Issued To</th>                                                               
                                <th>Library No.</th>
                                <th>Type</th>
                                <th>Book Title</th>
                                <th>Publisher</th>
                                <th>Supplier</th>
                                <th>Subject</th>
                                <th>Editor</th>
                                <th>First Author Name</th>
                                <th>Second Author Name</th>
                                <th>Volume No.</th>
                                <th>Edition No.</th>
                                <th>Edition Year </th>
                                <th>Price (INR)</th>
                                <th>Purchase Date</th>
                                <th>Copy No.</th>
                                <th>Content</th>
                            </tr>
                        </thead>                               
                </table>
            </div>
        </div>
    </div>
    
    
    @endsection

    <script src="{{asset('js/jquery/jquery.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            $(".date").datepicker(); // Date picker initialization            
            $(".select2").select2(); // Select-2 initialization           

            // For Purchase Date Range Picker :: STARTS
            var purchase_from_date;
            var purchase_to_date;
            $("#purchase_date").daterangepicker({
                    opens: 'left',
                    autoUpdateInput: false,
                    endDate:moment(),
                    maxDate:moment(),
                    locale: {
                        format: 'DD/MM/YYYY',
                        cancelLabel: 'Clear'
                    }
                }, function(start, end, label) {
                    purchase_from_date = start.format('YYYY-MM-DD');
                    purchase_to_date = end.format('YYYY-MM-DD');
            });

            $("#purchase_date").on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
            });

            $("#purchase_date").on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });            
            // For Purchase Date Range Picker :: ENDS
            
            // For Issue Date Range Picker :: STARTS
            var issue_from_date;
            var issue_to_date;
            $("#issue_date").daterangepicker({
                    opens: 'left',
                    autoUpdateInput: false,
                    endDate:moment(),
                    maxDate:moment(),
                    locale: {
                        format: 'DD/MM/YYYY',
                        cancelLabel: 'Clear'
                    }
                }, function(start, end, label) {
                    issue_from_date = start.format('YYYY-MM-DD');
                    issue_to_date = end.format('YYYY-MM-DD');
            });

            $("#issue_date").on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
            });

            $("#issue_date").on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });            
            // For Issue Date Range Picker :: ENDS


            // For Return Date Range Picker :: STARTS
            var return_from_date;
            var return_to_date;
            $("#return_date").daterangepicker({
                    opens: 'left',
                    autoUpdateInput: false,
                    endDate:moment(),
                    maxDate:moment(),
                    locale: {
                        format: 'DD/MM/YYYY',
                        cancelLabel: 'Clear'
                    }
                }, function(start, end, label) {
                    return_from_date = start.format('YYYY-MM-DD');
                    return_to_date = end.format('YYYY-MM-DD');
            });

            $("#return_date").on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
            });

            $("#return_date").on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });            
            // For Issue Date Range Picker :: ENDS
            
            // For Entry Date Range Picker :: STARTS
            var entry_from_date;
            var entry_to_date;
            $("#entry_date").daterangepicker({
                    opens: 'left',
                    autoUpdateInput: false,
                    endDate:moment(),
                    maxDate:moment(),
                    locale: {
                        format: 'DD/MM/YYYY',
                        cancelLabel: 'Clear'
                    }
                }, function(start, end, label) {
                    entry_from_date = start.format('YYYY-MM-DD');
                    entry_to_date = end.format('YYYY-MM-DD');
            });

            $("#entry_date").on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
            });

            $("#entry_date").on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });            
            // For Entry Date Range Picker :: ENDS

            /*LOADER*/
            $(document).ajaxStart(function() {
                $("#wait").css("display", "block");
            });
            
            $(document).ajaxComplete(function() {
                $("#wait").css("display", "none");
            });
            /*LOADER*/


            // Reset Code:: STARTS
            $(document).on("click","#reset", function(){
                window.location.reload('true');
            })
            // Reset Code:: ENDS

            
            // Searching Code :: STARTS
            $(document).on("click","#search", function(){
                var accession_no = $("#access_no").val();
                var author_name = $("#author").val();
                var title = $("#title").val();
                var type = $("#type option:selected").val();
                var loc_name = $("#loc_name option:selected").val();
                var discard = $("#discard").is(":checked");
                var lib_no = $("#lib_no").val();
                var editor = $("#editor").val();
                var pub_name = $("#pub_name option:selected").val();
                var supplier = $("#supplier option:selected").val();
                var subject = $("#subject option:selected").val();
                var edition_no = $("#edition_no").val();
                var edition_year = $("#year").val();
                var content = $("#content").val();                
                var order_by = $("#order_by option:selected").val();
                var order_type = $("input[name='order_type']:checked").val();

                var d = new Date();
                var month = d.getMonth()+1;
                var day = d.getDate();

                var current_date = (day<10 ? '0' : '') + day + '-' +
                             (month<10 ? '0' : '') + month + '-' + 
                              d.getFullYear() ;

                $('#search_result_data').DataTable().destroy();

                // Datatable Code For Showing Data :: START
                var table = $("#search_result_data").DataTable({                 
                "processing": true,
                "searching": false,
                "pageLength": "10",
                "serverSide": true,
                "ajax":{
                        "url": "search/search",
                        "dataType": "json",
                        "type": "POST",
                        "data":{
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            accession_no:accession_no,
                            author_name:author_name,
                            title:title,
                            type:type,
                            discard:discard,
                            lib_no:lib_no,
                            editor:editor,
                            pub_name:pub_name,
                            supplier:supplier,
                            subject:subject,
                            edition_no:edition_no,
                            edition_year:edition_year,
                            content:content,
                            loc_name:loc_name,
                            purchase_from_date:purchase_from_date,
                            purchase_to_date:purchase_to_date,                            
                            entry_from_date:entry_from_date,
                            entry_to_date:entry_to_date,
                            order_by:order_by,
                            order_type:order_type                            
                        }
                },

                "initComplete":function( settings, json){
                    $("#search_result").show(); // showing the div containing the table
                    $('html, body').animate({
                        scrollTop:$(document).height()
                    }, 'slow'); // Moving scrollbar to the bottom
                },

                    "columns": [                
                        {"data": "Book Status"},
                        {"data": "Accession No",
                         "class":"access_no"},
                        {"data": "Issued To"},
                        {"data": "Issue Date"},
                        {"data": "Previously Issued To"},                        
                        {"data": "Library No"},
                        {"data": "Type"},
                        {"data": "Book Title"},
                        {"data": "Publisher"},
                        {"data": "Supplier"},
                        {"data": "Subject"},
                        {"data": "Editor"},
                        {"data": "First Author Name"},
                        {"data": "Second Author Name"},
                        {"data": "Volume No"},
                        {"data": "Edition No"},
                        {"data": "Edition Year"},
                        {"data": "Price (INR)"},
                        {"data": "Purchase Date"},
                        {"data": "Copy No"}, 
                        {"data": "Content"}                       
                    ],
                    'lengthMenu': [ [10, 25, 50, -1], [10, 25, 50, 'All'] ], 
                    dom: 'Blfrtip',
                    buttons: [                        
                        {
                            extend: 'excelHtml5',
                            extension: '.xls',
                            exportOptions: {
                                columns: ':visible'
                            },
                            title: 'Judges\' Library, Calcutta High Court',
                            messageTop: 'Report Generated From Library Information System',
                            messageBottom: 'Printed On '+current_date,                            
                        },
                        {
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            exportOptions: {
                                columns: ':visible'
                            },
                            title: 'Judges\' Library, Calcutta High Court',
                            messageTop: 'Report Generated From Library Information System',
                            messageBottom: 'Printed On '+current_date,
                            customize: function(doc) {
                                doc.content[1].margin = [ 355, 0, 0, 20 ] //left, top, right, bottom                                
                                doc.content[3].margin = [ 0, 100, 0, 0 ] //left, top, right, bottom
                            }
                        },
                        'colvis'
                    ],
                    columnDefs: [{
                        targets: -1,
                        visible: false
                    }]                    
                }); 
                // DataTable initialization with Server-Processing ::END
               
            });
            
            // Searching Code :: ENDS

            // Fetching details of Issued To data of the Not Available books
            $(document).on("click",".not_available", function(){
                var access_no = $(this).closest("tr").find(".access_no").text();
                var obj;
                
                $.ajax({
                    type:"POST",
                    url:"search/search/issued_to",
                    data:{
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        accessno:access_no
                    },
                    success:function(response){
                        obj = $.parseJSON(response);
                    },
                    async: false                     
                })
                var tr = $(this).closest('tr');
                var row = $("#search_result_data").DataTable().row( tr );

                if ( row.child.isShown() ) {
                    row.child.hide();
                }
                else {
                    row.child('<table><tr><td><b>Book Issued To: '+obj['UFNAME']+' '+obj['USNAME']+'</b></td></tr><tr><td><b>Issued Date: '+obj['DTISS']+'</b></td></tr></table>').show();
                }
            })
        });
    </script>

    </body>

    </html>