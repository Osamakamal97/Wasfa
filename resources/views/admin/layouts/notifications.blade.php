@if (session()->has('success'))
<script>
    $.notify({
	// options
    icon: 'done',
	message: "{{ session()->pull('success') }}" 
    },{
        // settings
        type: 'success',
        // timer: 100000
    });
</script>
@elseif(session()->has('error'))
<script>
    $.notify({
	// options
    icon: 'error',
	message: "{{ session()->pull('error') }}" 
    },{
        // settings
        type: 'danger',
    });
</script>
@endif