@if (session('success'))
    <div class="alert alert-success alert-dismissible">
        <a href="#" class="close text-decoration-none" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('success') }}
    </div>
@endif

@if (session('info'))
    <div class="alert alert-info alert-dismissible">
        <a href="#" class="close text-decoration-none" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('info') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close text-decoration-none" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('error') }}
    </div>
@endif