
<div class="btn-group" role="group">
    <a href="{{route('slider.edit', $data->id)}}" class="btn btn-primary btn-edit btn-sm">
<span class="material-icons" style="font-size: 0.9rem">
edit
</span> Edit
    </a>
    <a href="{{route('slider.destroy', $data->id)}}" class="btn btn-danger btn-destroy btn-sm">
    <span class="material-icons" style="font-size: 0.9rem">
delete
</span>
        Hapus
    </a>
</div>
