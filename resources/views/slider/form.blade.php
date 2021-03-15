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
                        <label for="name">Nama Slider</label>
                        <input name="name" type="text"
                               data-parsley-errors-container="#name-errors"
                               value="<?php echo e(isset($data) ? $data->name : ""); ?>"
                               class="form-control" id="name">
                        <div id="name-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status Slider</label>
                        <x-radio-component id="status"
                                           name="status"
                                           error-container="#status-errors"
                                           case="status"
                                           :selected="isset($data) ? $data->status : 1">
                        </x-radio-component>
                        <div id="status-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="publish">Publish</label>
                        <x-select-component id="publish"
                                            name="publish"
                                            error-container="#publish-errors"
                                            case="status"
                                            :selected="isset($data) ? $data->publish : 1">
                        </x-select-component>
                        <div id="publish-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="tag">Tag</label>
                        <x-checkbox-component id="tag"
                                              name="tag"
                                              error-container="#tag-errors"
                                              case="status"
                                              :selected="isset($data) ? $data->tag : 1">
                        </x-checkbox-component>
                        <div id="tag-errors"></div>
                    </div>
                    <div class="form-group">
                        <div class="custom-file mt-4">
                            <input name="image" type="file"
                                   class="custom-file-input" id="image">
                            <label class="custom-file-label" for="image">Image</label>
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

<script src="{{asset('libs/etc/init.js')}}"></script>
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
                dt.ajax.reload(null, false);
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
