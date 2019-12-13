@extends('admin.wrapper')
@section('CSS')
    <style>
        a:hover {
            color: initial;
            text-decoration: none;
        }
    </style>
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                        <a href="{{ route('user.list') }}"  class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tổng số người dùng</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count['users']}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-graduate fa-3x text-gray-300"></i>
                    </div>
                </a>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <a href="{{ route('center.list') }}" class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Tổng số trung tâm</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count['users']}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-school fa-3x text-gray-300"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">

                    <a href="{{ route('review.list') }}" class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Tổng số đánh giá</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count['reviews']}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-star fa-3x text-gray-300"></i>
                    </div>
                </a>
                </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                        <a href="{{ route('teacher.list') }}" class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tổng số giáo viên</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count['teachers']}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chalkboard-teacher fa-3x text-gray-300"></i>
                    </div>
                </a>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                        <a href="{{ route('teacher.list') }}"  class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Số giáo viên được đánh giá</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $count['rated'] }}</div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                              @php
                                $status = ($count['rated']/$count['teachers']) * 100;
                              @endphp
                            <div class="progress-bar bg-info" role="progressbar" style="width: {{$status}}%" aria-valuenow="{{$status}}" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                        <i class="far fa-id-card fa-3x text-gray-300"></i>
                    </div>
                </a>
                </div>
              </div>
            </div>
        </div>
          <!-- Content Row -->

    </div>
    <!-- /.container-fluid -->
</html>
@endsection
