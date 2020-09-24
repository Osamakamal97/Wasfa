@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-success card-header-text">
                <div class="card-text">
                    <h4 class="card-name">Update slider</h4>
                </div>
            </div>
            <div class="card-body">
                <form id="editSliderForm">
                    @csrf
                    @method('put')
                    <input type="text" value="{{ $slider->id }}" name="id" style="display: none">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group bmd-form-group" style="margin-top: 52px;">
                                <label class="bmd-label-floating">Name</label>
                                <input type="text" class="form-control" name="title" value="{{ $slider->title }}">
                                <label id="title_error" class="error" for="required"
                                    style="display: none;color: red"></label>
                            </div>
                        </div>
                        <div class="togglebutton">
                            <label style="margin-top: 70px;">
                                <input type="checkbox" name="status"
                                    {{ $slider->status == 1 ? 'checked' : '' }}>
                                <span class="toggle"></span>
                                Show
                            </label>
                        </div>
                    </div>
                    <br>
                    <br>
                    <img width="300px" height="250px" src="{{ asset('images/sliders/'.$slider->image) }}" alt="">
                    <br>
                    <br>
                    <br>
                    <div class="row">
                        <span>Choose file</span>
                        <input type="file" name="image">
                        <label id="image_error" class="error" for="required" style="display: none;color: red"></label>
                    </div>

                </form>
            </div>
            <div class="card-footer ml-auto mr-auto">
                <button id="update_slider" type="submit" class="btn btn-success">Update slider<div
                        class="ripple-container">
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).on('click', '#update_slider', function(e){
        e.preventDefault();
        var formData = new FormData($('#editSliderForm')[0]);
        $.ajax({
            type:'post',
            url: "{{ route('slider.update', 0) }}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data){
                if(data.status){
                    // notify
                    $.notify({
                    icon: 'done',
                    message: data.message 
                    },{
                        type: 'success',
                    });
                }
            },
            error: function(reject){
                var response = $.parseJSON(reject.responseText);
                $.each(response.errors, function(key, val){
                    $('#' + key + '_error').text(val[0]).show();
                });
            }
        });
    });
</script>
@endpush