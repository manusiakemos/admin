@extends('vendor.admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="shadow-sm breadcrumbnav">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                <div class="card border-light shadow-sm">
                    <div class="card-body">
                        <div id="app">
                            <h4 class="card-title mb-3">Update Password</h4>
                            <form action="{{route('password')}}" id="formModal" method="POST">
                                @csrf
                                @method("PUT")
                                <div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input name="password" type="password"
                                               data-parsley-errors-container="#password-errors"
                                               value="<?php echo e(isset($data) ? $data->password : ""); ?>"
                                               class="form-control" id="password">
                                        <div id="password-errors"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Konfirmasi Password</label>
                                        <input name="password_confirmation" type="password"
                                               data-parsley-errors-container="#password_confirmation-errors"
                                               value="<?php echo e(isset($data) ? $data->password_confirmation : ""); ?>"
                                               class="form-control" id="password_confirmation">
                                        <div id="password_confirmation-errors"></div>
                                    </div>
                                </div>
                                <div class="mt-3 float-right">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        Tutup
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modalAjaxContainer"></div>
@endsection


@push("script")
    <script src="{{ asset('vendor/crudgen/libs/select2/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/crudgen/libs/etc/loadingoverlay.js') }}"></script>
    <script src="{{ asset('vendor/crudgen/libs/etc/jqueryform.js') }}"></script>
    <script>
        $(".select2").select2();
        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
    <script>
        $("#formModal").on("submit", function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            var serializedArray = $(this).serializeArray();
            $.each(serializedArray, function (index, value) {
                let el = $(`#${value.name}-errors`);
                el.html("");
            });
            $(this).ajaxSubmit({
                success: function (response) {
                    alertify.success(response.message);
                    setTimeout(function () {
                        location.assign("{{ route('login') }}");
                    }, 2000)
                },
                error: function (error) {
                    alertify.error(error.responseJSON.message);
                    var errorBags = error.responseJSON.errors;
                    console.log(errorBags);
                    $.each(errorBags, function (index, value) {
                        let el = $(`#${index}-errors`);
                        el.html(`<small class='text-danger'>${value.join()}</small>`);
                    });
                }
            });
            return false;
        });
    </script>
@endpush


@push("style")
    <link rel="stylesheet" type="text/css"
          href="{{ asset('vendor/crudgen/libs/select2/select2.min.css') }}"/>
@endpush
