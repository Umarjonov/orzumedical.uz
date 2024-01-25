@extends('layouts.app', ['title' => __('User Edit')])
@section('head')

    <!-- common libraries -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <!-- plugin -->
    <script src="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/jquery.bootstrap-duallistbox.js"></script>
    <link rel="stylesheet" type="text/css" href="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/bootstrap-duallistbox.css">



    <style>

        .removeall {
            border: 1px solid #ccc !important;
        }
        .moveall {
            border: 1px solid #ccc !important;
        }


        .moveall::after {
            content: attr(title);

        }

        .removeall::after {
            content: attr(title);
        }

        .form-control option {
            padding: 10px;
            border-bottom: 1px solid #efefef;
        }
    </style>

@endsection
@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-6 pt-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col">
                        <h6 class="h2 text-white d-inline-block mb-0">@lang('cruds.permission.title')</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i
                                            class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('permissions.index') }}"> @lang('cruds.permission.title')</i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('global.add')</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@lang('global.add')</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{ route('permissions.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>@lang('cruds.permission.fields.name')</label>
                                <input type="text" name="name" class="form-control {{ $errors->has('name') ? "is-invalid":"" }}" value="{{ old('name') }}" required>
                                @if($errors->has('name') || 1)
                                    <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right">@lang('global.save')</button>
                                <a href="{{ route('permissions.index') }}" class="btn btn-default float-left">@lang('global.cancel')</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
    <script>
        var demo1 = $('select[name="permissions[]"]').bootstrapDualListbox({
            nonSelectedListLabel: "Available @lang('cruds.permission.fields.permissions')",
            selectedListLabel: "Selected @lang('cruds.permission.fields.permissions')",
            preserveSelectionOnMove: 'moved',
            moveAllLabel: 'Move all',
            removeAllLabel: 'Remove all'
        });
        $("#demoform").submit(function() {
            alert($('[name="permissions[]"]').val());
            return false;
        });
    </script>
    @push('js')


    @endpush
@endsection
