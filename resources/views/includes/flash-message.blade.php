
@if ($message = session('success'))

<div class="alert alert-success alert-block">

	<button type="button" class="close" data-dismiss="alert">×</button>

        <strong>{{ $message }}</strong>

</div>

@endif


@if ($message = session('error'))

<div class="alert alert-danger alert-block">

	<button type="button" class="close" data-dismiss="alert">×</button>

        <strong>{{ $message }}</strong>

</div>

@endif

@if ($message = session('danger'))

<div class="alert alert-danger alert-block">

	<button type="button" class="close" data-dismiss="alert">×</button>

        <strong>{{ $message }}</strong>

</div>

@endif


@if ($message = session('warning'))

<div class="alert alert-warning alert-block">

	<button type="button" class="close" data-dismiss="alert">×</button>

	<strong>{{ $message }}</strong>

</div>

@endif


@if ($message = session('info'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = session('light'))
    <div class="alert alert-light alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($errors->any())

<div class="alert alert-danger">

	<button type="button" class="close" data-dismiss="alert">×</button>

	Please check the form below for errors

</div>

@endif
<script src="{{ asset('plugins/jquery/jquery.js') }}"></script>
<script>
    $('.close').click(function(){
        $(this).parent().remove();
    });
</script>
