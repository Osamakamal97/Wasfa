@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-success card-header-text">
                <div class="card-text">
                    <h4 class="card-title">Create recipe</h4>
                </div>
            </div>
            <div class="card-body">
                <form id="createSliderForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group bmd-form-group" style="margin-top: 52px;">
                                <label class="bmd-label-floating">Title</label>
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                                <label id="title_error" class="error" for="required"
                                    style="display: none;color: red"></label>
                            </div>
                        </div>
                        {{-- <div class="col-md-2"> --}}
                        <div class="togglebutton">
                            <label style="margin-top: 70px;">
                                <input type="checkbox" name="status" value="1" checked>
                                <span class="toggle"></span>
                                Show
                            </label>
                            {{-- </div> --}}
                            {{-- <div class="form-group bmd-form-group" style="margin-top: 52px;">
                                <label class="bmd-label-floating">Status</label>
                                <input type="text" class="form-control" name="status" value="{{ old('status') }}">
                            <label id="status_error" class="error" for="required"
                                style="display: none;color: red"></label>
                        </div> --}}
                    </div>
            </div>

            <br><br>
            <div class="row">
                <span>Choose file</span>
                <input type="file" name="image">
                <label id="image_error" class="error" for="required" style="display: none;color: red"></label>
            </div>
            {{-- <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail img-raised">
                            <img src="http://style.anu.edu.au/_anu/4/images/placeholders/person_8x10.png" rel="nofollow" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                        <div>
                            <span class="btn btn-raised btn-round btn-default btn-file">
                                <span class="fileinput-new">Select image</span>
                                <span class="fileinput-exists">Change</span>
                                <input type="file" name="image" />
                            </span>
                            <a href="javascript:;" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                        </div>
                    </div> --}}
            </form>
        </div>
        <div class="card-footer ml-auto mr-auto">
            <button id="store_slider" type="submit" class="btn btn-success">Create Slider<div class="ripple-container">
                </div>
            </button>
        </div>
    </div>
</div>
</div>
@endsection
@push('script')
<script>
    $(document).on('click', '#store_slider', function(e){
        e.preventDefault();
        var formData = new FormData($('#createSliderForm')[0]);

        $.ajax({
            type:'post',
            url: "{{ route('slider.store') }}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data){
                if(data.status){
                    // clear name input
                    $("input[name='title']").val('');
                    $('#title_error').css({display:'none'});
                    $("input[name='status']").val('');
                    $('#status_error').css({display:'none'});
                    $("input[name='image']").val('');
                    $('#image_error').css({display:'none'});
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