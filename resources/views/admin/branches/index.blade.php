@extends('layouts.app', ['title' => __('User Profile')])

@section('head')
    <link href="{{ asset('assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection
@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-6 pt-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">@lang('base.branch')</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i
                                            class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('base.branch')</li>
                            </ol>
                        </nav>
                    </div>
                    @can('branches.create')
                        <div class="col-lg-6 col-5 text-right">
                            <a href="{{ route('branches.create') }}" class="btn btn-sm btn-neutral">
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
        <div class="row mb-6">
            <div class="col">
                <div class="card">
                    <!-- Data table -->
                    <div class="table-responsive py-4">
                        <table class="table align-items-center table-flush table-striped table-hover" id="example">
                            <thead class="thead-light">
                                <tr>
                                    <th>@lang('cruds.user.fields.id')</th>
                                    <th>@lang('cruds.user.fields.name')</th>
                                    <th>@lang("base.image")</th>
                                    <th>@lang('base.phone_number')</th>
                                    <th>@lang('base.address')</th>
                                    <th>@lang('base.price')</th>
                                    <th>@lang('base.status')</th>
                                    <th>@lang('global.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($branches as $branch)
                                <tr>
                                    <td>{{ $branch->id }}</td>
                                    <td>@lang("base.branches.".$branch->id.".name")</td>
                                    <td>
                                        <img src="{{ asset('uploads/images/branches/'.$branch->image) }}" alt="{{ $branch->id }}"
                                             style="width: 100px;height: 100px;border: 1px solid gray;border-radius: 8px">
                                    </td>
                                    <td>{{ $branch->phone }}</td>
                                    <td>@Lang("base.branches.".$branch->id.".address")</td>
                                    <td>{{ $branch->price }}</td>
                                    <td>{{ $branch->status }}</td>
                                    <td class="table-actions text-center">
                                        @can('branches.destroy')
                                            <form action="{{ route('branches.destroy', $branch->id) }}" method="post">
                                                @csrf
                                                @method("DELETE")
                                                <div class="btn-group">
                                                    @can('branches.edit')
                                                        <a href="{{ route('branches.edit', $branch->id) }}"
                                                           class="table-action" data-toggle="tooltip"
                                                           data-original-title="Изменить">
                                                            <i class="fas fa-edit pr-1"> </i>
                                                        </a>
                                                    @endcan
                                                    <button type="button" class="p-0 table-action table-action-delete"
                                                            data-toggle="tooltip"
                                                            data-original-title="Удалить"
                                                            onclick="if (confirm('Вы уверены?')) { this.form.submit() } "
                                                            style="background:none;border: none;color:#5e72e4;cursor:pointer;:hover{border:none;color:#525f7f}">
                                                        <i class="fas fa-trash"> </i>
                                                    </button>
                                                </div>
                                            </form>
                                        @endcan
                                    </td>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script src="{{ asset('assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script>
            $(document).ready(function () {
                var table = $('#example').DataTable({
                    lengthChange: true,
                    language: {
                        url: "{{ asset('assets/any/datatable-ru.json') }}",
                        paginate: {
                            previous: "<i class='fas fa-angle-left'>",
                            next: "<i class='fas fa-angle-right'>"
                        }
                    },
                    order: [[0, 'desc']],
                    columnDefs: [
                        { type: 'num', targets: 0 }
                    ]
                });

                table.buttons().container()
                    .appendTo('#example_wrapper .col-md-6:eq(0)');
            });
        </script>
    @endpush
@endsection
