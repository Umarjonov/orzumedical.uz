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
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">@lang('base.videos')</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i
                                            class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('videos.index') }}"><i
                                            class="fas fa-user"> @lang('base.videos')</i></a></li>
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
        <div class="row">
            <div class="col">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@lang('global.add')</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{ route('videos.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <label>@lang('base.title') uz</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                                <input name="title_uz" type="text"
                                       class="input form-control {{ $errors->has('title_uz') ? "is-invalid":"" }}"
                                       value="{{ old('title_uz') }}" id="title_uz" placeholder="title_uz" aria-label="title_uz"
                                       aria-describedby="basic-addon1" required/>
                                @if($errors->has('title_uz'))
                                    <span class="error invalid-feedback">{{ $errors->first('title_uz') }}</span>
                                @endif
                            </div>
                            <label>@lang('base.title') ru</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                                <input name="title_ru" type="text"
                                       class="input form-control {{ $errors->has('title_ru') ? "is-invalid":"" }}"
                                       value="{{ old('title_ru') }}" id="title_ru" placeholder="title_ru" aria-label="title_ru"
                                       aria-describedby="basic-addon1" required/>
                                @if($errors->has('title_ru'))
                                    <span class="error invalid-feedback">{{ $errors->first('title_ru') }}</span>
                                @endif
                            </div>
                            <label for="phone">@Lang('base.url')</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span>
                                </div>
                                <input name="url" type="text"
                                       class="input form-control {{ $errors->has('url') ? "is-invalid":"" }}"
                                       value="{{ old('url') }}" id="url" placeholder="url" aria-label="url"
                                       aria-describedby="basic-addon1" required/>
                                @if($errors->has('url'))
                                    <span class="error invalid-feedback">{{ $errors->first('url') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>@lang('base.image')</label>
                                <div class="input-group">
                                    <img src="{{asset('uploads/avatar/default.png')}}" alt="Preview Uploaded Image"
                                         class="mr-2" style="height: 48px;border: 1px solid #ccc !important;width: 48px;border-radius: 50%;" id="file-preview">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="image">изображение аватара пользователя</label>
                                    </div>
                                </div>
                            </div>
                            <label>@lang('base.status')</label>
                            <div class="input-group mb-3">
                                <select name="status" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right">@lang('global.save')</button>
                                <a href="{{ route('videos.index') }}"
                                   class="btn btn-default float-left">@lang('global.cancel')</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script src="{{asset('assets/vendor/select2/dist/js/select2.full.min.js')}}"></script>
        <script>
            $(document).ready(function () {
                $('.select2').select2();
            });
        </script>
    @endpush
@endsection
