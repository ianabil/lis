@extends('layouts.app') 
@section('content')
<div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-purple">
            <span class="info-box-icon"><i class="ion ion-document-text" style="margin-top:20px"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><strong>Last Accession No.</strong></span>
              <span class="info-box-number">96528</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="ion ion-arrow-return-right" style="margin-top:20px"></i></span>
    
                <div class="info-box-content">
                  <span class="info-box-text"><strong>Issued Book On Today</strong></span>                  
                  <span class="info-box-number">16</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-red">
                <span class="info-box-icon"><i class="ion ion-arrow-return-left" style="margin-top:20px"></i></span>
    
                <div class="info-box-content">
                  <span class="info-box-text"><strong>Returned Book On Today</strong></span>
                  <span class="info-box-number">16</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
    </div>

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
                <li class="item">
                  <div class="product-info">
                    Book ABC
                    <span class="label label-warning pull-right">$1800</span>
                    <span class="product-description"> Publisher Name: PUB1 </span>
                  </div>
                </li>
                <!-- /.item -->
                <li class="item">
                    <div class="product-info">
                          Book EFG
                        <span class="label label-warning pull-right">$1800</span>
                        <span class="product-description"> Publisher Name: PUB2 </span>
                    </div>
                </li>
                <!-- /.item -->
                <li class="item">
                        <div class="product-info">
                              Book EFG
                            <span class="label label-warning pull-right">$1800</span>
                            <span class="product-description"> Publisher Name: PUB2 </span>
                        </div>
                </li>
                <!-- /.item -->
                <li class="item">
                        <div class="product-info">
                              Book EFG
                            <span class="label label-warning pull-right">$1800</span>
                            <span class="product-description"> Publisher Name: PUB2 </span>
                        </div>
                    </li>
                <!-- /.item -->
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
                        <li class="item">
                          <div class="product-info">
                            Journal ABC
                            <span class="label label-warning pull-right">$1800</span>
                            <span class="product-description"> Publisher Name: PUB1 </span>
                          </div>
                        </li>
                        <!-- /.item -->
                        <li class="item">
                            <div class="product-info">
                                Journal EFG
                                <span class="label label-warning pull-right">$1800</span>
                                <span class="product-description"> Publisher Name: PUB2 </span>
                            </div>
                        </li>
                        <!-- /.item -->
                        <li class="item">
                                <div class="product-info">
                                    Journal EFG
                                    <span class="label label-warning pull-right">$1800</span>
                                    <span class="product-description"> Publisher Name: PUB2 </span>
                                </div>
                        </li>
                        <!-- /.item -->
                        <li class="item">
                                <div class="product-info">
                                    Journal EFG
                                    <span class="label label-warning pull-right">$1800</span>
                                    <span class="product-description"> Publisher Name: PUB2 </span>
                                </div>
                            </li>
                        <!-- /.item -->
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
                                <li class="item">
                                  <div class="product-info">
                                    Act ABC
                                    <span class="label label-warning pull-right">$1800</span>
                                    <span class="product-description"> Publisher Name: PUB1 </span>
                                  </div>
                                </li>
                                <!-- /.item -->
                                <li class="item">
                                    <div class="product-info">
                                        Act EFG
                                        <span class="label label-warning pull-right">$1800</span>
                                        <span class="product-description"> Publisher Name: PUB2 </span>
                                    </div>
                                </li>
                                <!-- /.item -->
                                <li class="item">
                                        <div class="product-info">
                                            Act EFG
                                            <span class="label label-warning pull-right">$1800</span>
                                            <span class="product-description"> Publisher Name: PUB2 </span>
                                        </div>
                                </li>
                                <!-- /.item -->
                                <li class="item">
                                        <div class="product-info">
                                            Act EFG
                                            <span class="label label-warning pull-right">$1800</span>
                                            <span class="product-description"> Publisher Name: PUB2 </span>
                                        </div>
                                    </li>
                                <!-- /.item -->
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