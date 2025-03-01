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
                        <h6 class="h2 text-white d-inline-block mb-0">@lang('base.call_backs')</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i
                                            class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('base.call_backs')</li>
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
                    <div class="table-responsive py-4 px-2">
                        <table class="table table-flush w-100" id="example">
                            <thead class="thead-light">
                            <tr>
                                <th>@lang('cruds.user.fields.id')</th>
                                <th>@lang('cruds.user.fields.name')</th>
                                <th>@lang('base.phone_number')</th>
                                <th>@lang('base.branch')</th>
                                <th>@lang('base.status')</th>
                                <th>@lang('global.actions')</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>@lang('cruds.user.fields.id')</th>
                                <th>@lang('cruds.user.fields.name')</th>
                                <th>@lang('base.phone_number')</th>
                                <th>@lang('base.branch')</th>
                                <th>@lang('base.status')</th>
                                <th>@lang('global.actions')</th>
                            </tr>
                            </tfoot>
                            <tbody>

                            @foreach($callBacks as $callBack)
                                <tr>
                                    <td>{{ $callBack->id }}</td>
                                    <td>{{ $callBack->name }}</td>
                                    <td>{{ $callBack->phone }}</td>
                                    <td>@lang("base.branches.".$callBack->branch_id.".name")</td>
                                    <td>@Lang("base.$callBack->status")</td>
                                    <td class="text-center">
{{--                                        @can double --}}
                                        @canany('callback.edit','callback.destroy')
                                        <form action="{{ route('call_backs.destroy',$callBack->id) }}" method="post" id="deleteForm{{$callBack->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="btn-group">
                                                @can('callback.edit')
                                                    <a href="#" class="table-action"
                                                       data-toggle="modal" data-target="#editLocal"
                                                       data-body='@json($callBack)'>
                                                        <i class="fas fa-edit pr-1"> </i>
                                                    </a>
                                                @endcan
                                                @can('callback.destroy')
                                                <button type="button" class="p-0 table-action table-action-delete"
                                                            data-toggle="tooltip"
                                                            data-original-title="Удалить"
                                                            onclick="if (confirm('Вы уверены?')) { this.form.submit() } "
                                                            style="border: none;color:#5e72e4;background: none;cursor:pointer;:hover{border:none;color:#525f7f}">
                                                    <i class="fas fa-trash"> </i>
                                                </button>
                                                @endcan
                                            </div>
                                        </form>
                                        @endcanany
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

    <!-- Modal edit local -->
    <div class="modal fade" id="editLocal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('call_backs.update.status') }}" method="post">
                    @csrf
                    <div class="modal-header align-items-center">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit call_backs status<span
                                id="key-text"></span></h5>
                        <button type="button" class="btn-close" data-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <input type="hidden" name="id" id="id">
                            <div class="d-flex justify-content-between">
                                <span>@Lang('cruds.user.fields.id')</span>
                                <span id="callback_id"></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>@Lang('cruds.user.fields.name')</span>
                                <span id="callback_name"></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>@Lang('base.phone_number')</span>
                                <span id="callback_phone"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>@lang('base.status')</label>
                            <select name="status" id="status" class="form-control">
                                <option value="new">@lang('base.new')</option>
                                <option value="pending">@lang('base.pending')</option>
                                <option value="cancel">@lang('base.cancel')</option>
                                <option value="done">@lang('base.done')</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">@lang('global.cancel')</button>
                        <button type="submit"
                                class="btn  btn-success float-right">@lang('global.save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js')
        <script src="{{ asset('assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script>
            $(document).ready(function () {
                var table = $('#example').DataTable({
                    language: {
                        url: "{{ asset('assets/any/datatable-ru.json') }}",
                        paginate: {
                            previous: "<i class='fas fa-angle-left'>",
                            next: "<i class='fas fa-angle-right'>"
                        }
                    },
                    lengthChange: true,
                    order: [[0, 'desc']],
                    columnDefs: [
                        {type: 'num', targets: 0}
                    ]
                });

                table.buttons().container()
                    .appendTo('#example_wrapper .col-md-6:eq(0)');
            });
            $('#editLocal').on('show.bs.modal', function (event) {

                let button = $(event.relatedTarget);
                let body = button.data('body');
                let modal = $(this);
                // console.log(body);

                modal.find('#id').val(body.id);
                modal.find('#callback_id').text(body.id);
                modal.find('#callback_name').text(body.name);
                modal.find('#callback_phone').text(body.phone);

            });
        </script>
    @endpush
@endsection
