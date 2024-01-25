@extends('layouts.app', ['title' => __('Role')])

@section('head')
    <link href="{{ asset('assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-6 pt-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-8 col-9">
                        <h6 class="h2 text-white d-inline-block mb-0">@lang('cruds.permission.title')</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i
                                            class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('cruds.permission.title')</li>
                            </ol>
                        </nav>
                    </div>
                    @can('permissions.create')
                        <div class="col-lg-4 col-3 d-flex justify-content-end">
                            <a href="{{ route('permissions.create') }}" class="btn btn-sm btn-neutral">
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
                    <div class="table-responsive py-4 px-2">
                        <table class="table table-flush" id="example">
                            <thead class="thead-light">
                            <tr>
                                <th>@lang('cruds.permission.fields.id')</th>
                                <th>@lang('cruds.permission.fields.name')</th>
                                <th>@lang('cruds.permission.fields.roles')</th>
                                <th class="w-25">@lang('global.actions')</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>@lang('cruds.permission.fields.id')</th>
                                <th>@lang('cruds.permission.fields.name')</th>
                                <th>@lang('cruds.permission.fields.roles')</th>
                                <th class="w-25">@lang('global.actions')</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        @foreach($permission->roles as $role)
                                            <span class="badge badge-success">{{ $role->name }} </span>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        @can('permissions.destroy')
                                            <form action="{{ route('permissions.destroy',$permission->id) }}" method="post" id="deleteForm{{$permission->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <div class="btn-group">
                                                    @can('permissions.edit')
                                                        <a href="{{ route('permissions.edit',$permission->id) }}"
                                                           class="table-action" data-toggle="tooltip"
                                                           data-original-title="Edit permissions">
                                                            <i class="fas fa-user-edit pr-1"> </i>
                                                        </a>
                                                    @endcan
                                                    <a href="#" class="table-action table-action-delete" data-toggle="tooltip"
                                                       data-original-title="Delete permissions" onclick="if (confirm('Вы уверены?')) { document.getElementById('deleteForm'+{{$permission->id}}).submit() } ">
                                                        <i class="fas fa-trash"> </i>
                                                    </a>
                                                </div>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
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
                });

                table.buttons().container()
                    .appendTo('#example_wrapper .col-md-6:eq(0)');
            });
        </script>
    @endpush
@endsection
