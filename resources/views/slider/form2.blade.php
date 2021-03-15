<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <form action="{{$action}}" id="formModal" method="POST" enctype="multipart/form-data">
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
                        <label for="slider_name">Nama Slider</label>
                        <input name="slider_name" type="text"
                               data-parsley-errors-container="#slider_name-errors"
                               value="<?php echo e(isset($data) ? $data->slider_name : ""); ?>"
                               class="form-control" id="slider_name">
                        <div id="slider_name-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="slider_status">Status</label>
                        <x-select-component id="slider_status"
                                            name="slider_status"
                                            error-container="#slider_status-errors"
                                            case="status"
                                            :selected="isset($data) ? $data->slider_status : 1">
                        </x-select-component>
                        <div id="slider_status-errors"></div>
                    </div>
                    <div class="form-group">
                        <div class="custom-file mt-4">
                            <input name="slider_image" type="file"
                                   class="custom-file-input" id="slider_image">
                            <label class="custom-file-label" for="slider_image">Image</label>
                        </div>
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
    //$(".select2").select2();
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
                    el.html(`<small class='text-danger'>value.join()</small>`);
                });
            }
        });
        return false;
    });
</script>
