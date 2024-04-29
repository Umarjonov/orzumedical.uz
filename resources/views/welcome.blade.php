@extends('layouts.frontend', ['class' => 'bg-default'])

@section('head')
    <style>
        #brands_img {
            width: 160px !important;
            height: 160px !important;
            object-fit: contain !important;
            border: 1px solid #D19C97 !important;
            border-radius: 50% !important;
            padding: 4px;
            box-shadow: 4px 4px 21px 0px rgba(80, 51, 34, 0.2);
        }
    </style>
@endsection
@section('content')
<!-- Featured Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-solid fa-check text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Sifatli mahsulotlar</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-solid fa-truck text-primary m-0 mr-2"></h1>
                <h5 class="font-weight-semi-bold m-0"> Keng turdagi uskunalar</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-solid fa-award text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Eng yaxshi narxlar</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-solid fa-phone-volume text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Doimiy qo'llav quvvatlash</h5>
            </div>
        </div>
    </div>
</div>
<!-- Featured End -->


<!-- Categories Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        @foreach($catalogs as $catalog)
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right">{{ $catalog->product_count ?? 0 }}ta mahsulot</p>
                    <a href="{{route('shop.catalog',$catalog->id)}}" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="{{ asset('uploads/catalogs/'.$catalog->image) }}" alt="{{$catalog->name??''}}" style="height: 300px;width: 100%;object-fit: contain">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">{{$catalog->name??''}}</h5>
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- Categories End -->

<!-- Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Mashhur mahsulotlar</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        @foreach($products as $product)
            @php($gallery = json_decode($product->gallery))
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 border-hover mb-4 h-100">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="{{asset('uploads/products/'.$gallery[0])}}" alt="{{$product->name}}" style="height: 350px;object-fit: contain">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">{{$product->name}}</h6>
                        <div class="d-flex justify-content-center">
                            <h6>{{$product->price ? $product->price.' '.($product->currency==2?'USD':'SUM') :''}}</h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="{{route('product.details',$product->id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- Products End -->

<!-- Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Yangi mahsulotlar</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        @foreach($products as $product)
            @php($gallery = json_decode($product->gallery))
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 border-hover mb-4 h-100">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="{{asset('uploads/products/'.$gallery[0])}}" alt="{{$product->name}}" style="height: 350px;object-fit: contain">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">{{$product->name}}</h6>
                        <div class="d-flex justify-content-center">
                            <h6>{{$product->price ? $product->price.' '.($product->currency==2?'USD':'SUM') :''}}</h6>
                            {{--                            h6 class="text-muted ml-2"><del>{{$product->price}}</del></h6>--}}
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="{{route('product.details',$product->id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- Products End -->


<!-- Vendor Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                @foreach($brands as $brand)
                    <div class="vendor-item p-2">
                        <img src="{{asset('uploads/brands/'.$brand->image)}}" alt="{{$brand->name}}" id="brands_img">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Vendor End -->

@endsection
