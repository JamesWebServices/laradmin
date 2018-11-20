@extends( config('laradmin.layout') )

@section('content')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route( config('laradmin.adminpath') . '.dashboard' ) }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route(config('laradmin.adminpath') . '.' . $crudable->route . '.index') }}">{{ $crudable->nav_title }}</a>
        </li>
        <li class="breadcrumb-item active">Edit {{ $crudable->singular }}</li>
    </ol>

    <div class="card mb-3 crudable">
        <div class="card-header navbar navbar-light bg-light">
            <a class="navbar-brand">Edit {{ $crudable->singular }}</a>
            <a href="{{ route(config('laradmin.adminpath') . '.' . $crudable->route . '.index') }}" class="btn btn-sm btn-info float-right">Cancel</a>
        </div>

        <div class="card-body">

            <form method="POST"
                  action="{{ route(config('laradmin.adminpath') . '.' . $crudable->route . '.update', $crudable->model()->id) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @foreach($crudable->fields() as $field)
                    @include($field->view(), ['value'=>$crudable->findValueFor($field->name)])
                @endforeach

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-3">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save ' . $crudable->singular) }}
                        </button>
                    </div>
                </div>
            </form>

        </div>

    </div>
@endsection