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
                    <label>Issued To</label>
                    <select class="form-control select2" name="issue_to" id="issue_to">
                        <option value="">Select One Option. . . </option>
                        @foreach($data['member'] as $member)                    
                            <option value="{{$member['USERNO']}}">{{$member['USERNO']}} | {{$member['UFNAME']}} {{$member['USNAME']}}</option>
                        @endforeach 
                    </select>
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
                    <label>Return Date In A Range</label>
                    <input type="text" class="form-control date_range" name="return_date" id="return_date">
                </div>
            </div>
            <!-- /.col --> 
            
            <div class="col-md-3">
                <div class="form-group">
                    <label>Return From</label>
                    <select class="form-control select2" name="return_from" id="return_from">
                        <option value="">Select One Option. . . </option>
                        @foreach($data['member'] as $member)                    
                            <option value="{{$member['USERNO']}}">{{$member['USERNO']}} | {{$member['UFNAME']}} {{$member['USNAME']}}</option>
                        @endforeach 
                    </select>
                </div>
            </div>
            <!-- /.col -->
              
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-12 text-center">
                <button type="button" class="button btn-success btn-lg" style="margin-top:15px" id="search">SEARCH
                <button type="button" class="button btn-danger btn-lg" style="margin-top:15px" id="reset">RESET
            </div>    
        
        </div>
            
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

<div class="box box-default" id="issue_search_result" style="display:none">
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
            <table class="table table-striped table-bordered table-responsive" style="white-space: nowrap" id="issue_result_data">
                    <thead>
                        <tr>                            
                            <th>Accession No.</th>
                            <th>Library No.</th>
                            <th>Type</th>
                            <th>Book Title</th>
                            <th>Issued To</th>
                            <th>Issue Date</th>   
                            <th>Return Status</th>                             
                        </tr>
                    </thead>                               
            </table>
        </div>
    </div>
</div>

<div class="box box-default" id="return_search_result" style="display:none">
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
                <table class="table table-striped table-bordered table-responsive" style="white-space: nowrap" id="return_search_result_data">
                        <thead>
                            <tr>                            
                                <th>Accession No.</th>
                                <th>Library No.</th>
                                <th>Type</th>
                                <th>Book Title</th>
                                <th>Returned From</th>
                                <th>Issue Date</th>
                                <th>Return Date</th>                              
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
            $(".select2").select2();

            // For Issue Date Range Picker :: STARTS
            var issue_from_date="";
            var issue_to_date="";
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
            var return_from_date="";
            var return_to_date="";
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
                var issue_to = $("#issue_to").val();
                var return_from = $("#return_from").val();
               
                if(issue_from_date=="" && issue_to_date=="" && return_from_date=="" && return_to_date=="" && issue_to=="" && return_from==""){
                    return false;
                }
               
                var d = new Date();
                var month = d.getMonth()+1;
                var day = d.getDate();

                var current_date = (day<10 ? '0' : '') + day + '-' +
                             (month<10 ? '0' : '') + month + '-' + 
                              d.getFullYear();
                              
                if((issue_from_date!="" && issue_to_date!="") || issue_to!=""){
                    $('#issue_result_data').DataTable().destroy();

                    // Datatable Code For Showing Data :: START
                    var table = $("#issue_result_data").DataTable({                 
                    "processing": true,
                    "searching": false,
                    "pageLength": "10",
                    "serverSide": true,
                    "ajax":{
                            "url": "issue_search/issue_search",
                            "dataType": "json",
                            "type": "POST",
                            "data":{
                                _token: $('meta[name="csrf-token"]').attr('content'),                                
                                issue_to:issue_to,                                
                                issue_from_date:issue_from_date,
                                issue_to_date:issue_to_date                      
                            }
                    },

                    "initComplete":function( settings, json){
                        $("#issue_search_result").show(); // showing the div containing the table
                        $('html, body').animate({
                            scrollTop:$(document).height()
                        }, 'slow'); // Moving scrollbar to the bottom
                    },

                        "columns": [ 
                            {"data": "Accession No"},
                            {"data": "Library No"},
                            {"data": "Type"},
                            {"data": "Book Title"},
                            {"data": "Issued To"},
                            {"data": "Issue Date"},
                            {"data": "Return Status"},                   
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
                                    doc.content[2].margin = [ 120, 0, 0, 20 ] //left, top, right, bottom  
                                    doc.content[3].margin = [ 0, 100, 0, 0 ] //left, top, right, bottom
                                }
                            }
                        ],                                        
                    }); 
                    // DataTable initialization with Server-Processing ::END
                }
                else if((return_from_date!="" && return_to_date!="") || return_from!=""){
                    $('#return_search_result_data').DataTable().destroy();

                    // Datatable Code For Showing Data :: START
                    var table = $("#return_search_result_data").DataTable({                 
                    "processing": true,
                    "searching": false,
                    "pageLength": "10",
                    "serverSide": true,
                    "ajax":{
                            "url": "return_search/return_search",
                            "dataType": "json",
                            "type": "POST",
                            "data":{
                                _token: $('meta[name="csrf-token"]').attr('content'),                                
                                return_from:return_from,                                
                                return_from_date:return_from_date,
                                return_to_date:return_to_date                      
                            }
                    },

                    "initComplete":function( settings, json){
                        $("#return_search_result").show(); // showing the div containing the table
                        $('html, body').animate({
                            scrollTop:$(document).height()
                        }, 'slow'); // Moving scrollbar to the bottom
                    },

                    "columns": [ 
                        {"data": "Accession No"},
                        {"data": "Library No"},
                        {"data": "Type"},
                        {"data": "Book Title"},
                        {"data": "Return From"},
                        {"data": "Issue Date"},
                        {"data": "Return Date"},            
                    ],
                    'lengthMenu': [ [10, 25, 50, -1], [10, 25, 50, 'All'] ], 
                    dom: 'Blfrtip',
                    buttons: [                        
                        {
                            extend: 'excelHtml5',
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
                        }
                    ]                    
                }); 
                    // DataTable initialization with Server-Processing ::END
            }
        });
            
            
    });
    </script>

    </body>

    </html>