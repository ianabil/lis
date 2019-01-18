@extends('layouts.app') @section('content')
<!-- Main content -->
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Upload data from Koha S/W</h3>
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
                    <label>Date</label>
                    <input type="text" class="form-control date" name="upload_date_from" id="upload_date_from" placeholder="From">
                    <br>
                    <input type="text" class="form-control date" name="upload_date_to" id="upload_date_to" placeholder="To">                    
                </div>
            </div>
            <!-- /.col -->


            

            <div class="col-md-1">
                <div class="form-group">
                <label>&nbsp;</label>
                <p>&nbsp;</p>
                
                    <button type="button" class="form-control btn-success btn btn-primary" name="filter" id="filter">Filter
                </div>
            </div>
            <!-- /.col -->


            <div class="col-md-3">            
                <div class="form-group">
                <label>&nbsp;</label>
                <p>&nbsp;</p>
                    <input type="radio" value="book" name="book" checked="checked">Book &nbsp;
                    <input type="radio" value="journal" name="journal">Journal &nbsp;
                    <input type="radio" value="bare_act" name="bare_act">Bare Act  &nbsp;
                </div>
            </div>
        <!-- /.col -->

            <div class="col-md-1">
                <div class="form-group">
                <label>&nbsp;</label>
                <p>&nbsp;</p>
                    <button type="button" class="form-control btn btn-primary" name="reset" id="reset">Reset
                </div>
            </div>
            <!-- /.row -->
        </div>


        
<hr>
         
<br> <br>


    </div>
    <!-- /.box-body -->
    @endsection

    <script src="{{asset('js/jquery/jquery.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $( ".date").datepicker(); // Date picker initialization
        });
        
    </script>

    </body>

    </html>