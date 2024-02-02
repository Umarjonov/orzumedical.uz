@extends('layouts.app', ['title' => __('User Profile')])

@section('head')
<style>
    #example tr th{
        font-size: 12px !important;
        font-weight: bold !important;
    /*    uppercase */
        text-transform: uppercase !important;
    }
    .table_image{
        width: 110px;
        height: 100px;
        border: 1px solid #ccc;
        border-radius: 6px;
        object-fit: contain;
        margin: 6px;
    }
    .media-body{
        max-width: 300px;
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
                        <h6 class="h2 text-white d-inline-block mb-0">Продукт</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i
                                            class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Продукт</li>
                            </ol>
                        </nav>
                    </div>
                    @can('product.create')
                        <div class="col-lg-6 col-5 text-right">
                            <a href="{{ route('product.create') }}" class="btn btn-sm btn-neutral">
                                <span class="fas fa-plus-circle"></span>
                                @lang('global.add')
                            </a>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">

                    <div class="row p-2">
                        @if( isset($catalogs) )
                            <div class="form-group col-6 col-md-3 pr-0">
                                <select name="catalog_id" id="catalog_id" style="width: 100%;" class="form-control select2 {{ $errors->has('catalog_id') ? "is-invalid":"" }}">
                                    <option value="0" selected disabled>Каталог..</option>
                                    @foreach($catalogs as $catalog)
                                        <option value="{{ $catalog->id }}">{{ $catalog->id.'-'.$catalog->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        @if(isset($brands))
                            <div class="form-group col-6 col-md-3 pr-0">
                                <select name="brand" id="brand" style="width: 100%;" class="form-control select2 {{ $errors->has('brand') ? "is-invalid":"" }}">
                                    <option value="0" selected disabled>Бренд..</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->id }}-{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="d-flex form-group col-md-6 pr-0 pr-md-3">
                            <input class="form-control mr-2" type="search"
                                   id="search_text" name="name" placeholder="@lang('global.search')" aria-label="Search">
                            <button class="btn btn-outline-primary" id="reset_filter" type="button"><i class="nav-icon fas fa-trash-restore"></i>сброс</button>
                        </div>
                    </div>
                    <!-- Data table -->
                    <table id="example" class="styled-table mt-0 table-hover">
                        <thead>
                            <tr class="text-center">
                                <th class="text-left pl-2">Продукт</th>
                                <th>Каталог</th>
                                <th>Цена</th>
                                <th>Кол-во</th>
                                <th>Статус</th>
{{--                                <th>Создатель</th>--}}
                                <th>@lang('global.actions')</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <div class="card-footer py-4">
                        <span class="float-left" id="table_info"></span>
                        <nav aria-label="Page navigation example" style="float: right;">
                            <ul class="pagination" id="pagination_li">
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            let data2 = JSON.parse(window.localStorage.getItem('data2'));
            let productIndex = JSON.parse(window.localStorage.getItem('productIndex2'));
            if(!data2){ data2 = {}; }
            if(!productIndex){ productIndex = 'product/index'; }
            function table_change(data) {
                set_table(data.data)
                set_pagination(data.links)
                set_table_info(data);
            }

            function set_table(products) {
                let table_body = '';
                products.forEach(product=>{
                    let images = JSON.parse(product.gallery);
                    console.log(product.title);
                    let link_image = "{{ asset('uploads/products') }}/"+(images[0] ?? 'default.png');
                    table_body +=
                        `<tr>
                            <th scope="row">
                                <div class="media align-items-center">
                                   <a href="#" class="mr-3">
                                        <img alt="Image placeholder" src="${link_image}" class="table_image">
                                   </a>
                                   <div class="media-body">
                                    <span class="name mb-0 text-sm">${product.name}</span><br>
                                    <span class="text-sm font-weight-light">${product.title??''}</span>
                                   </div>
                                </div>
                            </th>
                            <td class='text-center'>${product.catalog ? product.catalog.name : 'Umumiy'}</td>
                            <td class='text-right'>${product.price??0} ${product.currency===2?'USD':'SUM'}</td>
                            <td class='text-center'>${product.count??0}</td>
                            <td class='text-center'>
                                <span class="badge badge-dot mr-4">
                                    <i class="bg-${product.is_active?'success':'warning'}"></i>
                                    <span class="status">${product.is_active?'active':'inactive'}</span>
                                </span>
                            </td>
                            <td class="text-center">
                                    <form action="{{ URL::to('admin/product') }}/${product.id}" method="post" id="deleteForm${product.id}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="btn-group">
                                            @can('product.edit')
                                                <a href="{{ URL::to('admin/product') }}/${product.id}/edit">
                                                    <i class="fas fa-edit p-1"> </i>
                                                </a>
                                            @endcan
                                            @can('product.delete')
                                                <a href="#" onclick="if (confirm('Вы уверены?')) {document.getElementById('deleteForm${product.id}').submit()} ">
                                                    <i class="fas fa-trash p-1"> </i>
                                                </a>
                                            @endcan
                                        </div>
                                    </form>
                            </td>
                        </tr>`;
                });
                $("#example tbody").html(table_body);
            }
            function set_pagination(links) {
                let pagination_link = '';
                links.forEach(link=>{
                    pagination_link += `<li class="page-item ${link.active ? 'active': ''} ${link.label==='...'||link.url===null ? 'disabled' : '' }"><a class="page-link" href="#" onclick="button_pagination(${link.label})">${link.label}</a></li>`;
                })
                $("#pagination_li").html(pagination_link);
            }
            function button_pagination(id) {
                productIndex = `product/index?page=${id}`;
                fetchProducts(productIndex);
            }
            function set_table_info(data) {
                let table_info = `Показаны от ${data.from} до ${data.to} из ${data.total} товаров`;
                $("#table_info").html(table_info);
            }

            const fetchProducts = async function(url){
                productIndex = url;
                window.localStorage.setItem('productIndex',JSON.stringify(productIndex));
                const response = await postData(productIndex);
                if(response.status){
                    table_change(response.result);
                }else{
                    console.log("response", response.error);
                }
            };
            const postData = async function(url = '') {
                // Default options are marked with *
                $("body").addClass("loading");
                const response = await fetch(url, {
                    method: "POST", // *GET, POST, PUT, DELETE, etc.
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Content-Type': 'application/json',
                    },
                    // body: {...data2}
                    body: JSON.stringify(data2) // body data type must match "Content-Type" header
                });
                $("body").removeClass("loading");
                return response.json(); // parses JSON response into native JavaScript objects
            };

            fetchProducts(productIndex);
        </script>
    @endpush
@endsection
