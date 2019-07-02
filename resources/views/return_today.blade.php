@extends('layouts.app') @section('content')

<div class="box box-default" id="search_result">
    <div class="box-header with-border">
        <h3 class="box-title">Returned On Today</h3>
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
                            <th>Accession No.</th>
                            <th>Returned From</th>
                            <th>Issued Date</th>                                
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
                            <th>Content</th>
                        </tr>
                    </thead>  
                    <tbody>
                            @foreach($data['return_today'] as $data1)
                                <td>{{$data1->ACCESSNO}}</td>
                                <td>{{$data1->UFNAME}}  {{$data1->USNAME}}</td>
                                <td>{{$data1->DTISS}}</td>
                                <td>{{$data1->LIBNO}}</td>
                                @if($data1->TYPE=='B')
                                    <td>Book</td>
                                @endif
                                @if($data1->TYPE=='J')
                                    <td>Journal</td>
                                @endif
                                @if($data1->TYPE=='A')
                                    <td>Acts</td>
                                @endif
                                @if($data1->TYPE=='P')
                                    <td>Publication</td>
                                @endif
                                <td>{{$data1->TITLE}}</td>
                                <td>{{$data1->PUBNAME}}</td>
                                <td>{{$data1->AUFNAME1}}  {{$data1->AUSNAME1}}</td>
                                <td>{{$data1->AUFNAME2}}  {{$data1->AUSNAME2}}</td>
                                <td>{{$data1->VOLNO}}</td>
                                <td>{{$data1->EDENO}}</td>
                                <td>{{$data1->YEAR}}</td>
                                <td>{{$data1->PRICE}}</td>
                                <td>{{$data1->DTPUR}}</td>
                                <td>{{$data1->COPY}}</td>
                                <td>{{$data1->CONTENT}}</td>
                            </tr>
                            @endforeach
                        </tbody>                                                           
            </table>
        </div>
    </div>
</div>


@endsection
