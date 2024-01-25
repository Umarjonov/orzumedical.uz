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
                        <h6 class="h2 text-white d-inline-block mb-0">@lang('cruds.user.title')</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i
                                            class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">@lang('cruds.user.title')</li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('global.edit')</li>
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

                        <form action="{{ route('user.update',$user->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <label>@lang('cruds.user.fields.name')</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                                <input name="name" type="text"
                                       class="input form-control {{ $errors->has('name') ? "is-invalid":"" }}"
                                       value="{{ old('name',$user->name) }}" id="name" placeholder="name" aria-label="Username"
                                       aria-describedby="basic-addon1" required/>
                                @if($errors->has('name'))
                                    <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <label for="phone">@lang('cruds.user.fields.email')</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fas fa-phone"></i></span>
                                </div>
                                <input name="phone" type="text"
                                       class="input form-control {{ $errors->has('phone') ? "is-invalid":"" }}"
                                       value="{{ old('phone',$user->phone) }}" id="phone" placeholder="phone" aria-label="phone"
                                       aria-describedby="basic-addon1" required/>
                                @if($errors->has('phone'))
                                    <span class="error invalid-feedback">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                            <label for="company_id">Company</label>
                            <div class="form-group {{ $errors->has('company_id') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <select class="form-control{{ $errors->has('company_id') ? ' is-invalid' : '' }}" name="company_id" data-placeholder="@lang('pleaseSelect')" style="width: 100%;" required>
                                        @foreach( $companies as $comp)
                                            <option value="{{ $comp->id }}" {{ $user->company_id==$comp->id?'selected':'' }}>{{ $comp->id.'-'.$comp->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($errors->has('company_id'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                      <strong>{{ $errors->first('company_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="branch_id">Branch</label>
                            <div class="form-group {{ $errors->has('branch_id') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <select class="form-control{{ $errors->has('branch_id') ? ' is-invalid' : '' }}" name="branch_id" data-placeholder="@lang('pleaseSelect')" style="width: 100%;" required>
                                        @foreach( $companies as $comp)
                                            @foreach( $comp->branch as $br)
                                                <option value="{{ $br->id }}" {{ $user->branch_id==$br->id?'selected':'' }}>{{ $br->id.'-'.$br->name }}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                                @if ($errors->has('branch_id'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                      <strong>{{ $errors->first('branch_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="division_id">Division</label>
                            <div class="form-group {{ $errors->has('division_id') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <select class="form-control{{ $errors->has('division_id') ? ' is-invalid' : '' }}" name="division_id" data-placeholder="@lang('pleaseSelect')" style="width: 100%;" required>
                                        @foreach( $divisions as $division)
                                            <option value="{{ $division->id }}" {{ $user->division_id==$division->id?'selected':'' }}>{{ $division->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($errors->has('division_id'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                      <strong>{{ $errors->first('division_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="position_id">Position</label>
                            <div class="form-group {{ $errors->has('position_id') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <select class="form-control{{ $errors->has('position_id') ? ' is-invalid' : '' }}" name="position_id" data-placeholder="@lang('pleaseSelect')" style="width: 100%;" required>
                                        @foreach( $positions as $position)
                                            <option value="{{ $position->id }}" {{ $user->position_id==$position->id?'selected':'' }}>{{ $position->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($errors->has('position_id'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                      <strong>{{ $errors->first('position_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            @canany(['roles.edit','user.edit'])
                                <div class="form-group">
                                    <label>@lang('cruds.role.fields.roles')</label>
                                    <select class="select2" multiple="multiple" name="roles[]" data-placeholder="@lang('pleaseSelect')" style="width: 100%;">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}" {{ ($user->hasRole($role->name) ? "selected":'') }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endcan
                            <div class="form-group">
                                <label>Аватар</label>
                                <div class="input-group">
                                    <img src="{{asset('uploads/avatar/'.$user->image)}}" alt="Preview Uploaded Image"
                                         class="mr-2 " style="height: 48px;border: 1px solid #ccc !important;width: 48px;border-radius: 50%;" id="file-preview">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="avatar">
                                        <label class="custom-file-label" for="avatar">изображение аватара пользователя</label>
                                    </div>
                                </div>
                            </div>
                            <label>@lang('cruds.user.fields.password')</label>
                            <div class="input-group mb-3 has-validation">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                </div>
                                <input name="password" type="password" value="" class="input form-control {{ $errors->has('password') ? "is-invalid":"" }}" id="password" placeholder="password" aria-label="password" aria-describedby="basic-addon1" />
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="password_show_hide('');">
                                      <i class="fas fa-eye d-none" id="show_eye"></i>
                                      <i class="fas fa-eye-slash" id="hide_eye"></i>
                                    </span>
                                </div>
                                @if($errors->has('password'))
                                    <span class="error invalid-feedback">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <label>@lang('global.login_password_confirmation')</label>
                            <div class="input-group mb-3 has-validation">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                </div>
                                <input name="password_confirmation" type="password" value="" class="input form-control" id="password2" placeholder="password" aria-label="password" aria-describedby="basic-addon1" />
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="password_show_hide('2');">
                                      <i class="fas fa-eye d-none" id="show_eye2"></i>
                                      <i class="fas fa-eye-slash" id="hide_eye2"></i>
                                    </span>
                                </div>
                                @if($errors->has('password_confirmation'))
                                    <span class="error invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right">@lang('global.save')</button>
                                <a href="{{ route('user.index') }}" class="btn btn-default float-left">@lang('global.cancel')</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
    @push('js')
        <script src="{{asset('assets/vendor/select2/dist/js/select2.full.min.js')}}"></script>
        <script>
            $(document).ready(function() {
                $('.select2').select2();
            });
            function password_show_hide(id) {
                var x = document.getElementById("password"+id);
                var show_eye = document.getElementById("show_eye"+id);
                var hide_eye = document.getElementById("hide_eye"+id);
                show_eye.classList.remove("d-none");
                if (x.type === "password") {
                    x.type = "text";
                    show_eye.style.display = "block";
                    hide_eye.style.display = "none";
                } else {
                    x.type = "password";
                    show_eye.style.display = "none";
                    hide_eye.style.display = "block";
                }
            }
            const input = document.getElementById('avatar');
            const previewPhoto = () => {
                const file = input.files;
                if (file) {
                    const fileReader = new FileReader();
                    const preview = document.getElementById('file-preview');
                    fileReader.onload = function (event) {
                        preview.setAttribute('src', event.target.result);
                    }
                    fileReader.readAsDataURL(file[0]);
                }
            }
            input.addEventListener("change", previewPhoto);
        </script>
    @endpush
@endsection
