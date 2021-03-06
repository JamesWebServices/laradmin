@extends( config('laradmin.layout') )

@section('content')

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ route( config('laradmin.adminpath') . '.dashboard' ) }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
          </ol>

          <!-- Icon Cards-->
          <div class="row">

            @foreach(config('laradmin.crudable') as $model => $parameters)

              @if($loop->index % 4 == 0)
          </div><div class="row">
            @endif

            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white {{ collect(['bg-primary', 'bg-success', 'bg-warning', 'bg-danger'])->get($loop->index % 4) }} o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw {{ !empty($parameters['nav_icon']) ? $parameters['nav_icon'] : 'fa-file-alt' }}"></i>
                  </div>
                  <div class="mr-5">{{ $model::count() }} {{ $parameters['nav_title'] }}!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1"
                   href="{{ route(config('laradmin.adminpath') . '.' . $parameters['route'] . '.index') }}">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            @endforeach

          </div>

          <div class="card mb-3">
            <div class="card-header">Dashboard</div>

            <div class="card-body">
              @if (session('status'))
                <div class="alert alert-success">
                  {{ session('status') }}
                </div>
              @endif

              You are logged in!
            </div>
          </div>

@endsection

@section('scripts')
    <!-- Page level plugin JavaScript-->
    <script src="/vendor/laradmin/Theme/vendor/chart.js/Chart.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="/vendor/laradmin/Theme/js/demo/datatables-demo.js"></script>
    <script src="/vendor/laradmin/Theme/js/demo/chart-area-demo.js"></script>
@endsection