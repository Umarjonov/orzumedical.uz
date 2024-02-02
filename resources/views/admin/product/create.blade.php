@extends('layouts.app', ['title' => __('User Profile')])

@section('head')
    <style>
        .card_image{
            border: 1px solid #ccc !important;
            background: none !important;
            height: 200px;
            width: 100%;
            border-radius: 0.75rem;
            object-fit: fill;
        }
        .cards_img{
            border: 1px solid #ccc !important;
            background: none !important;
            height: 80px;
            width: 90px;
            border-radius: 0.75rem;
            object-fit: contain;
        }
    </style>
@endsection
@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-6 pt-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Добавить Продукт</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i
                                            class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('product.index') }}">Продукт</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('global.add')</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <button class="btn btn-secondary mb-0" type="button" id="btn_store">@lang('global.save')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6 mb-4">
        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data" id="form_store">
            @csrf
            <div class="row">
                <div class="col-lg-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h2 class="font-weight-bolder">Галерея товаров</h2>
                                <button class="btn btn-primary m-0 ms-auto" type="button" name="button" id="btn_gallery">править</button>
                                <input type="file" name="gallery[]" id="gallery" onchange="galleryLoading(event)" multiple hidden="">
                            </div>
                            <div class="d-flex flex-wrap mt-3" id="div_gallery" style="gap: 8px">
                                <img class="w-100 shadow-lg mt-3 card_image" src="{{asset('uploads/products/default-product-image.png')}}" alt="product_image">
                                <img class="cards_img" src="{{asset('uploads/products/default-product-image.png')}}" alt="product image">
                                <img class="cards_img" src="{{asset('uploads/products/default-product-image.png')}}" alt="product image">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mt-lg-0 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="font-weight-bolder">Информация о продукте</h2>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="mt-4" for="catalog_id">@lang('global.product_name')</label>
                                        <input class="form-control" type="text" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label class="mt-3" for="catalog_id">Артикуль</label>
                                        <input class="form-control" type="text" name="articul">
                                    </div>
                                    <div class="form-group">
                                        <label>Вес (кг)</label>
                                        <input name="weight" class="form-control" type="number" value="1">
                                    </div>
                                    <div class="form-group">
                                        <label for="catalog_id">Каталог</label>
                                        <select class="form-control {{ $errors->has('catalog_id') ? "is-invalid":"" }}" name="catalog_id" id="catalog_id" data-placeholder="@lang('pleaseSelect')">
                                            <option value="" disabled selected>Корневой каталог</option>
                                            @foreach($catalogs as $catalog)
                                                <option value="{{ $catalog->id }}">{{ $catalog->id.'-'.$catalog->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="brand_id">Брендь</label>
                                        <select class="form-control {{ $errors->has('brand_id') ? "is-invalid":"" }}" name="brand_id" id="brand_id" data-placeholder="@lang('pleaseSelect')">
                                            <option value="" disabled selected>Корневой брендь</option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->id.'-'.$brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="mt-4">Заглавие</label>
                                        <textarea name="title" id="title" class="form-control" cols="30" rows="2"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Описание</label>
                                        <textarea name="description" id="description" class="form-control" cols="30" rows="6"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Информация</label>
                                        <textarea name="information" id="information" class="form-control" cols="30" rows="6"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h2 class="font-weight-bolder">Оптимизация поисковых систем</h2>
                            <label>Title</label>
                            <input name="seo_title" class="form-control" type="text">
                            <label class="mt-3">Keywords</label>
                            <input name="seo_keywords" class="form-control" type="text">
                            <label class="mt-3">Description</label>
                            <textarea name="seo_description" id="seo_description" class="form-control" cols="30" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 mt-sm-0 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="font-weight-bolder">Ценообразование</h2>
                            <div class="row">
                                <div class="col-4 form-group">
                                    <label>Количество</label>
                                    <input name="count" class="form-control" type="text">
                                </div>
                                <div class="col-5 form-group">
                                    <label>Цена</label>
                                    <input class="form-control" type="number" name="price">
                                </div>
                                <div class="col-3 form-group">
                                    <label>Валюта</label>
                                    <select class="form-control" name="currency" id="currency" data-placeholder="@lang('pleaseSelect')">
                                        <option value="1">SO'M</option>
                                        <option value="2">USD</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body">
                            <h2 class="font-weight-bolder">Социальные сети</h2>
                            <div class="row">
                                <div class="col-4 form-group">
                                    <label>Ссылка на телеграмму</label>
                                    <input name="telegram" class="form-control" type="text">
                                </div>
                                <div class="col-4 form-group">
                                    <label>Ссылка на Фейсбук</label>
                                    <input name="facebook" class="form-control" type="text" value="https://">
                                </div>
                                <div class="col-4 form-group">
                                    <label>Ссылка на Инстаграм</label>
                                    <input name="instagram" class="form-control" type="text" value="https://">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('js')
        <script>
            $("#btn_gallery").click(function () {
                $("#gallery").click();
            });
            const galleryLoading = function (event) {
                const gallery_body = Object.keys(event.target.files).map((key, index) => {
                    const classes = index === 0 ? 'w-100 shadow-lg mt-3 card_image' : 'cards_img';
                    return `<img class="${classes}" src="${URL.createObjectURL(event.target.files[key])}" alt="product image">`;
                }).join('');

                $("#div_gallery").html(gallery_body);
            };
            $("#btn_store").click(function () {
                $("#form_store").submit();
            });
        </script>
    @endpush
@endsection
