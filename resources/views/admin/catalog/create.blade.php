@extends('layouts.app', ['title' => __('User Edit')])
@section('head')
    <link rel="stylesheet" href="{{asset('assets/vendor/select2/dist/css/select2.min.css')}}">

@endsection
@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-6 pt-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col">
                        <h6 class="h2 text-white d-inline-block mb-0">Добавить Каталог</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i
                                            class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('catalog.index') }}"> Каталог </a></li>
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

                        <form action="{{ route('catalog.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>@lang('cruds.permission.fields.name')</label>
                                <input type="text" name="name" class="form-control {{ $errors->has('name') ? "is-invalid":"" }}" value="{{ old('name') }}" required>
                                @if($errors->has('name'))
                                    <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="parent_id">Суб каталог</label>
{{--                                not selected --}}
                                <select class="form-control {{ $errors->has('parent_id') ? "is-invalid":"" }}" name="parent_id" id="parent_id" data-placeholder="@lang('pleaseSelect')">
                                    <option value="0">Корневой каталог</option>
                                    @foreach($catalogs as $catalog)
                                        <option value="{{ $catalog->id }}">{{ $catalog->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('parent_id'))
                                    <span class="error invalid-feedback d-flex">{{ $errors->first('parent_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="is_active">Статус</label>
                                <select class="form-control" name="is_active" id="is_active" data-placeholder="@lang('pleaseSelect')" required>
                                    <option value="1">active</option>
                                    <option value="0">in_active</option>
                                </select>
                                @if($errors->has('is_active'))
                                    <span class="error invalid-feedback">{{ $errors->first('is_active') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="file" name="image" id="image">
                                @if($errors->has('image'))
                                    <span class="error invalid-feedback">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right">@lang('global.save')</button>
                                <a href="{{ route('catalog.index') }}" class="btn btn-default float-left">@lang('global.cancel')</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')

    @push('js')


    @endpush
@endsection
