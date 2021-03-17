@extends('vendor.admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="shadow-sm breadcrumbnav">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">User Management</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                <div class="card border-light shadow-sm">
                    <div class="card-body">
                        <div class="d-md-flex" id="app">
                            <h4 class="card-title mb-3">User Management</h4>
                            <div class="ml-auto">
                                <a href="{{route('usermanagement.create')}}" class="btn btn-primary btn-create mb-1">
                                    <span class="fa fa-plus"></span>
                                    Tambah
                                </a>
                                <button class="btn btn-dark btn-refresh mb-1">
                                    <span class="fa fa-recycle"></span>
                                    Refresh Datatable
                                </button>
                                <button class="btn btn-danger btn-bulk-delete mb-1" @click="bulkDelete"
                                        v-if="data.length > 0">
                                    <span class="fa fa-trash"></span>
                                    Hapus Data Terpilih
                                </button>
                            </div>
                        </div>
                        {{-- <div class="mt-3">
                                                    <x-select-component id="usermanagement_status_filter"
                                                                        name="usermanagement_status"
                                                                        case="status">
                                                    </x-select-component>
                                                </div>--}}
                        <div class="mt-3">
                           <div class="table-responsive">
                            <table id="datatables" class="table dt-responsive nowrap"></table>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modalAjaxContainer"></div>
@endsection

@push("style")
    <link rel="stylesheet" type="text/css"
          href="{{ asset('vendor/crudgen/libs/datatables/datatables.min.css') }}"/>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('vendor/crudgen/libs/select2/select2.min.css') }}"/>
@endpush


@push("script")
        <script src="{{ asset('vendor/crudgen/libs/select2/select2.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('vendor/crudgen/libs/datatables/pdfmake.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('vendor/crudgen/libs/datatables/vfs_fonts.js') }}"></script>
        <script type="text/javascript"
                src="{{ asset("vendor/crudgen/libs/datatables/datatables.min.js") }}"></script>
        <script src="{{ asset('vendor/crudgen/libs/etc/loadingoverlay.js') }}"></script>
        <script src="{{ asset('vendor/crudgen/libs/etc/jqueryform.js') }}"></script>
    <script>
        var app = new Vue({
            el: "#app",
            data: {
                data: []
            },
            methods: {
                bulkDelete() {
                    var $vm = this;
                    alertify.confirm('Confirm Message', function () {
                        $.ajax({
                            method: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                data: $vm.data
                            },
                            url: "{{route('usermanagement.bulkdelete')}}",
                            success: function (response) {
                                alertify.success(response.message);
                                dt.ajax.reload();
                                $vm.data = [];
                            }
                        });
                    });
                }
            }
        });
        var configDt = {
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json"
            },
            "dom": 'lBfrtip',
            "buttons": [
                {
                    extend: 'excelHtml5',
                    message: "Report User Management",
                    exportOptions: {
                        columns: [1, 2]
                    }
                },
                {
                    extend: 'print',
                    message: "<h4>Report User Management</h4>",
                    exportOptions: {
                        columns: [1, 2]
                    },
                    customize: function (win) {

                        var last = null;
                        var current = null;
                        var bod = [];

                        var css = '@page { size: landscape; }',
                            head = win.document.head || win.document.getElementsByTagName('head')[0],
                            style = win.document.createElement('style');

                        style.type = 'text/css';
                        style.media = 'print';

                        if (style.styleSheet) {
                            style.styleSheet.cssText = css;
                        }
                        else {
                            style.appendChild(win.document.createTextNode(css));
                        }
                        head.appendChild(style);
                    }
                },
                'colvis',
            ],
            "ajax": {
                "url": '{{url()->current()}}',
                "data": {
                    "usermanagement_status": null
                }
            },
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [
                [1, "asc"]
            ],
            "columns": [
{
"data": "checked",
"name": "checked",
"orderable": false,
"searchable": false,
"title": "#",
"class": "w-10",
},
    {
    "data": "name",
    "name": "name",
    "orderable": true,
    "searchable": true,
    "title": "Nama",
    "class": "auto text-capitalize"
    },
    {
    "data": "email",
    "name": "email",
    "orderable": true,
    "searchable": true,
    "title": "Email",
    "class": "auto text-capitalize"
    },
    {
    "data": "username",
    "name": "username",
    "orderable": true,
    "searchable": true,
    "title": "Username",
    "class": "auto text-capitalize"
    },
    {
    "data": "role",
    "name": "role",
    "orderable": true,
    "searchable": true,
    "title": "Role",
    "class": "auto text-capitalize"
    },
{
"data": "action",
"orderable": false,
"searchable": false,
"title": "Action",
"class": "text-center w-25"
}
]

        };

        window.dt;

        $(document).ready(function () {
            dt = $('#datatables').DataTable(configDt).on("click", ".btn-edit", function (e) {
                e.preventDefault();
                $.LoadingOverlay("show")
                $.ajax({
                    method: "GET",
                    url: $(this).attr("href"),
                    success: function (response) {
                        $.LoadingOverlay("hide")
                        $("#modalAjaxContainer").html(response);
                        $("#modalAjaxContainer").find(".modal").modal("show");
                    }
                })
            }).on("click", ".btn-destroy", function (e) {
                var vm = $(this);
                e.preventDefault();
                alertify.confirm('Apakah Anda Yakin','Hapus Data Sekarang?', function () {
                    $.ajax({
                        method: "DELETE",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        url: vm.attr("href"),
                        success: function (response) {
                            alertify.success(response.message);
                            dt.ajax.reload();
                        }
                    });
                },  function(){
                                       alertify.error('Cancel')
                                   });
            }).on("change", ".dt-selectable", function (e) {
                if ($(this).is(':checked')) {
                    $(this).attr('value', 'true');
                } else {
                    $(this).attr('value', 'false');
                }
                var val = $(this).val()
                var id = $(this).attr('id');
                let obj = {
                    id: id,
                    val: val
                }
                if (obj.val == "true") {
                    app.data.push(obj);
                } else {
                    var i = app.data.indexOf(obj);
                    app.data.splice(i, 1);
                }
            });
        });

        $("#usermanagement_status_filter").on("change", function (e) {
            configDt.ajax.data.usermanagement_status = $(this).val();
            dt.destroy();
            dt = $('#datatables').DataTable(configDt)
        });
        $(".btn-refresh").on("click", function () {
            dt.ajax.reload(null, false);
        });
        $(".btn-create").on("click", function (e) {
            e.preventDefault();
            $.LoadingOverlay("show");
            var vm = $(this);
            $.ajax({
                method: "GET",
                url: vm.attr("href"),
                success: function (response) {
                    $.LoadingOverlay("hide")
                    $("#modalAjaxContainer").html(response);
                    $("#modalAjaxContainer").find(".modal").modal("show");
                }
            })
        });
    </script>
@endpush
