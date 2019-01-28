@extends('layouts.app') 
@section('content')
<div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-purple">
            <span class="info-box-icon"><i class="ion ion-document-text" style="margin-top:20px"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><strong>Last Accession No.</strong></span>
              <span class="info-box-number">{{$data['last_accession_no']}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <a href="issue_today">
    <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="ion ion-arrow-return-right" style="margin-top:20px"></i></span>
    
                <div class="info-box-content">
                  <span class="info-box-text"><strong>Issued On Today</strong></span>                  
                  <span class="info-box-number">{{$data['issue_count']}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
    </div>
    </a>

    <a href="return_today">
    <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-red">
                <span class="info-box-icon"><i class="ion ion-arrow-return-left" style="margin-top:20px"></i></span>
    
                <div class="info-box-content">
                  <span class="info-box-text"><strong>Returned On Today</strong></span>
                  <span class="info-box-number">{{$data['receive_count']}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
    </div>
  </a>

</div>

<!-- Recently Added Books -->
<div class="row">
    <div class="col-md-4">
    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Recently Added Books</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                @foreach($data['recently_added_books'] as $books)
                  <li class="item">
                      {{$books['TITLE']}}
                      <span class="label label-warning pull-right">{{$books['ACCESSNO']}}</span>
                      <span class="product-description"> Publisher Name: {{$books['PUBNAME']}} </span>
                  </li>
                  <!-- /.item -->
                @endforeach                
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </div>
    <!-- /.col -->

    <div class="col-md-4">
            <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Recently Added Journals</h3>
        
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <ul class="products-list product-list-in-box">
                          @foreach($data['recently_added_journals'] as $journals)
                          <li class="item">
                              {{$journals['TITLE']}}
                              <span class="label label-warning pull-right">{{$journals['ACCESSNO']}}</span>
                              <span class="product-description"> Publisher Name: {{$journals['PUBNAME']}} </span>
                          </li>
                          <!-- /.item -->
                        @endforeach   
                      </ul>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
            </div>
            <!-- /.col -->

            <div class="col-md-4">
                    <div class="box box-primary">
                            <div class="box-header with-border">
                              <h3 class="box-title">Recently Added Acts</h3>
                
                              <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                              </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                              <ul class="products-list product-list-in-box">
                                  @foreach($data['recently_added_acts'] as $acts)
                                  <li class="item">
                                      {{$acts['TITLE']}}
                                      <span class="label label-warning pull-right">{{$acts['ACCESSNO']}}</span>
                                      <span class="product-description"> Publisher Name: {{$acts['PUBNAME']}}</span>
                                  </li>
                                  <!-- /.item -->
                                @endforeach   
                              </ul>
                            </div>
                            <!-- /.box-body -->
                          </div>
                          <!-- /.box -->
                    </div>
                    <!-- /.col -->                    
</div>
@endsection

</body>
</html>