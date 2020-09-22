@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-success card-header-text">
                <div class="card-text">
                    <h4 class="card-name">Update news</h4>
                </div>
            </div>
            <div class="card-body">
                <form id="editNewsForm">
                    @csrf
                    @method('put')
                    <input type="text" value="{{ $slider->id }}" name="id" style="display: none">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group bmd-form-group" style="margin-top: 52px;">
                                <label class="bmd-label-floating">Name</label>
                                <input type="text" class="form-control" name="title" value="{{ $slider->title }}">
                                <label id="title_error" class="error" for="required"
                                    style="display: none;color: red"></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-md-12">
                            <div class="form-group bmd-form-group" style="margin-top: 52px;">
                                <label class="bmd-label-floating">Content</label>
                                <input type="text" class="form-control" name="content" value="{{ $slider->status }}">
                                <label id="content_error" class="error" for="required"
                                    style="display: none;color: red"></label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer ml-auto mr-auto">
                <button id="update_news" type="submit" class="btn btn-success">Update news<div
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
    $(document).on('click', '#update_news', function(e){
        e.preventDefault();
        var formData = new FormData($('#editNewsForm')[0]);
        $.ajax({
            type:'post',
            url: "{{ route('news.update', $slider->id) }}",
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