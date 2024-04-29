@extends('layouts.frontend', ['class' => 'bg-default'])

@section('head')
    <link rel="stylesheet" href="{{asset('assets/vendor/select2/dist/css/select2.min.css')}}">
@endsection
@section('content')
    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <form action="{{route('shop.post')}}" method="post" id="form_shop">
        @csrf
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <!-- Price Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Katalog boyicha tanlash</h5>
                    <select class="select2" multiple="multiple" name="catalog[]" data-placeholder="Tanlang" style="width: 100%;">
                        @foreach($catalogs as $catalog)
                            <option value="{{ $catalog->id }}" {{ isset($filterData['catalog']) && in_array($catalog->id,$filterData['catalog'])?'selected':'' }}>{{ $catalog->id .'-'. $catalog->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Price End -->

                <!-- Color Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Brend boyicha tanlash</h5>
                    <select class="select2" multiple="multiple" name="brand[]" data-placeholder="Tanlang" style="width: 100%;">
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ isset($filterData['brand']) && in_array($brand->id,$filterData['brand'])?'selected':'' }}>{{ $brand->id .'-'. $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="border-bottom mb-4">
                    <button type="submit" class="form-control btn btn-primary mb-4">Filtrlarni qo'llash</button>
                    <button type="button" class="form-control btn btn-outline-primary" id="filterReset">Hammasini tozalash</button>
                </div>
                <!-- Color End -->
            </div>
            <!-- Shop Sidebar End -->
            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" id="search" placeholder="Nomi bo'yicha qidiruv" value="{{$filterData['search']??''}}">
                                <div class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <i class="fa fa-search"></i>
                                        </span>
                                </div>
                            </div>
{{--                            <div class="dropdown ml-4">--}}
{{--                                <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"--}}
{{--                                        aria-expanded="false">--}}
{{--                                    Sort by--}}
{{--                                </button>--}}
{{--                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">--}}
{{--                                    <a class="dropdown-item" href="#">Latest</a>--}}
{{--                                    <a class="dropdown-item" href="#">Popularity</a>--}}
{{--                                    <a class="dropdown-item" href="#">Best Rating</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                    @foreach($products as $product)
                        @php($gallery = json_decode($product->gallery))
                        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
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
                    <div class="col-12 py-3">
                        {{ $products->render('pagination.custom') }}
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
        </form>
    </div>
    <!-- Shop End -->
    @push('js')
        <script src="{{asset('assets/vendor/select2/dist/js/select2.full.min.js')}}"></script>
        <script>
            $(document).ready(function() {
                $('.select2').select2();
            });
            $("#filterReset").on('click',function (){
                $('.select2').val(null).trigger('change');
                $("#search").val('');
                $("#form_shop").submit();
            });
        </script>
    @endpush
@endsection
