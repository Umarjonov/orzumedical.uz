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
                        <h6 class="h2 text-white d-inline-block mb-0">@lang('base.branches')</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i
                                            class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('branches.index') }}"><i
                                            class="fas fa-user"> @lang('base.branches')</i></a></li>
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
                        <h3 class="card-title">@lang('global.edit')</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{ route('branches.update',$branch->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <label>@lang('cruds.user.fields.name') uz</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                                <input name="name_uz" type="text"
                                       class="input form-control {{ $errors->has('name_uz') ? "is-invalid":"" }}"
                                       value="{{ old('name_uz',$branch->name_uz) }}" id="name_uz" placeholder="name_uz" aria-label="name_uz"
                                       aria-describedby="basic-addon1" required/>
                                @if($errors->has('name_uz'))
                                    <span class="error invalid-feedback">{{ $errors->first('name_uz') }}</span>
                                @endif
                            </div>
                            <label>@lang('cruds.user.fields.name') ru</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                                <input name="name_ru" type="text"
                                       class="input form-control {{ $errors->has('name_ru') ? "is-invalid":"" }}"
                                       value="{{ old('name_ru',$branch->name_ru) }}" id="name_ru" placeholder="name_ru" aria-label="name_ru"
                                       aria-describedby="basic-addon1" required/>
                                @if($errors->has('name_ru'))
                                    <span class="error invalid-feedback">{{ $errors->first('name_ru') }}</span>
                                @endif
                            </div>
                            <label for="phone">Phone</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fas fa-phone"></i></span>
                                </div>
                                <input name="phone" type="text"
                                       class="input form-control {{ $errors->has('phone') ? "is-invalid":"" }}"
                                       value="{{ old('phone',$branch->phone) }}" id="phone" placeholder="phone" aria-label="phone"
                                       aria-describedby="basic-addon1" required/>
                                @if($errors->has('phone'))
                                    <span class="error invalid-feedback">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                            <label>@lang('base.description') uz</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                                <input name="description_uz" type="text"
                                       class="input form-control {{ $errors->has('description_uz') ? "is-invalid":"" }}"
                                       value="{{ old('description_uz',$branch->description_uz) }}" id="description_uz" placeholder="description_uz" aria-label="description_uz"
                                       aria-describedby="basic-addon1" required/>
                                @if($errors->has('description_uz'))
                                    <span class="error invalid-feedback">{{ $errors->first('description_uz') }}</span>
                                @endif
                            </div>
                            <label>@lang('base.description') ru</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                                <input name="description_ru" type="text"
                                       class="input form-control {{ $errors->has('description_ru') ? "is-invalid":"" }}"
                                       value="{{ old('description_ru',$branch->description_ru) }}" id="description_ru" placeholder="description_ru" aria-label="description_ru"
                                       aria-describedby="basic-addon1" required/>
                                @if($errors->has('description_ru'))
                                    <span class="error invalid-feedback">{{ $errors->first('description_ru') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>@lang('base.image')</label>
                                <div class="input-group">
                                    <img src="{{asset('uploads/images/branches/'.$branch->image)}}" alt="Preview Uploaded Image"
                                         class="mr-2" style="height: 48px;border: 1px solid #ccc !important;width: 48px;border-radius: 50%;" id="file-preview">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="image">изображение аватара пользователя</label>
                                    </div>
                                </div>
                                @if($errors->has('image'))
                                    <span class="error invalid-feedback">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                            <label>@lang('base.address') uz</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                                <input name="address" type="text"
                                       class="input form-control {{ $errors->has(' address') ? "is-invalid":"" }}"
                                       value="{{ old('address',$branch->address) }}" id="address" placeholder="address" aria-label="address"
                                       aria-describedby="basic-addon1" required/>
                                @if($errors->has('address'))
                                    <span class="error invalid-feedback">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                            <label>@lang('base.address') ru</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                                <input name="address_ru" type="text"
                                       class="input form-control {{ $errors->has(' address_ru') ? "is-invalid":"" }}"
                                       value="{{ old('address',$branch->address_ru) }}" id="address_ru" placeholder="address_ru" aria-label="address_ru"
                                       aria-describedby="basic-addon1" required/>
                                @if($errors->has('address_ru'))
                                    <span class="error invalid-feedback">{{ $errors->first('address_ru') }}</span>
                                @endif
                            </div>
                            <label>@lang('base.status')</label>
                            <div class="input-group mb-3">
                                <select name="status" class="form-control">
                                    <option value="active" {{$branch->status=='active' ? 'selected' : ""}}>Active</option>
                                    <option value="inactive" {{$branch->status=='inactive' ? 'selected' : ""}}>Inactive</option>
                                </select>
                            </div>
                            <label>@lang('base.latitude')</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                                <input name="latitude" type="text"
                                       class="input form-control {{ $errors->has('latitude') ? "is-invalid":"" }}"
                                       value="{{ old('latitude',$branch->latitude) }}" id="latitude" placeholder="latitude" aria-label="latitude"
                                       aria-describedby="basic-addon1" required/>
                                @if($errors->has('latitude'))
                                    <span class="error invalid-feedback">{{ $errors->first('latitude') }}</span>
                                @endif
                            </div>
                            <label>@lang('base.longitude')</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                                <input name="longitude" type="text"
                                       class="input form-control {{ $errors->has('longitude') ? "is-invalid":"" }}"
                                       value="{{ old('longitude',$branch->longitude) }}" id="longitude" placeholder="longitude" aria-label="longitude"
                                       aria-describedby="basic-addon1" required/>
                                @if($errors->has('longitude'))
                                    <span class="error invalid-feedback">{{ $errors->first('longitude') }}</span>
                                @endif
                            </div>
                            <label>@lang('base.price')</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                                <input name="price" type="text"
                                       class="input form-control {{ $errors->has('price') ? "is-invalid":"" }}"
                                       value="{{ old('price',$branch->price) }}" id="price" placeholder="price" aria-label="price"
                                       aria-describedby="basic-addon1" required/>
                                @if($errors->has('price'))
                                    <span class="error invalid-feedback">{{ $errors->first('price') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right">@lang('global.save')</button>
                                <a href="{{ route('branches.index') }}"
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
