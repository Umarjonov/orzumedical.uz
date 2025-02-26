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
                        <h6 class="h2 text-white d-inline-block mb-0">@lang('base.local.title')</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i
                                            class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('base.local.title')</li>
                            </ol>
                        </nav>
                    </div>
                @can('language.create')
                        <div class="col-lg-6 col-5 text-right">
                            <a href="#" class="btn btn-neutral btn-sm float-right" data-toggle="modal"
                               data-target="#modal-default">
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
                        <table class="table table-flush w-100" id="example">
                            <thead class="thead-light">
                            <tr>
                                <th>@lang('cruds.user.fields.id')</th>
                                <th>@lang('base.key')</th>
                                <th>UZ</th>
                                <th>RU</th>
                                <th>EN</th>
                                <th>УЗ</th>
                                <th>@lang('global.actions')</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>@lang('cruds.user.fields.id')</th>
                                <th>@lang('base.key')</th>
                                <th>UZ</th>
                                <th>RU</th>
                                <th>EN</th>
                                <th>УЗ</th>
                                <th>@lang('global.actions')</th>
                            </tr>
                            </tfoot>
                            <tbody>

                            @foreach($languages as $lang)
                                <tr>
                                    <td>{{ $lang->id }}</td>
                                    <td>{{ $lang->key }}</td>
                                    <td>{{ $lang->uz }}</td>
                                    <td>{{ $lang->ru }}</td>
                                    <td>{{ $lang->en }}</td>
                                    <td>{{ $lang->oz }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('languages.destroy',$lang->id) }}" method="post" id="deleteForm{{$lang->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="btn-group">
                                                @can('language.edit')
                                                    <a href="#" class="table-action"
                                                       data-toggle="modal" data-target="#editLocal"
                                                       data-body='@json($lang)'>
                                                        <i class="fas fa-edit pr-1"> </i>
                                                    </a>
                                                @endcan
                                                @can('language.destroy')
                                                    <a href="#" class="table-action table-action-delete" data-toggle="tooltip"
                                                       data-original-title="Delete role" onclick="if (confirm('Вы уверены?')) { document.getElementById('deleteForm'+{{$lang->id}}).submit() } ">
                                                        <i class="fas fa-trash"> </i>
                                                    </a>
                                                @endcan
                                            </div>
                                        </form>
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

    <!-- Modal -->
    <div class="modal fade" id="modal-default" data-bs-backdrop="static" data-bs-keyboard="false"
         tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('languages.store') }}" method="post">
                    @csrf
                    <div class="modal-header align-items-center">
                        <h5 class="modal-title" id="staticBackdropLabel">Add new translate</h5>
                        <button type="button" class="btn-close" data-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('base.key')</label>
                            <input type="text" name="key"
                                   class="form-control {{ $errors->has('key') ? "is-invalid":"" }}"
                                   value="{{ old('key') }}" required>
                            @if($errors->has('key'))
                                <span class="error invalid-feedback">{{ $errors->first('key') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>@lang('base.uzbek')</label>
                            <input type="text" name="uz"
                                   class="form-control {{ $errors->has('uz') ? "is-invalid":"" }}"
                                   value="{{ old('uz') }}" required>
                            @if($errors->has('uz'))
                                <span class="error invalid-feedback">{{ $errors->first('uz') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>@lang('base.russion')</label>
                            <input type="text" name="ru"
                                   class="form-control {{ $errors->has('ru') ? "is-invalid":"" }}"
                                   value="{{ old('ru') }}" required>
                            @if($errors->has('ru'))
                                <span class="error invalid-feedback">{{ $errors->first('ru') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>@lang('base.english')</label>
                            <input type="text" name="en"
                                   class="form-control {{ $errors->has('en') ? "is-invalid":"" }}"
                                   value="{{ old('en') }}" required>
                            @if($errors->has('en'))
                                <span class="error invalid-feedback">{{ $errors->first('en') }}</span>
                            @endif
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

    <!-- Modal edit local -->
    <div class="modal fade" id="editLocal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('languages.update.modal') }}" method="post">
                    @csrf
                    <div class="modal-header align-items-center">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit translate for:<span
                                id="key-text"></span></h5>
                        <button type="button" class="btn-close" data-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" id="id-edit" name="id" hidden required>
                            <input type="text" id="key-edit" name="key" hidden required>

                        </div>
                        <div class="form-group">
                            <label>@lang('base.uzbek')</label>
                            <input type="text" id="uz-edit" name="uz"
                                   class="form-control {{ $errors->has('uz') ? "is-invalid":"" }}"
                                   value="{{ old('uz') }}" required>
                            @if($errors->has('uz'))
                                <span class="error invalid-feedback">{{ $errors->first('uz') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>@lang('base.russion')</label>
                            <input type="text" id="ru-edit" name="ru"
                                   class="form-control {{ $errors->has('ru') ? "is-invalid":"" }}"
                                   value="{{ old('ru') }}" required>
                            @if($errors->has('ru'))
                                <span class="error invalid-feedback">{{ $errors->first('ru') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>@lang('base.english')</label>
                            <input type="text" id="en-edit" name="en"
                                   class="form-control {{ $errors->has('en') ? "is-invalid":"" }}"
                                   value="{{ old('en') }}" required>
                            @if($errors->has('en'))
                                <span class="error invalid-feedback">{{ $errors->first('en') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>@lang('base.kirilcha')</label>
                            <input type="text" id="oz-edit" name="oz"
                                   class="form-control {{ $errors->has('oz') ? "is-invalid":"" }}"
                                   value="{{ old('oz') }}" required>
                            @if($errors->has('oz'))
                                <span class="error invalid-feedback">{{ $errors->first('oz') }}</span>
                            @endif
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
                    "language": {
                        "lengthMenu": "Показать _MENU_ записей на странице",
                        "info": "Показано с _START_ по _END_ из _TOTAL_ записей",
                        "search": "Поиск:",
                        "paginate": {
                            "first": "Первая",
                            "last": "Последняя",
                            "next": "Следующая",
                            "previous": "Предыдущая"
                        }
                    },
                    lengthChange: true,
                    order: [[0, 'desc']],
                });

                table.buttons().container()
                    .appendTo('#example_wrapper .col-md-6:eq(0)');
            });
            $('#editLocal').on('show.bs.modal', function (event) {

                let button = $(event.relatedTarget);
                let body = button.data('body');
                let modal = $(this);
                // console.log(body);

                modal.find('#key-text').text(body.key);
                modal.find('#id-edit').val(body.id);
                modal.find('#key-edit').val(body.key);
                modal.find('#uz-edit').val(body.uz);
                modal.find('#ru-edit').val(body.ru);
                modal.find('#en-edit').val(body.en);
                modal.find('#oz-edit').val(body.oz);

            });
        </script>
    @endpush
@endsection
