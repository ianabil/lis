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
            <div class="col-md-3">
                <div class="form-group">
                    <label>Accession No.</label>
                    <input type="text" class="form-control" name="access_no" id="access_no" placeholder="Complete / Partial Accession No.">
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-4">
                <div class="form-group">
                    <label>Author Name</label>
                    <select class="form-control select2" name="author" id="author">
                        <option value="">Select One Option. . . </option>
                        @foreach($data['first_author_name'] as $first_author_name)                    
                            <option value="{{$first_author_name['AUFNAME1']}}-{{$first_author_name['AUSNAME1']}}">{{$first_author_name['AUFNAME1']}} {{$first_author_name['AUSNAME1']}}</option>
                        @endforeach  
                        @foreach($data['second_author_name'] as $second_author_name)                    
                            <option value="{{$second_author_name['AUFNAME2']}}-{{$second_author_name['AUSNAME2']}}">{{$second_author_name['AUFNAME2']}} {{$second_author_name['AUSNAME2']}}</option>
                        @endforeach  
                    </select>
                </div>
            </div>
            <!-- /.col -->

            <div class="col-md-4">
                <div class="form-group">
                    <label>Title</label>
                    <select class="form-control select2" name="title" id="title">
                        <option value="">Select One Option. . . </option>
                        @foreach($data['book_title'] as $title)                    
                            <option value="{{$title['TIT_CODE']}}">{{$title['TIT_DESC']}}</option>
                        @endforeach  
                    </select>
                </div>
            </div>
            <!-- /.col -->
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Library No.</label>
                    <input type="text" class="form-control" name="lib_no" id="lib_no">
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-4">
                <div class="form-group">
                    <label>Publisher Name</label>
                    <select class="form-control select2" name="pub_name" id="pub_name">
                        <option value="">Select One Option. . . </option>
                        @foreach($data['publisher'] as $publisher)                    
                            <option value="{{$publisher['PUBCODE']}}">{{$publisher['PUBNAME']}}</option>
                        @endforeach  
                    </select>
                </div>
            </div>
            <!-- /.col -->

            <div class="col-md-4">
                <label>Subject</label>
                <select class="form-control select2" name="subject" id="subject">
                    <option value="">Select One Option. . . </option>
                    @foreach($data['subject'] as $subject)                    
                        <option value="{{$subject['SUBNO']}}">{{$subject['SUBNAME']}}</option>
                    @endforeach 
                </select>
            </div>
            <!-- /.col -->

            <!-- /.row -->
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Edition No.</label>
                    <input type="text" class="form-control" name="edition_no" id="edition_no">
                </div>
            </div>
            <!-- /.col -->

            <div class="col-md-3">
                <div class="form-group">
                    <label>Edition Year</label>
                    <input type="text" class="form-control" name="year" id="year">
                </div>
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
                    <label>Issue Date In A Range</label>
                    <input type="text" class="form-control date_range" name="issue_date" id="issue_date">
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
        </div>
        <!-- /.row -->

        <div class="row" style="margin-top:15px">            
            <div class="col-md-3">
                <div class="form-group">
                    <label>Issued To</label>
                    <select class="form-control select2" name="member_name" id="member_name">
                        <option value="">Select One Option. . . </option>
                        @foreach($data['member'] as $member)                    
                            <option value="{{$member['USERNO']}}">{{$member['UFNAME']}} {{$member['USNAME']}}</option>
                        @endforeach 
                    </select>
                </div>
            </div>
            <!-- /.col -->

            <div class="col-md-3">
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

            <div class="col-md-3">
                <button type="button" class="button btn-success btn-lg" style="margin-top:15px" id="search">SEARCH
            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.box-body -->

</div>
 <!-- /.box-->

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
                                <th>Book Status</th>                             
                                <th>Accession No.</th>
                                <th>Issued To</th>
                                <th>Issue Date</th>                                
                                <th>Library No.</th>
                                <th>Type</th>
                                <th>Book Title</th>
                                <th>Publisher</th>
                                <th>First Author Name</th>
                                <th>Second Author Name</th>
                                <th>Volume No.</th>
                                <th>Edition No.</th>
                                <th>Edition Year </th>
                                <th>Price (INR)</th>
                                <th>Purchase Date</th>
                                <th>Copy No.</th>
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
            //$("#search_result_data").dataTable(); // DataTable Initialization

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

            
            // Searching Code :: STARTS
            $(document).on("click","#search", function(){
                var accession_no = $("#access_no").val();
                var author_name = $("#author option:selected").val();
                var title = $("#title option:selected").val();
                var lib_no = $("#lib_no").val();
                var pub_name = $("#pub_name option:selected").val();
                var subject = $("#subject option:selected").val();
                var edition_no = $("#edition_no").val();
                var edition_year = $("#year").val();
                var issue_to_member = $("#member_name").val();
                var order_by = $("#order_by option:selected").val();
                var order_type = $("input[name='order_type']:checked").val();

                $('#search_result_data').DataTable().destroy();
                // Datatable Code For Showing Data :: START
                var table = $("#search_result_data").DataTable({                 
                "processing": true,
                "searching": false,
                "pageLength": "10",
                "serverSide": true,
                "ajax":{
                        "url": "dashboard/search",
                        "dataType": "json",
                        "type": "POST",
                        "data":{
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            accession_no:accession_no,
                            author_name:author_name,
                            title:title,
                            lib_no:lib_no,
                            pub_name:pub_name,
                            subject:subject,
                            edition_no:edition_no,
                            edition_year:edition_year,
                            issue_to_member:issue_to_member,
                            purchase_from_date:purchase_from_date,
                            purchase_to_date:purchase_to_date,
                            issue_from_date:issue_from_date,
                            issue_to_date:issue_to_date,
                            entry_from_date:entry_from_date,
                            entry_to_date:entry_to_date,
                            order_by:order_by,
                            order_type:order_type                            
                        }
                    },

                    "columns": [                
                        {"data": "Book Status"},
                        {"data": "Accession No",
                         "class":"access_no"},
                        {"data": "Issued To"},
                        {"data": "Issue Date"},
                        {"data": "Library No"},
                        {"data": "Type"},
                        {"data": "Book Title"},
                        {"data": "Publisher"},
                        {"data": "First Author Name"},
                        {"data": "Second Author Name"},
                        {"data": "Volume No"},
                        {"data": "Edition No"},
                        {"data": "Edition Year"},
                        {"data": "Price (INR)"},
                        {"data": "Purchase Date"},
                        {"data": "Copy No"}                        
                    ],
                    'lengthMenu': [ [10, 25, 50, -1], [10, 25, 50, 'All'] ], 
                    dom: 'Blfrtip',
                    buttons: [                        
                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: ':visible'
                            },
                            title: 'Report Generated From Library Information System'
                        },
                        {
                            extend: 'pdf',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            exportOptions: {
                                columns: ':visible'
                            },
                            title: 'Report Generated From Library Information System'
                        },
                        'colvis'
                    ],
                    columnDefs: [{
                        targets: -1,
                        visible: false
                    }]                    
                }); 
                // DataTable initialization with Server-Processing ::END
                $("#search_result").show(); // showing the div containing the table
            });
            
            // Searching Code :: ENDS

            // Fetching details of Issued To data of the Not Available books
            $(document).on("click",".not_available", function(){
                var access_no = $(this).closest("tr").find(".access_no").text();
                var obj;
                
                $.ajax({
                    type:"POST",
                    url:"dashboard/search/issued_to",
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