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
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">@lang('cruds.role.title')</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i
                                            class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('cruds.role.fields.roles')</li>
                            </ol>
                        </nav>
                    </div>
                    @can('roles.create')
                        <div class="col-lg-6 col-5 text-right">
                            <a href="{{ route('roles.create') }}" class="btn btn-sm btn-neutral">
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
                                <th>@lang('cruds.user.fields.id')</th>
                                <th>@lang('cruds.user.fields.name')</th>
                                <th>@lang('cruds.permission.fields.permissions')</th>
                                <th>@lang('global.actions')</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>@lang('cruds.user.fields.id')</th>
                                <th>@lang('cruds.user.fields.name')</th>
                                <th>@lang('cruds.permission.fields.permissions')</th>
                                <th>@lang('global.actions')</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td style="white-space: inherit !important;">
                                        @foreach($role->permissions as $permission)
                                            <span class="badge badge-primary">{{ $permission->name }} </span>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        @can('roles.destroy')
                                            <form action="{{ route('roles.destroy',$role->id) }}" method="post" id="deleteForm{{$role->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <div class="btn-group">
                                                    @can('roles.edit')
                                                        <a href="{{ route('roles.edit', $role->id) }}"
                                                           class="table-action" data-toggle="tooltip"
                                                           data-original-title="Edit role">
                                                            <i class="fas fa-user-edit pr-1"> </i>
                                                        </a>
                                                    @endcan
                                                    <a href="#" class="table-action table-action-delete" data-toggle="tooltip"
                                                       data-original-title="Delete role" onclick="if (confirm('Вы уверены?')) { document.getElementById('deleteForm'+{{$role->id}}).submit() } ">
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
