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
                <form id="createNewsForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group bmd-form-group" style="margin-top: 52px;">
                                <label class="bmd-label-floating">Title</label>
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                                <label id="title_error" class="error" for="required"
                                    style="display: none;color: red"></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group bmd-form-group" style="margin-top: 52px;">
                                <label class="bmd-label-floating">Contnet</label>
                                <textarea class="form-control" name="content">{{ old('content') }}</textarea>
                                <label id="content_error" class="error" for="required"
                                    style="display: none;color: red"></label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer ml-auto mr-auto">
                <button id="store_news" type="submit" class="btn btn-success">Create Recipe<div
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
    $(document).on('click', '#store_news', function(e){
        e.preventDefault();
        var formData = new FormData($('#createNewsForm')[0]);

        $.ajax({
            type:'post',
            url: "{{ route('news.store') }}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data){
                if(data.status){
                    // clear name input
                    $("input[name='title']").val('');
                    $('#title_error').css({display:'none'});
                    $("textarea[name='content']").val('');
                    $('#content_error').css({display:'none'});
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