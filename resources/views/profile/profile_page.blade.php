@extends('layouts.app')

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
                            <h4 class="card-title mb-3">{{ $data->name }}</h4>
                            <form action="{{route('profile')}}" id="formModal" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                                <div>
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input name="name" type="text"
                                               data-parsley-errors-container="#name-errors"
                                               value="<?php echo e(isset($data) ? $data->name : ""); ?>"
                                               class="form-control" id="name">
                                        <div id="name-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input name="email" type="text"
                                               data-parsley-errors-container="#email-errors"
                                               value="<?php echo e(isset($data) ? $data->email : ""); ?>"
                                               class="form-control" id="email">
                                        <div id="email-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input name="username" type="text"
                                               data-parsley-errors-container="#username-errors"
                                               value="<?php echo e(isset($data) ? $data->username : ""); ?>"
                                               class="form-control" id="username">
                                        <div id="username-errors"></div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-file mt-3">
                                            <input type="file" class="custom-file-input" id="file" name="file">
                                            <label class="custom-file-label" for="file">Klik untuk mengganti foto profil</label>
                                        </div>
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
    <script src="{{ asset('libs/select2/select2.min.js') }}"></script>
    <script src="{{ asset('libs/etc/loadingoverlay.js') }}"></script>
    <script src="{{ asset('libs/etc/jqueryform.js') }}"></script>
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
                        location.reload();
                    },2000)
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
          href="{{ asset('libs/select2/select2.min.css') }}"/>
@endpush
