@extends('layouts.app', ['title' => __('User Edit')])
@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-6 pt-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col">
                        <h6 class="h2 text-white d-inline-block mb-0">Изменить карусель</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i
                                            class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('brand.index') }}">карусель</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Изменить</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Изменить</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <form action="{{ route('carousel.update',$carousel->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{asset('uploads/carousel/'.$carousel->image)}}" id="file-preview" alt="Preview Uploaded Image"
                                 style="height: 400px;border: 1px solid #ccc !important;width: 100%;border-radius: 8px;">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('global.title')</label>
                                <input type="text" name="title" class="form-control {{ $errors->has('title') ? "is-invalid":"" }}" value="{{ old('title',$carousel->title) }}" required>
                                @if($errors->has('title'))
                                    <span class="error invalid-feedback">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>@lang('global.description')</label>
                                <textarea name="description" class="form-control {{ $errors->has('description') ? "is-invalid":"" }}" required>{{ old('description',$carousel->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Link</label>
                                <input type="text" name="link" class="form-control {{ $errors->has('link') ? "is-invalid":"" }}" value="{{ old('link',$carousel->link) }}" required>
                                @if($errors->has('link'))
                                    <span class="error invalid-feedback">{{ $errors->first('link') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="status">Статус</label>
                                <select class="form-control" name="status" id="status" data-placeholder="@lang('pleaseSelect')" required>
                                    <option value="1" {{$carousel->status?'selected':''}}>active</option>
                                    <option value="0" {{$carousel->status?'':'selected'}}>in_active</option>
                                </select>
                                @if($errors->has('status'))
                                    <span class="error invalid-feedback">{{ $errors->first('status') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="file" name="image" id="image" hidden="">
                                @if($errors->has('image'))
                                    <span class="error invalid-feedback">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success float-right">@lang('global.save')</button>
                        <a href="{{ route('carousel.index') }}" class="btn btn-default float-left">@lang('global.cancel')</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js')

        <script>

            const input = document.getElementById('image');
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
            $("#file-preview").on('click', function () {
                input.click();
            });
        </script>

    @endpush
@endsection
