<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <form action="{{$action}}" id="formModal" method="POST">
            @csrf
            @isset($method)
                @if($method == "PUT")
                    @method("PUT")
                @endif
            @endisset
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{isset($modal_title) ? $modal_title : ""}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
                        <label for="role">Role</label>
                        <x-select-component id="role"
                                            name="role"
                                            error-container="#role-errors"
                                            case="role"
                                            :selected="isset($data) ? $data->role : 1">
                        </x-select-component>
                        <div id="role-errors"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </form>
    </div>
</div>

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
                dt.ajax.reload();
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
